<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Topics\Store;
use App\Http\Requests\BackEnd\Topics\Update;
use Intervention\Image\Facades\Image;
use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use Storage;

class TopicsController extends BackEndController
{

    public function __construct(Topic $model){
        parent::__construct($model);
    } // End of construct

    protected function append2(){
        $array = [
            'categories' => Category::where('permission', 1)->get(),
        ];
        return $array;
    } // End of append2

    public function index(Request $request)
    {
        $append = [];
        $rows = $this->model->when($request->search, function($query) use($request){
            return $query->where('title', 'like', '%'.$request->search.'%')->orWhere('content', 'like', '%'.$request->search.'%');
        })->orderBy('created_at', 'desc')->paginate(10);
        $ModulName = $this->getModelName();   // Like  User
        $PageTitle = "Control " . $this->getPluralModelName(); // Like Control Users
        $PageDescription = "Here you can add / edit / delete ".$ModulName;
        $routeName = $this->getSmallCharModelName();   // Like users
        $folderName = $this->getSmallCharModelName();   // Like users
        return view('back-end.'.$folderName.'.index', compact([
            'rows',
            'ModulName',
            'PageTitle',
            'PageDescription',
            'routeName',
            'folderName'
        ]))->with($append);
    } // End of index

    public function store(Store $request)
    {
        $requestArray = $request->except('image');
        $requestArray['content'] = $request->input('content');
        $cat_id  = $request->cat_id;
        Storage::makeDirectory('uploads/images/'.$cat_id. '/news');
        Image::make($request->image)->resize(700, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/images/'.$cat_id. '/news' . '/' . $request->image->hashName()));
        $requestArray['image'] = 'uploads/images/'.$cat_id. '/news' . "/" .$request->image->hashName();
        Topic::create($requestArray);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.".index")->with('success', 'One topic added successfully');
    } // End of index

    public function update(Update $request, $id)
    {
        $row = Topic::findOrFail($id);
        $requestArray = $request->except('image');
        $requestArray['content'] = \Purifier::clean($request->input('content'));
        $cat_id = $request->cat_id;
        if($row->cat_id != $cat_id){
            $newName = str_replace($row->cat_id, $cat_id , $row['image']);
            Storage::rename($row['image'], $newName);
            $requestArray['image'] = $newName;
            if($request->hasFile('image')){
                Storage::delete($newName);
                Storage::makeDirectory('uploads/images/'.$cat_id. '/news');
                Image::make($request->image)->resize(700, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/'. $cat_id. '/'. 'news' . '/' . $request->image->hashName()));
                $requestArray['image'] = 'uploads/images/'. $cat_id. '/'. 'news' . '/' . $request->image->hashName();
            }
        }else{
            if($request->hasFile('image')){
                Storage::delete($row->image);
                Image::make($request->image)->resize(700, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/'.$cat_id. '/news' . '/' .$request->image->hashName()));
                $requestArray['image'] = 'uploads/images/'.$cat_id. '/news' . '/' .$request->image->hashName();
            }
        }
      
        $row->update($requestArray);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.edit', ['id' => $row->id]);
    } // End of update

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        Storage::delete($topic->image);
        $topic->delete();
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.index');
    } // End of destroy

} // End of controller
