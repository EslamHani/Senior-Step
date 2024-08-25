<?php
namespace App\Models;

trait Followable{

	public function follows(){
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withTimestamps();
    }

    public function follow(User $user){
        return $this->follows()->save($user);
    }

    public function unfollow(User $user){
        return $this->follows()->detach($user);
    }

    public function togglefollow(User $user){
        return $this->follows()->toggle($user);
    }

    public function following(User $user){
        return $this->follows->contains($user);
    }

    public function followers(){
        return \DB::table('follows')->where('following_user_id', $this->id)->get();
    }
	
}