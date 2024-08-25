<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplayComment extends Model
{
    protected $fillable = ['replay_comment', 'user_id', 'comment_id'];

    public function user(){
    	return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }
}
