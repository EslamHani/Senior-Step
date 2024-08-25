<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['video_name', 'video_desc', 'youtube', 'open_comments' , 'permission', 'course_id', 'views', 'time', 'transcript'];

    public function course(){
    	return $this->hasOne('App\Models\Course', 'id', 'course_id');
    }

     public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }

    public function likes()
    {
    	return $this->hasMany(VideoLike::class);
    }

    public function like($user = null, $liked = true)
    {
    	if($this->isLikedBy($user)){
    		// Delete Like
    		\DB::table('video_likes')
            ->where('video_id', $this->id)
            ->where('user_id', $user->id)
            ->delete();
    	}else{
    		// Make Like
    		$this->likes()->updateOrCreate(
	            [
	                'user_id' => $user ? $user->id : auth()->user()->id,
	            ],
	            [
	                'liked' => $liked,
	            ]
	        );
    	}
    }

    public function dislike($user = null)
    {
    	return $this->like($user, false);
    }

    public function isLikedBy(User $user)
    {
    	return $this->likes()
            ->where('user_id', $user->id)
            ->where('liked', true)
            ->count();
    }

}
