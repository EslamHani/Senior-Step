<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'user_id', 'video_id'];

    public function user(){
    	return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function video(){
    	return $this->hasOne('App\Models\Video', 'id', 'video_id');
    }

    public function replies(){
    	return $this->hasMany('App\Models\ReplayComment')->with('user');
    }

}
