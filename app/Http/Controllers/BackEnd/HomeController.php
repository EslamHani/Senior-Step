<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video;
use App\Models\Message;
use App\Models\Comment;
use DB;

class HomeController extends BackEndController
{
	public function __construct(User $model){
		parent::__construct($model);
        $this->middleware('auth');
	}
	
    public function index(){
    	$users 	  = User::orderBy('created_at', 'desc')->paginate(6);
    	$messages = Message::orderBy('created_at', 'desc')->paginate(6);
    	$comments =	Comment::with('user', 'video')->orderBy('created_at', 'desc')->paginate(20);

        // User HighCharts //
        $usersCountChart = $this->usersHighChart();

        // Video BarCharts //
        $videosCountChart = $this->videosBarChart();

    	return view('back-end.home', 
            compact('users', 'messages', 'comments', 'usersCountChart', 'videosCountChart'));
    }


    public function usersHighChart()
    {
        $users = User::select(DB::raw("count(*) as count"))
                            ->whereYear('created_at', date('Y'))
                            ->groupBy(DB::raw('Month(created_at)'))
                            ->pluck('count');

        $months = User::select(DB::raw("Month(created_at) as month"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('month');

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index => $month)
        {
            $datas[$month-1] = $users[$index];
        }

        return $datas;
    }
 
    public function videosBarChart()
    {
        $videos = Video::select(DB::raw("COUNT(*) as count"))
                        ->whereYear('created_at', date('Y'))
                        ->where('permission', 1)
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('count');

        $months = Video::select(DB::raw("Month(created_at) as month"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw('Month(created_at)'))
                        ->pluck('month');

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index => $month)
        {
            $datas[$month-1] = $videos[$index];
        }

        return $datas;
    }
}
