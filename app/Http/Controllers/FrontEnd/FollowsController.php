<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowsController extends Controller
{
	
	public function __construct(){
		$this->middleware('auth');
	}

    public function store(User $user){
    	currentuser()->togglefollow($user);
    	return back();
    }
}
