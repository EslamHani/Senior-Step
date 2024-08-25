<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['skill_name', 'permission', 'meta_keywords', 'meta_desc'];


    public function courses(){
    	return $this->belongsToMany(Course::class, 'course_skills')->where('permission', 1);
    }
}
