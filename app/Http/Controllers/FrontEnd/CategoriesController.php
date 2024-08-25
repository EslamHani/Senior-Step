<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /* This function to view all categories */
    public function categories(){
        $categories = Category::where('permission', 1)->orderBy('created_at', 'desc')->paginate(30);
        return view('front-end.categories.index', compact('categories'));
    }


    /* This function to view all courses of specific category */
    public function coursesOfCategory($category_name){
        $category_name = str_replace("_", " ", $category_name);
        $category = Category::where('permission', 1)->where('category_name', $category_name)->firstOrFail();
        $courses  = Course::where('permission', 1)->where('cat_id', $category->id)->orderBy('created_at', 'desc')->paginate(40);
        return view('front-end.courses.index', compact('courses', 'category'));
    }
}
