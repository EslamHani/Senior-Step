<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscussionReply extends Model
{
	use ReplyLikeable;

    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function discussion(){
    	return $this->belongsTo(Discussion::class);
    }
}
