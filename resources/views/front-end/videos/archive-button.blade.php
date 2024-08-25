@if(auth()->user())
    @php $archived = "" @endphp
    @foreach(auth()->user()->courses_user()->get() as $course_id)
        @if($course_id->id == $course->id)
            @php $archived = $course->id @endphp
        @endif
    @endforeach
    <a href="{{ route('unarchive', ['course_id' => $course->id]) }}">
    <button type="button" 
        class="archCourse"  
        id="unarchiveCourse" 
        onclick="unarchiveCourse({{$course->id}})"  
        {{ $archived !== $course->id ? 'hidden' : '' }}>
            <i class="fa fa-check-square" aria-hidden="true" style="float: right; margin-top: 6px" title="Unarchive This Course"></i>
    </button>
 
    <a href="{{ route('archive', ['course_id' => $course->id]) }}">
    <button type="button" 
        class="archCourse" 
        id="archiveCourse" 
        onclick="archiveCourse({{$course->id}})" 
        {{ $archived == $course->id ? 'hidden' : '' }}>
            <i class="icon-app_lesson_queued" aria-hidden="true"></i>
            <i class="fa fa-plus-square" aria-hidden="true" style="float: right; margin-top: 6px;" title="Archive This Course"></i>
    </button>
@endif

