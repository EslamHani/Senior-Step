<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Categories\Store;
use App\Http\Requests\BackEnd\Categories\Update;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Category;
use Storage;
use DB;


class CategoriesController extends BackEndController
{
    
    public function __construct(Category $model){
        parent::__construct($model);
    } // End of construct

    public function index(Request $request)
    {
        $append = [];
        $rows = $this->model->when($request->search, function($query) use($request){
            return $query->where('category_name', 'like', '%'.$request->search.'%');
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
        $tempFolder = time();
        Storage::makeDirectory('uploads/images/'.$tempFolder);
        Image::make($request->image)->resize(350, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/images/'.$tempFolder."/".$request->image->hashName()));
        $requestArray['image'] = "uploads/images/".$tempFolder."/".$request->image->hashName();
        $category = $this->model->create($requestArray);
        Storage::makeDirectory('uploads/images/'.$category->id);
        $newName = str_replace($tempFolder, $category->id, $category['image']);
        Storage::rename($category['image'], $newName);
        $this->model->where('id', $category->id)->update(['image' => $newName]);
        Storage::deleteDirectory('uploads/images/'.$tempFolder);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.index')->with('success', 'One Category added successfully');
    } // End of store

    public function update(Update $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $requestArray = $request->except('image');
        if($request->hasFile('image')){
            Storage::delete($row->image);
            Image::make($request->image)->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/images/'.$row->id."/".$request->image->hashName()));
            $requestArray['image'] = 'uploads/images/'.$row->id."/".$request->image->hashName();
        }
        $routeName = $this->getSmallCharModelName();
        $row->update($requestArray);
        return redirect()->route($routeName.'.edit', ['id' => $row->id]);
    } // End of update

    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
        Storage::deleteDirectory('uploads/images/'.$id);
        return redirect()->route($this->getSmallCharModelName().'.index');
    } // End of destroy

} // End of CategoriesController
