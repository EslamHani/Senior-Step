<div class="card" style="max-height: 600px">
	@php $course_name = str_replace(' ', '_', $course->course_name) @endphp
	@foreach($course->first_video()->get() as $video)
		@php $video_name = str_replace(' ', '_',  $video->video_name) @endphp
	@endforeach
	<img class="card-img-top" src="{{ url($course->image) }}" alt="course image" style="max-height: 180px; min-height: 180px;">
	<div class="card-body">
	    <h5 class="card-title" style="font-family: serif;" >
	    	{{ $course->course_name }}
	    </h5><br>
	    <p class="card-text p">
	    	{{ substr($course->course_desc, 0 , 79) }}{{ strlen($course->course_desc) > 79 ? "..." : "" }}
	    </p>
	    <hr>
	    <p class="card-text p">
	    	<strong style="margin-bottom: 10px;"> 
	    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Instructor : {{ $course->teacher }}
	    	</strong><br>
	    	<label style="font-size: 14px;">
	    		<i class="fa fa-users" aria-hidden="true"></i> {{ $course->users_course->count() }} Students
	    	</label>&nbsp;|&nbsp;
	    	<label style="font-size: 14px;">
	    		<i class="fa fa-video-camera" aria-hidden="true"></i> {{ $course->videos->count() }} Videos
	    	</label>
	    </p>
	    <a href="{{route('course.videos', ['course_name' => $course_name, 'video_name' => $video_name])}}" target="_self" class="btn btn-danger">Start Course</a>
	</div>
</div>
