<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Users\Store;
use App\Http\Requests\BackEnd\Users\Update;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\User;
use Storage;
use Hash;

class UsersController extends BackEndController
{
   
    public function __construct(User $model){
        parent::__construct($model);
    } // End of construct
    
    public function index(Request $request)
    {
        $append = [];
        $rows = $this->model->when($request->search, function($query) use($request){
            return $query->where('name', 'like', '%'.$request->search.'%')->orWhere('email', 'like', '%'.$request->search.'%');
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
        $requestArray = $request->except(['image', 'password']);
        $requestArray['password'] = Hash::make($request->password);
        if($request->hasFile('image')){
            Image::make($request->image)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users/'.$request->image->hashName()));
            $requestArray['image']  = '/uploads/users/'.$request->image->hashName();
        }
        $this->model->create($requestArray);
        $folderName = $this->getSmallCharModelName();
        return redirect()->route($folderName.'.index')->with('success', 'One user added successfully');
    } // End of store

    
    public function update(Update $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $folderName = $this->getSmallCharModelName();
        $requestArray = $request->except(['password','image']);
        if(isset($request->password) && $request->password != ""){
            $requestArray['password'] = Hash::make($request->password);
        }
        if($request->hasFile('image')){
            if($row->image !== "/uploads/default.png"){
                Storage::delete($row->image);
            }
            Image::make($request->image)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users/'.$request->image->hashName()));
            $requestArray['image']  = '/uploads/users/'.$request->image->hashName();
        }
        $row->update($requestArray);
        return redirect()->route($folderName.'.edit', ['id' => $row->id]);
    } // End of update

    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        if($row->image !== "/uploads/default.jpg"){
           Storage::delete($row->image); 
        }
        $row->delete();
        if(request()->has("delete_btn")){
            return back();
        }
        return redirect()->route($this->getSmallCharModelName().'.index'); 
    } // End of destroy
    
} // End of controller
