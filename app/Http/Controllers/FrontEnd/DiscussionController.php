<?php

namespace App\Http\Controllers\FrontEnd;

use DB;
use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Models\DiscussionReply;
use App\Http\Controllers\Controller;
use App\Notifications\DiscussionLike;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\FrontEnd\Discussion\Store;
use App\Http\Requests\FrontEnd\Discussion\Update;

class DiscussionController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except([
            'index',
            'show'
        ]);
    } 

    public function index(Request $request)
    {
        $discussions = Discussion::when($request, function($query) use($request){
            if($request->answer == 2){
                return $query->whereNull('best_reply_id');
            }else if($request->answer == 1){
                return $query->whereNotNull('best_reply_id');
            }else if($request->popular == 1){
                return $query->where('created_at','>=', Carbon::now()->subdays(7))->orderBy('views', 'desc');
            }else if($request->popular == 2){
                return $query->where('created_at','>=', Carbon::now()->subMonth())->orderBy('views', 'desc');
            }else if($request->cat){
                $cat = Category::where('category_name', $request->cat)->firstOrFail();
                return $query->where('cat_id', $cat->id);
            }else if($request->favorite == 1 && currentuser()){
                $friends = currentuser()->follows->pluck('id');
                $friends->push(currentuser()->id);
                return $query->whereIn('user_id', $friends);
            }else if($request->fresh == 1){
                $replies = DiscussionReply::get()->pluck('discussion_id');
                return $query->whereNotIn('id', $replies);
            }
        })->latest()->paginate(30);

        return view('front-end.discussions.index', compact('discussions'));
    }

   
    public function create()
    {
        $user = User::where('id', auth()->id())->firstOrFail();
        $categories = Category::latest()->get();
        $points = 0;
        foreach($user->test as $score){
            $points += $score->score;
        }
        return view('front-end.discussions.create', compact('user', 'points', 'categories'));
    }

    
    public function store(Store $request)
    {
        $requestArray  = $request->except('image');
        $requestArray['user_id'] = currentuser()->id;
        if(!is_null($request->image)){
            $cat_id = $request->cat_id;
            $tempFolder = time();
            Storage::makeDirectory('uploads/images/'.$cat_id.'/discussions/'.$tempFolder);
            Image::make($request->image)->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/images/'.$cat_id.'/discussions/'.$tempFolder."/".$request->image->hashName()));
            $requestArray['image'] = 'uploads/images/'.$cat_id.'/discussions/'.$tempFolder."/".$request->image->hashName();
            $row = Discussion::create($requestArray);
            Storage::makeDirectory('uploads/images/'.$row->cat_id.'/discussions/'.$row->id);
            $newName = str_replace($tempFolder, $row->id, $row['image']);
            Storage::rename($row['image'], $newName);
            Discussion::where('id', $row->id)->update(['image' => $newName]);
            Storage::deleteDirectory('uploads/images/'.$row->cat_id.'/discussions/'.$tempFolder);
        }else{
            Discussion::create($requestArray);
        }
        alert()->success('Discussion has been published successfully');
        return redirect()->route('userprofile', ['user' => currentuser()->id]); 
    }

    
    public function show($discussion)
    {
        $title = str_replace('-', ' ', $discussion);
        $discussion = Discussion::where('title', $title)->firstOrFail();
        DB::table('discussions')->where('id', $discussion->id)->increment('views');
        return view('front-end.discussions.show', compact('discussion'));

    }

    
    public function edit(Discussion $discussion)
    {
        $this->authorize('profile-permissions', $discussion->user);
        $user = User::where('id', auth()->id())->firstOrFail();
        $categories = Category::latest()->get();
        $points = 0;
        foreach($user->test as $score){
            $points += $score->score;
        }
        return view('front-end.discussions.edit', compact('discussion', 'user', 'points', 'categories'));    
    }

    
    public function update(Update $request, Discussion $discussion)
    {
        $discussionReplies = DiscussionReply::where('discussion_id', $discussion->id)->get();
        $this->authorize('profile-permissions', $discussion->user);
        $requestArray = $request->except('image');
        $requestArray['user_id'] = currentuser()->id;
        if(!is_null($discussion->image)){
            if($requestArray['cat_id'] != $discussion->cat_id){
                if($request->hasFile('image')){
                    Storage::makeDirectory('uploads/images/'. $requestArray['cat_id']. '/discussions/'. $discussion->id);
                    Image::make($request->image)->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/images/'. $requestArray['cat_id']. '/discussions/'. $discussion->id ."/".$request->image->hashName()));
                    $requestArray['image'] = 'uploads/images/'. $requestArray['cat_id']. '/discussions/'. $discussion->id ."/".$request->image->hashName();
                    foreach($discussionReplies as $reply){
                        if(!is_null($reply->image)){
                            $newRoute = str_replace($discussion->cat_id, $requestArray['cat_id'], $reply['image']);
                            Storage::rename($reply['image'], $newRoute);         
                            Storage::deleteDirectory('uploads/images/'.$discussion->cat_id.'/discussions/'.$discussion->id.'/replies/'.$reply->id);
                            $reply->update(['image' => $newRoute]);
                        }
                    }
                    Storage::deleteDirectory('uploads/images/'.$discussion->cat_id.'/discussions/'.$discussion->id);
                }else{
                    $newName = str_replace($discussion->cat_id, $requestArray['cat_id'], $discussion['image']);
                    foreach($discussionReplies as $reply){
                        if(!is_null($reply->image)){
                            $newRoute = str_replace($discussion->cat_id, $requestArray['cat_id'], $reply['image']);
                            Storage::rename($reply['image'], $newRoute);         
                            Storage::deleteDirectory('uploads/images/'.$discussion->cat_id.'/discussions/'.$discussion->id.'/replies/'.$reply->id);
                            $reply->update(['image' => $newRoute]);
                        }
                    }
                    Storage::rename($discussion['image'], $newName);
                    Storage::deleteDirectory('uploads/images/'.$discussion->cat_id.'/discussions/'.$discussion->id);
                    $requestArray['image'] = $newName;
                }     
            }else{
                if($request->hasFile('image')){
                    if($discussion->discussionreplies->count() > 0){
                        $newName = 'uploads/images/'.$discussion->cat_id.'/discussions/reply';
                        $oldName = 'uploads/images/'.$discussion->cat_id.'/discussions/'.$discussion->id.'/replies';
                        Storage::move($oldName, $newName);
                    }         
                    Storage::delete($discussion->image);
                    Image::make($request->image)->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/images/'. $discussion->cat_id. '/discussions/'. $discussion->id ."/".$request->image->hashName()));
                    $requestArray['image'] = 'uploads/images/'. $discussion->cat_id . '/discussions/'. $discussion->id ."/".$request->image->hashName();
                    if($discussion->discussionreplies->count() > 0){
                        Storage::rename($newName, $oldName);
                    }
                }
            }
        }else{
            if(!is_null($request->image)){
                if($discussion->discussionreplies->count() > 0){
                    $newName = 'uploads/images/'.$discussion->cat_id.'/discussions/reply';
                    $oldName = 'uploads/images/'.$discussion->cat_id.'/discussions/'.$discussion->id.'/replies';
                    Storage::move($oldName, $newName);
                } 
                $cat_id = $request->cat_id;
                Storage::makeDirectory('uploads/images/'.$cat_id.'/discussions/'.$discussion->id);
                Image::make($request->image)->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/'.$cat_id.'/discussions/'.$discussion->id."/".$request->image->hashName()));
                $requestArray['image'] = 'uploads/images/'.$cat_id.'/discussions/'.$discussion->id."/".$request->image->hashName();
                if($discussion->discussionreplies->count() > 0){
                    Storage::rename($newName, $oldName);
                }
            }
        }
       
        $discussion->update($requestArray);
        alert()->success('Discussion has been Updated successfully');
        return redirect()->route('userprofile', ['user' => currentuser()->id]); 
    }

    
    public function destroy(Discussion $discussion)
    {
        $this->authorize('profile-permissions', $discussion->user);
        if(!is_null($discussion->image)){
            Storage::deleteDirectory('uploads/images/'.$discussion->cat_id.'/discussions/'.$discussion->id);
        }
        $discussion->delete();
        alert()->success('Discussion has been Deleted successfully');
        return back();

    }

    public function storeLike(Discussion $discussion){
        $discussion->like(currentuser());
        if($discussion->isLikedBy(currentuser())){
            if($discussion->user_id != currentuser()->id){
                Notification::send($discussion->user, new DiscussionLike(currentuser(), $discussion));
            }
        }
        return back();
    }
}
