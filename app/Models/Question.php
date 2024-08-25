<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'score'];


    public function courses(){
    	return $this->belongsToMany(Course::class, 'quizzes');
    }

    public function options(){
    	return $this->hasMany(QuestionOption::class);
    }
}

