<table class="table" id="list_comments" width="100%">
  <tbody id="com">
  	@foreach($comments as $comment)
    	@include('back-end.comments.row')
      @php $replay_com = "replay_com_".$comment->id @endphp
      	<tbody id="{{ $replay_com }}" style="display: none;"> 
        	@foreach($comment->replies()->get() as $replay)
    			   @include('back-end.comments.row_replay')
    		  @endforeach
  		  </tbody>
  	@endforeach
  </tbody>
</table>