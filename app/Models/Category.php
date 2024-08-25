<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name', 'image', 'permission', 'meta_keywords', 'meta_desc'];

    public function courses(){
    	return $this->hasMany('App\Models\Course', 'cat_id', 'id')->where('permission', 1);
    }

    public function discussions(){
    	return $this->hasMany(Discussion::class);
    }
}
