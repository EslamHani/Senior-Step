<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /* This function to return all news  */
    public function news(){
        $news =  Topic::where('permission', 1)->orderBy('created_at', 'desc')->paginate(4);
        $news_count = Topic::where('permission', 1)->get()->count();
        return view('front-end.news.index', compact('news', 'news_count'));
    }

    /* This function to show topic and related topics */
    public function ViewTopic(){
        $id = request()->input('topic');
        $topic = Topic::where('permission', 1)->findOrFail($id);
        $topics = Topic::where('permission', 1)->where('cat_id', $topic->cat_id)->where('id', '!=', $topic->id)->orderBy('created_at', 'desc')->paginate(4);
        return view('front-end.news.show_news', compact('topic', 'topics'));
    }
}
