<?php

namespace App\Http\Controllers\FrontEnd;

use Storage;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Models\DiscussionReply;
use App\Notifications\ReplyLike;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Notifications\DiscussionBestReply;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DiscussionReply as ReplyNotification;

class ReplyDiscussionController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request){
    	$validatedData = $request->validate([
    		'discussion_reply' => ['required', 'string'],
    		'discussion_id'    => ['required', 'exists:discussions,id'],
            'image'  => ['image', 'max:10240', 'mimes:jpg,png,jpeg'],
    	]);

    	// Excution doesn't reach here if validation is fails

    	$validatedData['user_id'] = currentuser()->id;
        
        $discussion = Discussion::findOrFail($validatedData['discussion_id']);

         if(!is_null($request->image)){
            $cat_id = $discussion->cat_id;
            $tempFolder = time();
            Storage::makeDirectory('uploads/images/'.$cat_id.'/discussions/'.$discussion->id.'/replies/'.$tempFolder);
            Image::make($request->image)->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/images/'.$cat_id.'/discussions/'.$discussion->id.'/replies/'.$tempFolder."/".$request->image->hashName()));
            $validatedData['image'] = 'uploads/images/'.$cat_id.'/discussions/'.$discussion->id.'/replies/'.$tempFolder."/".$request->image->hashName();
            $reply = DiscussionReply::create($validatedData);
            Storage::makeDirectory('uploads/images/'.$cat_id.'/discussions/'.$discussion->id.'/replies/'.$reply->id);
            $newName = str_replace($tempFolder, $reply->id, $reply['image']);
            Storage::rename($reply['image'], $newName);
            DiscussionReply::where('id', $reply->id)->update(['image' => $newName]);
            Storage::deleteDirectory('uploads/images/'.$cat_id.'/discussions/'.$discussion->id.'/replies/'.$tempFolder);
        }else{
           $reply = DiscussionReply::create($validatedData);
        }

        if(currentuser()->id != $discussion->user_id){

            Notification::send($reply->discussion->user, new ReplyNotification(currentuser(), $discussion));

        }

    	alert()->success('Reply has been published successfully');

    	return redirect()->back();
    }

    public function BestReply(DiscussionReply $discussionreply){

    	$this->authorize('discussion-permissions', $discussionreply->discussion);

    	$discussion = Discussion::where('id', $discussionreply->discussion_id)->firstOrFail();

    	$discussion->update([
    		'best_reply_id' => $discussionreply->id,
    	]);


        if($discussion->user_id != $discussionreply->user_id){

            Notification::send($discussionreply->user, new DiscussionBestReply($discussion->user, $discussion));
            
        }

    	alert()->success('Best reply has been saved successfully');

    	return redirect()->back();

    }

    public function edit(DiscussionReply $reply){
        return redirect()->back()->with('reply', $reply);
    }


    public function destroy(DiscussionReply $reply){

        $this->authorize('reply-permissions', $reply->user);
        
        if(!is_null($reply->image)){
            $discussion = Discussion::findOrFail($reply->discussion_id);
            Storage::deleteDirectory('uploads/images/'.$discussion->cat_id.'/discussions/'.$discussion->id.'/replies/'.$reply->id);
        }

        $reply->delete();

        alert()->success('Reply has been Deleted successfully');

        return redirect()->back();
    }

    public function storeLike(DiscussionReply $reply){
        $reply->like(currentuser());
        if($reply->isLikedBy(currentuser())){
            if($reply->user_id != currentuser()->id){
                Notification::send($reply->user, new ReplyLike(currentuser(), $reply->discussion));
            }
        }
        return back();
    }
}
