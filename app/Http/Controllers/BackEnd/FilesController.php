<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Files\Store;
use App\Http\Requests\BackEnd\Files\Update;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\File;
use Storage;

class FilesController extends BackEndController
{
    
    public function __construct(File $model){
        parent::__construct($model);
    } // End of construct

    protected function append2(){
        $array = [
            'courses' => Course::orderBy('created_at', 'desc')->get(),
        ];
        return $array;
    } // End of append2

    public function index(Request $request)
    {
        $append = [];
        $rows = $this->model->when($request->search, function($query) use($request){
            return $query->where('title', 'like', '%'.$request->search.'%')->orWhere('real_name', 'like', '%'.$request->search.'%');
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
        $cat_id = Course::where('id', $request->input('course_id'))->first();
        $tempfolder = time();
        $real_name = $request->file->getClientOriginalName();
        $upfile = $request->file->storeAs('uploads/images/'.$cat_id->cat_id.'/'.$request->course_id.'/files/'.$tempfolder, $real_name); 
        Storage::makeDirectory('uploads/images/'.$cat_id->cat_id.'/'.$request->course_id.'/files/'.$tempfolder);
        Image::make($request->image)->resize(350, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/images/'.$cat_id->cat_id.'/'.$request->course_id.'/files/'.$tempfolder. '/' .$request->image->hashName()));
        $upimage = 'uploads/images/'.$cat_id->cat_id.'/'.$request->course_id.'/files/'.$tempfolder. '/'.$request->image->hashName();
        $file = File::create([
            'title' => $request->input('title'),   
            'description' => $request->input('description'),
            'image'  => $upimage,        
            'path'   => $upfile,
            'real_name' => $real_name,
            'size'  => Storage::size($upfile),
            'course_id' => $request->input('course_id'),
            'permission' => $request->input('permission'),
            'author'  => $request->input('author'),
        ]);
        Storage::makeDirectory('uploads/images/'.$cat_id->cat_id.'/'.$file->course_id.'/files/'.$file->id);
        $newFilePath = str_replace($tempfolder, $file->id, $file['path']);
        $newImagePath = str_replace($tempfolder, $file->id, $file['image']);
        Storage::rename($file['path'], $newFilePath);
        Storage::rename($file['image'], $newImagePath);
        File::where('id', $file->id)->update(['path' => $newFilePath, 'image' => $newImagePath]);
        Storage::deleteDirectory('uploads/images/'.$cat_id->cat_id.'/'.$request->course_id.'/files/'.$tempfolder);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.index')->with('success', 'One file added successfully');
    } // End of store

    
    public function update(Update $request, $id)
    {
        $row = File::findOrFail($id);
        $cat_id = Course::where('id', $row->course_id)->first()->cat_id;
        $requestArray = $request->all();
        if($requestArray['course_id'] != $row->course_id){
            $NewCatId = Course::where('id', $requestArray['course_id'])->firstOrFail()->cat_id;      
            $newFilePath = str_replace($row->course_id, $requestArray['course_id'], $row['path']);
            $newFilePath = str_replace($cat_id, $NewCatId, $newFilePath);
            $newImagePath = str_replace($row->course_id, $requestArray['course_id'], $row['image']);
            $newImagePath = str_replace($cat_id, $NewCatId, $newImagePath);
            Storage::rename($row['path'], $newFilePath);
            Storage::rename($row['image'], $newImagePath);
            Storage::deleteDirectory('uploads/images/'.$cat_id.'/'.$row->course_id.'/files/'.$row->id);
            $requestArray['path'] = $newFilePath;
            $requestArray['image'] = $newImagePath;
            if($request->hasFile('file')){
                Storage::delete($newFilePath);
                $requestArray['real_name'] = $request->file->getClientOriginalName();
                $requestArray['path'] = $request->file->storeAs('uploads/images/'.$NewCatId.'/'.$requestArray['course_id'].'/files/'.$row->id, $requestArray['real_name']);
            }
            if($request->hasFile('image')){
                Storage::delete($newImagePath);
                Image::make($request->image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/'.$NewCatId.'/'.$requestArray['course_id'].'/files/'.$row->id . '/' .$request->image->hashName()));
                $requestArray['image'] = 'uploads/images/'.$NewCatId.'/'.$requestArray['course_id'].'/files/'.$row->id . '/'. $request->image->hashName();
            }
        }else{ // End of if
            if($request->hasFile('file')){
                Storage::delete($row->path);
                $requestArray['real_name'] = $request->file->getClientOriginalName();
                $requestArray['path'] = $request->file->storeAs('uploads/images/'.$cat_id.'/'.$row->course_id.'/files/'.$row->id, $requestArray['real_name']);
            }
            if($request->hasFile('image')){
                Storage::delete($row->image);
                Image::make($request->image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/'.$cat_id.'/'.$row->course_id.'/files/'.$row->id .'/'. $request->image->hashName()));
                $requestArray['image'] = 'uploads/images/'.$cat_id.'/'.$row->course_id.'/files/'.$row->id .'/'. $request->image->hashName();
            }
        } // End of else
        $row->update($requestArray);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.edit', ['id' => $row->id]);

    } // End of update

    
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        $cat_id = Course::where('id', $file->course_id)->first()->cat_id;
        Storage::deleteDirectory('uploads/images/'.$cat_id.'/'.$file->course_id.'/files/'.$file->id);
        $file->delete();
        return redirect()->route($this->getSmallCharModelName().'.index'); 
    } // End of destroy

} // End of controller
