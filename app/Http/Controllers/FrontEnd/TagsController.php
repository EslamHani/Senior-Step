<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Tag;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /* This function to return all videos of one Tag */
    public function CoursesOfTags(){
        $tag_name = str_replace("_", " ", request()->input('tag_name'));
        $tag = Tag::where('permission', 1)->where('tag_name', $tag_name)->firstOrFail();
        $id = $tag->id;
        $courses = Course::whereHas('tags', function($query) use($id) {
            $query->where('tag_id', $id);
        })->where('permission', 1)->orderBy('id', 'desc')->paginate(40);
        return view('front-end.tags.index', compact('tag', 'courses'));
    } 
}
