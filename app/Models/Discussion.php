<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use DiscussionLikeable;

    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function category(){
    	return $this->belongsTo(Category::class, 'cat_id');
    }

    public function discussionreplies(){
    	return $this->hasMany(DiscussionReply::class);
    }

}
