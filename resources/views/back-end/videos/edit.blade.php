@extends('back-end.layout.app')

<!-- Meta Title -->
@section('title')
	{{ $PageTitle }}
@endsection

@push('css')
<script src="https://cdn.tiny.cloud/1/s75hit7ybx0ssacci8e1p28qmpspejkhrjf6md7ukc0tinpp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
		selector: 'textarea',
		height: 400,
		menubar: true,
		plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
		powerpaste_allow_local_images: true,
		powerpaste_word_import: 'prompt',
		powerpaste_html_import: 'prompt',
		content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
	});
	tinymce.activeEditor.execCommand('mceCodeEditor');
</script>
@endpush

@section('content')
<!-- NavBar -->
@component('back-end.layout.header', ['nav' => $PageTitle])
@endcomponent
<!-- End NavBar -->

@component('back-end.shared.edit', ['PageTitle' => $PageTitle, 'PageDescription' => $PageDescription, 'routeName' => $routeName, 'show' => 1])
@slot('slot')
<form action="{{ route($routeName.'.update', ['id' => $row->id]) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('put')
	@include('back-end.'.$folderName.'.form')
  <button type="submit" class="btn btn-primary pull-right">Update {{ $ModulName }}</button>
  <div class="clearfix"></div>
</form>
@endslot
@slot('profile_card')
<div class="col-md-4">
	<div class="card card-profile">
		@php $url = getYoutubeId($row->youtube) @endphp
	  	<div class="card-body">
	    	<iframe width="100%" height="350" src="https://www.youtube.com/embed/{{$url}}" frameborder="0" allowfullscreen>
            </iframe>
		</div>
	</div>	
</div>
@endslot
@endcomponent

@component('back-end.shared.edit', ['PageTitle' => "Control Comments", 'PageDescription' => "Here You Can Edit / Delete / Add Comment", 'routeName' => $routeName, 'show' => 1, 'back' => 1])
@slot('slot')
	@include('back-end.comments.index')
@endslot
@slot('profile_card')
<div class="col-md-4">
	<div class="card card-profile">
	  	<div class="card-body">
	    	@include('back-end.comments.create')
		</div>
	</div>	
</div>
@endslot
@endcomponent

@endsection
@push('js')
<script type="text/javascript">

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$(document).on('click', '#add_comment', function(){
		var form = $('#comment').serialize();
		var url  = $('#comment').attr('action');
		$.ajax({
			url: url,
			dataType: 'json',
			data: form,
			type: 'post',
			beforeSend: function(){
				$('.error_data strong').empty();
			},success: function(data){
				if(data.status == true){
					$('#list_comments #com').prepend(data.result);
					$('#comment')[0].reset();
					$('#list_comments').load();
				}
			},error: function(data_error, exception){
				if(exception == "error"){
					var error_list = "";
					$.each(data_error.responseJSON.errors, function(index, v){
						error_list += v;
					});
					$('.error_data strong').html(error_list);
				}
			}
		});
		return false;
	});

	function replayComment($id){
		var replay_comment = $('#replay_comment_'+$id).val();
		var id = $id;
		var url  = $('#commentReplay_'+$id).attr('action');
		$.ajax({
			type: "POST",
			dataType: "json",
			data: {replay_comment: replay_comment, comment_id: id},
			url: url,
			success: function(response){
				if(response.status == true){
					$('#list_comments  #replay_com_'+$id).prepend(response.result);
					$('#commentReplay_'+$id)[0].reset();
					$('#replay_'+$id).slideToggle();
					$('#list_comments').load();
				}	
			}
		});
		return false;
	}

	function showReplay($id){
		$('#replay_com_'+$id).slideToggle(); 
	}
</script>
@endpush