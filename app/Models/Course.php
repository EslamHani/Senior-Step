<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name',
        'cat_id',
        'permission',
        'image',
        'course_desc',
        'teacher',
        'meta_keywords',
        'meta_desc',
    ];

    public function category(){
    	return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    }

    public function skills(){
    	return $this->belongsToMany(Skill::class, 'course_skills')->where('permission', 1);
    }

    public function tags(){
    	return $this->belongsToMany(Tag::class, 'course_tags')->where('permission', 1);
    }
    
    public function questions(){
        return $this->belongsToMany(Question::class, 'quizzes');
    }

    public function videos(){
        return $this->hasMany('App\Models\Video');
    }

    // This function to get first video in course
    public function first_video(){
        return $this->hasMany('App\Models\Video')->limit(1);
    }

    // This function to select id by name
    public function getIdByName($query, $q) {
            return $query->select('id')->where('course_name', $q);
    }

    public function file(){
        return $this->hasMany(File::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'test_results');
    }

    public function users_course(){
        return $this->belongsToMany(User::class, 'user_courses');
    }

}
