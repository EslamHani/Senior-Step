<div class="row" style="margin-top: -20px;">
    <div class="col-md-12">
        <a class="btn btn-danger active second" href="#watch">
            <i class="fa fa-youtube-play" aria-hidden="true" style="font-size: 16px;"></i>&nbsp;Watch
        </a>
        @php $name = str_replace(' ', '_', $course->course_name) @endphp
        <a class="btn btn-danger second" href="{{ route('quickquiz', ['course' => $name]) }}">
            <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 16px;"></i>&nbsp;Quiz
        </a>
        <a class="btn btn-danger second" href="{{ route('show.files', ['course' => $name]) }}">
            <i class="fa fa-file-text" aria-hidden="true" style="font-size: 16px;"></i>&nbsp;References
        </a>
    </div>
</div><hr><br>