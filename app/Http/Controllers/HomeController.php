<?php

namespace App\Http\Controllers;


use App\Models\Page;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* This function to view main website page */
    public function home(){
        $categories = Category::where('permission', 1)->inRandomOrder()->paginate(6);
        $courses    = Course::where('permission', 1)->inRandomOrder()->paginate(8);
        return view('welcome', compact('categories', 'courses'));
    }

    /* To View latest pages added */
    public function viewpage($slug){
        $page_name = str_replace("_", " ", $slug);
        $page = Page::where('permission', 1)->where('page_name', $page_name)->firstOrFail();
        return view('front-end.pages.index', compact('page'));
    }  

    public function aboutUs(){
        return view('front-end.about-us.index');
    }    
}