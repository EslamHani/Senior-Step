<div class="card card-nav-tabs filter list-videos-title">
    <div class="card-header card-header-danger" style="font-weight: bold;">
       <i class="fa fa-list" aria-hidden="true"></i>
       Course Content

       <!-- Archive Coures Button -->
       @include('front-end.videos.archive-button')

    </div>
    <ul class="list-group {{ $videos->count() > 9 ? 'list-group-videos' : '' }} list-group-flush">
        @php $course_name = str_replace(' ', '_', $course->course_name) @endphp
        @foreach($videos as $video)
            @php $video_name = str_replace(' ', '_',  $video->video_name) @endphp
            <a href="{{route('course.videos', ['course_name'=> $course_name, 'video_name' => $video_name])}}" 
                class="a"
            >
                <li class="list-group-item {{ link_active($watch->video_name, $video->video_name) }}">
                    <div style="float: left;">
                        @if($watch->video_name == $video->video_name)
                            <i class="fa fa-play-circle" aria-hidden="true" style="font-size: 13px;"></i>
                        @endif
                        <label class="listNum">
                            {{ $loop->iteration }} - 
                        </label>
                    </div>

                    <div class="videos_list">
                        {{ substr($video->video_name,0, 17) }} {{ strlen($video->video_name) > 17 ? '...' : '' }}  
                    </div>

                    <div style="float: right;">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <label class="listTime">
                            {{ $video->time }}
                        </label>
                    </div>
                </li>
            </a>
        @endforeach
    </ul>
</div>
