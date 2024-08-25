<form method="post" action="{{ route('comments.store') }}" id="comment">
	@csrf
	<input type="hidden" name="video_id" value="{{ $row->id }}">
	@include('back-end.comments.form')<br>
	<button type="submit" class="btn btn-primary pull-right" id="add_comment">Add Comment <i class="material-icons right">send</i></button>
</form>