<div class="card" style="width: 100%;">
	<div class="card-body">
		@if($watch->open_comments == 1)
		<form>
			<input type="hidden" id="video_id" value="{{ $watch->id }}" readonly="readonly">
			<input type="hidden" id="commentId" readonly="readonly">
			<div class="form-group">
				<textarea class="form-control" name="comment" id="myText"  rows="7" placeholder="Comment" style="max-height: 195px; min-height: 195px;" required></textarea>
			</div>
			<button type="button" class="btn btn-danger" id="save" onclick="saveData()">Add Comment</button>
			<button type="button" class="btn btn-danger" id="update" onclick="updateData()">Update Comment</button>
			<button type="button" class="btn btn-danger" id="updateReply" onclick="updateCommentReply()">Update Reply</button>
		</form>
		@else
		<p class="cm-6">
			<i class="fa fa-quote-left" aria-hidden="true"></i>
			The Comments are temporarily closed
			<i class="fa fa-quote-right" aria-hidden="true"></i>
		</p>
		@endif
	</div>
</div>
