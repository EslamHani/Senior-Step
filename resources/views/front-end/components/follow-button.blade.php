 @cannot('profile-permissions',  $user)
    <form method="POST" action="{{ route('FollowUser', $user) }}">
        @csrf
        <button type="submit" class="btn btn-outline-default btn-round" style="width: 100%">
            {{ currentuser()->following($user) ? 'UnFollow Me' : 'Follow Me' }}
        </button>
    </form>
    <br>
@endcannot