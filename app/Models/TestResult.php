<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
    	'user_id',
    	'course_id',
    	'score',
    	'correct_answers',
    	'uncorrect_answers'
    ];
}
