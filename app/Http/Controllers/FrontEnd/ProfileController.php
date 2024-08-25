<?php

namespace App\Http\Controllers\FrontEnd;

use Hash;
use Image;
use Storage;
use App\Models\User;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\Users\Update;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
    }

    public function index(User $user){
        $discussions = Discussion::where('user_id', $user->id)->latest()->paginate(15);
        $points = 0;
        foreach($user->test as $score){
            $points += $score->score;
        }
        if($points >= 150){
            $dev = $points / 150;
            $level = floor($dev) + 1;
            if($level > 50){
                $level = 50;
            }
            if($user->level != $level){
                if(auth()->user()->id == $user->id){
                    $user->update(['level' => $level]);
                    alert()->success('Congratulations. You have reached the next level')->persistent('Close'); 
                }    
            }      
        } 
        return view('front-end.profile.index', compact('user', 'points', 'discussions'));
    }

    public function userCourses(User $user){
        $this->authorize('profile-permissions', $user);
        return view('front-end.profile.archieved', compact('user'));
    }

    public function edit(User $user){
        $this->authorize('profile-permissions', $user);
        return view('front-end.profile.edit', compact('user'));
    }

    public function update(Update $request, User $user){
        $this->authorize('profile-permissions', $user);
        $requestArray = $request->except('image', 'password');
        if($request->password != "" && !is_null($request->password) ){
            $requestArray['password'] = Hash::make($request->password);
        }

        if(isset($request->image) && !empty($request->image) && !is_null($request->image)){
            if($user->image !== "/uploads/default.png"){
                Storage::delete($user->image);
            }
            Image::make($request->image)->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users/'.$request->image->hashName()));
            $requestArray['image']  = '/uploads/users/'.$request->image->hashName();
        }
        $user->update($requestArray);
        return redirect()->route('userprofile', $user); 
    }
}
