<?php
namespace App\Models;

trait ReplyLikeable{

	public function likes(){
    	return $this->hasMany(ReplyLike::class, 'reply_id');
    }

    public function like($user = null, $liked = true){
    	if($this->isLikedBy($user)){
    		// Delete Like
    		\DB::table('reply_likes')
            ->where('reply_id', $this->id)
            ->where('user_id', $user->id)
            ->delete();
    	}else{
    		//Make Like
	    	$this->likes()->updateOrCreate(
	    		[
	    			'user_id' => $user ? $user->id : auth()->id(),
	    		],
	    		[
	    			'liked'   => $liked,
	    		]
	    	);
	    }
    }

    public function isLikedBy(User $user){
    	return $this->likes()
    				->where('user_id', $user->id)
    				->where('reply_id', $this->id)
    				->count();
    }

    public function users(){
        return $this->belongsToMany(user::class, 'reply_likes', 'reply_id', 'user_id');
    }

}