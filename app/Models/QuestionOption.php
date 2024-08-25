<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $fillable = ['question_id', 'option_text', 'correct'];

    public function questions(){
    	return $this->belongsTo('App\Models\Question');
    }
}
