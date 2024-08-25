<tr>
	<td colspan="3">
	<div>
		@if($comment->user->image != null)
		<img src="{{ url($comment->user->image) }}" style="width: 50px; height: 50px; border-radius: 50px; ">
		@endif
		<div style="padding:4px; border-radius:25px; display: inline; ">
			<strong>{{ $comment->user->name }}</strong>&nbsp;
			@php $date = time_elapsed_string($comment->created_at) @endphp
			<label>{{ $date }}</label>
		</div>
		<div style="width: 65%; overflow-wrap: break-word; padding:10px; border-radius: 25px; margin: -12px 0 0 60px; background-color: #ebebeb; border-radius: 0 25px 25px 25px; ">
			{{ $comment->comment }}
		</div>
		<button type="button"  rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" onclick="showReplay({{ $comment->id }})" data-original-title="show Replies" style="margin-left: 50px;">Replies
		</button>
	</div>
	</td>
	<td colspan="1" class="td-actions text-right">
		<form action="{{ route('comments.destroy', ['id' => $comment->id]) }}" method="post">
			<button type="button"  rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" onclick="$(this).closest('tr').next('tr').slideToggle('slow')" data-original-title="Edit Comment">
			<i class="material-icons">edit</i>
			</button>
			<button type="button"  rel="tooltip" title="" class="btn btn-info btn-link btn-sm" onclick="$(this).closest('tr').next('tr').next('tr').slideToggle('slow')" data-original-title="Replay Comment">
			<i class="fa fa-reply-all" aria-hidden="true"></i>
			</button>
			@csrf
			@method('delete')
			<button type="submit" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove Comment">
			<i class="material-icons">close</i>
			</button>
		</form>
	</td>
</tr>
<tr style="display: none;">
	<td colspan="4">
		<form  action="{{ route('comments.update', ['id' => $comment->id]) }}" method="post">
			@csrf
			@method('put')
		    @php $input = 'comment' @endphp
		    <div class="col-md-12">
		    <div class="form-group bmd-form-group">
		      <label class="bmd-label-floating">Comment</label>
		      <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($comment->{ $input}) ? $comment->{$input} : old($input)}}" autocomplete="off" required>
		      @error($input)
		          <span class="invalid-feedback" role="alert">
		              <strong>{{ $message }}</strong>
		          </span>
		      @enderror
		    </div>
		    </div>  
			<button type="submit" class="btn btn-primary pull-right">Update Comment <i class="material-icons right">send</i></button>
		</form>
	</td>
</tr>
@php $replay = "replay_".$comment->id @endphp
@php $replay_comment = "replay_comment_".$comment->id @endphp
@php $commentReplay  = "commentReplay_".$comment->id @endphp
<tr style="display: none;" id="{{ $replay }}">
	<td colspan="4">
		<form method="post" action="{{ route('commentsreplay') }}" id="{{ $commentReplay }}">
		    <div class="col-md-12">
		    <div class="form-group bmd-form-group">
		      <label class="bmd-label-floating">Replay Comment</label>
		      <input type="text" class="form-control" id="{{ $replay_comment }}"  autocomplete="off" required>
	          <span class="invalid-feedback" role="alert">
	              <strong></strong>
	          </span>
		    </div>
		    </div>  
			<button type="button" class="btn btn-primary pull-right" onclick="replayComment({{$comment->id}})">Replay Comment <i class="material-icons right">send</i></button>
		</form>
	</td>
</tr>

