<div class="sidebar" style="border: 1px solid gray; width: 100%; border-radius: 10px; padding: 10px;">
    <a 	href="{{ route('discussions.index') }}" 
    	class="{{  request('answer') || request('popular') || request('cat') || request('favorite') || request('fresh') ? '' : 'sidebaractive' }}">
    	<i class="fa fa-question-circle" aria-hidden="true"></i> All Questions
    </a>

    <a 	href="{{route('discussions.index', ['answer' => 1])}}" 
    	class="{{ request('answer') == 1 ? 'sidebaractive' : ''}}">
    	<i class="fa fa-check-square" aria-hidden="true"></i> Solved
    </a>

    <a 	href="{{ route('discussions.index', ['answer' => 2]) }}" 
    	class="{{ request('answer') == 2 ? 'sidebaractive' : '' }}">
    	<i class="fa fa-window-close" aria-hidden="true"></i> Unsolved
    </a>

    @auth
    <a  href="{{ route('discussions.index', ['favorite' => 1]) }}" 
        class="{{ request('favorite') == 1 ? 'sidebaractive' : '' }}">
        <i class="fa fa-users" aria-hidden="true"></i> Following
    </a>
    @endauth

    <a  href="{{ route('discussions.index', ['fresh' => 1]) }}" 
        class="{{ request('fresh') == 1 ? 'sidebaractive' : '' }}">
        <i class="fa fa-reply" aria-hidden="true"></i> No Replies Yet
    </a>

    <a 	href="{{route('discussions.index', ['popular' => 1])}}" 
    	class="{{ request('popular') == 1 ? 'sidebaractive' : ''}}">
    	<i class="fa fa-star" aria-hidden="true"></i> Popular This Week
    </a>

    <a  href="{{route('discussions.index', ['popular' => 2])}}" 
        class="{{ request('popular') == 2 ? 'sidebaractive' : ''}}">
        <i class="fa fa-star" aria-hidden="true"></i> Popular This Month
    </a>
</div>
