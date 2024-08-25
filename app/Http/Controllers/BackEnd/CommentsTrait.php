<?php
namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\ReplayComment;
use App\Http\Requests\BackEnd\Comments\Store;
trait CommentsTrait{

	public function CommentStore(Store $request){
		if($request->ajax()){
			$requestArray = $request->all();
			$requestArray['user_id'] = auth()->user()->id;
			$comment = Comment::create($requestArray);
			$html = view('back-end.comments.row', ['comment' => $comment])->render();
			return response(['status' => true, 'result' => $html]);
		}else{
			return back();
		}
	}

	public function replayComment(){
		if(request()->ajax()){
			$data = $this->validate(request(), [
				'replay_comment' => ['required', 'string'],
			]);
			$data['comment_id'] = request()->input('comment_id');
			$data['user_id'] = auth()->user()->id;
			$replay = ReplayComment::create($data);
			$html = view('back-end.comments.row_replay', ['replay' => $replay])->render();
			return response(['status' => true, 'result' => $html]);
		}else{
			return back();
		}
	}

	public function CommentDestroy($id){
		$row = Comment::findOrFail($id);
		$row->delete();
		//if delete btn clicked in main home (dashboard)
		if(request()->has('delete_btn')){
			return back();
		}
		return redirect()->route('videos.edit', ['id' => $row->video_id, '#list_comments']);
	}

	public function deleteReplayComment($id){
		$row = ReplayComment::findOrFail($id);
		$row->delete();
		return redirect()->to(url()->previous() . '#list_comments');
	}

	public function updateComment($id, Request $request){
		$row = Comment::findOrFail($id);
		$requestArray = $this->validate(request(), [
			'comment' => ['required', 'min:3'],
		]);
		$row->update($requestArray);
		return redirect()->route('videos.edit', ['id' => $row->video_id, '#list_comments']);
	}
}