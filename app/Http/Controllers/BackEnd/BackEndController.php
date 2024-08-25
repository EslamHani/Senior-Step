<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackEndController extends Controller
{
    protected $model; // To asign current Model

    public function __construct($model){
    	$this->model = $model;
    }

    public function create()
    {
        $ModulName = $this->getModelName(); // Like User
        $PageTitle = "Create " . $ModulName;  // Like Create User
        $PageDescription = "Here you can add ".$ModulName;
        $routeName = $this->getSmallCharModelName();   // Like users
        $folderName = $this->getSmallCharModelName();   // Like users
        $append2 = $this->append2();
        return view('back-end.'.$folderName.'.create', compact([
            'ModulName',
            'PageTitle',
            'PageDescription',
            'routeName',
            'folderName',
        ]))->with($append2);
    }

    public function edit($id)
    {
        $append2 = [];  //intial value
        $append  = [];
        $row = $this->model->findOrFail($id);
        $ModulName = $this->getModelName(); // Like User
        $PageTitle = "Edit " . $ModulName;  // Like Edit User
        $PageDescription = "Here you can edit ".$ModulName;
        $routeName = $this->getSmallCharModelName();   // Like users
        $folderName = $this->getSmallCharModelName();   // Like users
        $append2 = $this->append2();
        $append  = $this->append($id);
        return view('back-end.'.$folderName.'.edit', compact([
            'row',
            'ModulName',
            'PageTitle',
            'PageDescription',
            'routeName',
            'folderName',
        ]))->with($append2)->with($append);
    }


    //This function will return model name Like User
    protected function getModelName(){
        return class_basename($this->model);
    }

    //This function will return plural model name Like Users
    protected function getPluralModelName(){
        return str_plural($this->getModelName());
    }

    //This function will return plural model name with small letter Like users
    protected function getSmallCharModelName(){
        return strtolower($this->getPluralModelName());
    }

    //To return array data
    protected function append($input){
        return [];
    }
    //To return array data
    protected function append2(){
        return [];
    }
}
