<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title', 'content', 'image', 'author', 'cat_id', 'permission', 'meta_desc', 'meta_keywords'];

    public function category(){
    	return $this->hasOne('App\Models\category', 'id', 'cat_id');
    }
}
