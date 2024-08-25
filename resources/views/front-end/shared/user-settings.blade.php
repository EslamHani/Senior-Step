@can('profile-permissions', $user)
<div class="setting1" style="text-align: center;">
    <a href="{{ route('discussions.create') }}" class="btn btn-outline-default btn-round setting2">
        New Discission
    </a>
    <a href="{{ route('userCourses', $user) }}" class="btn btn-outline-default btn-round setting2">
        WatchList
    </a>
    <a href="{{ route('userProfileEdit', $user) }}" class="btn btn-outline-default btn-round setting2">
        Settings
    </a>
    <a href="{{ route('todos.index') }}" class="btn btn-outline-default btn-round setting2">
        Todo List
    </a>
    <a href="{{ route('notifications', $user) }}" 
       class="btn btn-outline-default btn-round setting2" 
       style="position: relative;">
        Notifications

        @if(currentuser()->unreadNotifications->count() > 0)
            <span class="notificationsCount">
                +{{ currentuser()->unreadNotifications->count() }}
            </span>
        @endif
    </a>
</div>
@endcan