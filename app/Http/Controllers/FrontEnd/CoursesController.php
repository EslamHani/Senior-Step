<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\User;
use App\Models\Video;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->only([
            'archivecourse',
            'unarchivecourse',
        ]);
    }

    /* This function return video to show and list of videos */
    public function videosOfCourse($course_name){
        $course_name = str_replace("_", " ", $course_name);
        $video_name  = str_replace("_", " ", request()->input('video_name'));
        $course = Course::where('permission', 1)->where('course_name', $course_name)->firstOrFail();
        $watch  = Video::with('comments.user')->with('likes')->where('permission', 1)->where('video_name', $video_name)->where('course_id', $course->id)->firstOrFail();
        $videoViews = $watch->views + 1;
        $watch->update(['views' => $videoViews]);
        $videos = Video::where('permission', 1)->where('course_id', $course->id)->orderBy('created_at', 'asc')->get();
        $related_courses = Course::where('permission', 1)->where('cat_id', $course->cat_id)->where('id', '!=', $course->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('front-end.videos.index', compact('watch', 'videos', 'course', 'related_courses'));
    }

    /* This function to return all courses and search coureses */
    public function courses(Request $request){
        $search = "";
        if(isset($request->search)){
            $this->validate($request, [
                'search' => ['required', 'min:1'],
            ]);
        }
        $courses = Course::when($request->search, function($query) use ($request){
            return $query->where('course_name', 'like', '%'.$request->search.'%');
        })->where('permission', 1)->orderBy('created_at', 'desc')->paginate(40);
        if($request->has('search') && !empty($request->get('search'))){
            $search = $request->get('search');
        }
        return view('front-end.courses.index', compact('courses', 'search'));
    }


    //Archive Course by ajax
    public function archivecourse($course_id)
    {
        if(request()->ajax())
        {
            $course = Course::where('permission', 1)->findOrFail($course_id);
            $user   = User::findOrFail(auth()->user()->id);
            UserCourse::create(['user_id' => $user->id, 'course_id' => $course->id]);
            return response()->json(['success' => 'This Course has been acrcived successfully']);
        }else{
            return back();
        }
    }

    // UnArchive Course
    public function unarchivecourse($course_id){
        if(request()->ajax())
        {   
            $course = Course::where('permission', 1)->findOrFail($course_id);
            $user   = User::findOrFail(auth()->user()->id);
            $archive = UserCourse::where('user_id', $user->id)->where('course_id', $course->id)->firstOrFail();
            $archive->delete();
            return response()->json(['success' => 'This Course has been unacrcived successfully']);
        }else{
            return back();
        }
    }

    // Like and unlike Video
    public function videoLike($videoId)
    {
        if(request()->ajax())
        {
            $video = Video::findOrFail($videoId);
            $video->like(currentuser());
            $count = $video->likes->count();
            if($video->isLikedBy(currentuser()))
            {
                $isLiked = true;
            }
            else
            {
                $isLiked = false; 
            }
            return response()->json([
                'success' => 'successfully', 
                'count'   => $count,
                'isLiked' => $isLiked,
            ]);
        }
        else
        {
            return back();
        }
    }
}
