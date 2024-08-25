<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserNotificatiosController extends Controller
{	
	public function __construct(){
        $this->middleware('auth');
    }

    public function show(User $user){

    	$this->authorize('profile-permissions', $user);

    	$notifications = $user->notifications->take(20);

    	return view('front-end.profile.notifications', compact('notifications', 'user'));
    }
}
