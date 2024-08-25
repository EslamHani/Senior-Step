<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ReplayComment;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
    }

    public function index($id){
    	if(request()->ajax()){
    		$comments = Comment::with(['user', 'replies'])->where('video_id', $id)->latest()->get();
            
    		return response()->json($comments);
    	}
    	return back();
    }

    public function store(){
    	if(request()->ajax()){

    		$attributes = request()->validate([
    			'comment' => ['required', 'string', 'max:500'],
				'video_id' => ['required', 'integer'],
    		]);


    		$newComment = Comment::create([
    			'comment' => $attributes['comment'],
    			'video_id' => $attributes['video_id'],
    			'user_id'  => auth()->id()
    		]);

    		$comment = Comment::with(['user', 'replies'])
    							->where('video_id', $attributes['video_id'])
    							->where('id', $newComment->id)
    							->get();
    		return response()->json($comment);
    	}

    	return back();	
    }

    public function edit($id){
    	if(request()->ajax()){
    		$comment = Comment::findOrFail($id);
    		return response()->json($comment);
    	}
    	return back();
    }

    public function editReply($id){
        if(request()->ajax()){
            $reply = ReplayComment::with('comment')->findOrFail($id);
            return response()->json($reply);
        }
        return back();
    }

    public function update($id){
    	if(request()->ajax()){
    		$attributes = request()->validate([
    			'comment' => ['required', 'string', 'max:500'],
				'video_id' => ['required', 'integer'],
    		]);

    		$editComment = Comment::findOrFail($id);


    		$editComment->update([
    			'comment' => $attributes['comment'],
    			'video_id' => $attributes['video_id'],
    			'user_id'  => auth()->id()
    		]);

    		$comment = Comment::with(['user', 'replies'])
    							->where('video_id', $attributes['video_id'])
    							->where('id', $editComment->id)
    							->get();
    		return response()->json($comment);
    	}
    	return back();
    }


    public function updateReply($id){
        if(request()->ajax()){
            $attributes = request()->validate([
                'replay_comment' => ['required', 'string', 'max:500'],
                'video_id' => ['required', 'integer'],
            ]);

            $editReply = ReplayComment::findOrFail($id);


            $editReply->update([
                'replay_comment' => $attributes['replay_comment'],
                'user_id'  => auth()->id()
            ]);

            $reply = ReplayComment::with('user')
                                ->where('id', $editReply->id)
                                ->get();

            return response()->json($reply);
        }
        return back();

    }

    public function destroy($id){
    	if(request()->ajax()){
    		$deletecomment = Comment::findOrFail($id);
    		$comment = Comment::with('user')
    							->where('video_id', $deletecomment->video_id)
    							->where('id', $id)
    							->get();

    		$deletecomment->delete();

    		return response()->json($comment);
    	}
    	return back();
    }

    public function destroyReply($id){
        if(request()->ajax()){
            $deletecommentReply = ReplayComment::findOrFail($id);
            $reply = ReplayComment::with(['user', 'comment'])
                                ->where('id', $deletecommentReply->id)
                                ->get();
            $deletecommentReply->delete();
            return response()->json($reply);
        }
        return back();
    }

}
