<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['title', 'description', 'image', 'path', 'real_name', 'size', 'course_id', 'download', 'permission', 'author'];

    public function course(){
    	return $this->belongsTo('App\Models\Course');
    }
   
}
