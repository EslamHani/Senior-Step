<input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
<div class="form-group">
    <textarea class="form-control"
              name="discussion_reply"
              id="discussion_reply"
              rows="3"
              placeholder="Write Reply..."
              style="outline: none; border: none;"></textarea><br>
</div>
<div id="replyImageDiv">
    <center>
        <img src="" id="replyImage"  style="border-radius: 10px; width: 95%;">
    </center><br>
</div>
<hr>
<div class="selectImageReply">
    <input type="file" name="image" id="file" class="inputfile" />
    <label for="file"><i class="fa fa-picture-o" aria-hidden="true"></i></label>
</div>
<img src="{{ url(currentuser()->image) }}"
     width="50"
     height="50" 
     style="border-radius: 50px;">
@foreach($errors->all() as $error)
    <span class="errorReply">{{ $error }}</span>
@endforeach


            
             