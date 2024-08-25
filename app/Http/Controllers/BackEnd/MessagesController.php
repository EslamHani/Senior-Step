<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Mail\Contact;
use Mail;

class MessagesController extends BackEndController
{
    
    public function __construct(Message $model){
        parent::__construct($model);
    }

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
    }
    
    public function store(Request $request)
    {
        $id = $request->input('id');
        $msg = Message::findOrFail($id);
        $this->validate($request, [
            'replay' => ['required', 'min:3', 'string'],
        ]);
        $msg->update(['replay' => 1]);
        $data = array('msg' => $request->replay, 'name' => $msg->name);
        Mail::to($request->email)->send(new Contact($data));
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.index')->with('success', 'Mail Sent Successfully');
    }

    
    public function destroy($id)
    {
        $message = $this->model->findOrFail($id);
        $message->delete();
        if(request()->has("delete_btn")){
            return back();
        }
        return redirect()->route($this->getSmallCharModelName().'.index'); 
    }

}
