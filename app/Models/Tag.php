<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag_name', 'permission', 'meta_keywords', 'meta_desc'];

    public function courses(){
    	return $this->belongsToMany(Course::class, 'course_tags')->where('permission', 1);
    }
}
