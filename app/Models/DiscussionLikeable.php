<?php
namespace App\Models;

trait DiscussionLikeable{

	public function likes(){
        return $this->hasMany(DiscussionLike::class, 'discussion_id');
    }

    public function like($user = null, $liked = true){
    	if($this->isLikedBy($user)){
    		// Delete Like
    		\DB::table('discussion_likes')
            ->where('discussion_id', $this->id)
            ->where('user_id', $user->id)
            ->delete();
    	}else{
    		// Make Like
    		$this->likes()->updateOrCreate(
	            [
	                'user_id' => $user ? $user->id : auth()->id(),
	            ],
	            [
	                'liked' => $liked,
	            ]
	        );
    	}
    }

    public function isLikedBy(User $user){
        return $this->likes()
            ->where('user_id', $user->id)
            ->where('liked', true)
            ->count();
    }

    public function users(){
        return $this->belongsToMany(user::class, 'discussion_likes', 'discussion_id', 'user_id');
    }

}