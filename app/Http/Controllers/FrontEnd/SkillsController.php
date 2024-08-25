<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Skill;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillsController extends Controller
{
    /* This function to return all videos of one skill */
    public function CoursesOfSkill(){
        $skill_name = str_replace("_", " ", request()->input('skill_name'));
        $skill = Skill::where('permission', 1)->where('skill_name', $skill_name)->firstOrFail();
        $id = $skill->id;
        $courses = Course::whereHas('skills', function($query) use ($id) {
            $query->where('skill_id', $id);
        })->where('permission', 1)->orderBy('id', 'desc')->paginate(40);
        return view('front-end.skills.index', compact('skill', 'courses'));
    }
}
