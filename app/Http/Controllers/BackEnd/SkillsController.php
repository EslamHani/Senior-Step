<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Requests\BackEnd\Skills\Store;
use App\Http\Requests\BackEnd\Skills\Update;

class SkillsController extends BackEndController
{
    public function __construct(Skill $model){
        parent::__construct($model);
    }

    public function index(Request $request)
    {
        $append = [];
        $rows = $this->model->when($request->search, function($query) use($request){
            return $query->where('skill_name', 'like', '%'.$request->search.'%');
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
    }
    
    public function store(Store $request)
    {
        $requestArray = $request->all();
        $this->model->create($requestArray);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.index')->with('success', 'One skill added successfully');
    }

    public function update(Update $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $routeName = $this->getSmallCharModelName();
        $requestArray = $request->all();
        $row->update($requestArray);
        return redirect()->route($routeName.'.edit', ['id' => $row->id]);
    }

    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
        return redirect()->route($this->getSmallCharModelName().'.index'); 
    }
}