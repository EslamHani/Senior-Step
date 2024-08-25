@auth
<div class="friends">
    <p style="font-weight: bold; font-size: 25px;">Following</p>
    <nav class="nav nav-pills flex-column">
        @forelse(auth()->user()->follows as $user)
        <a class="nav-link" href="{{ route('userprofile', $user) }}">
            <img src="{{ $user->image }}"  width="50" height="50" alt="" style="border-radius: 50px;">
            <span style="font-size: 14px;">{{ substr($user->name, 0, 15) }}{{ strlen($user->name) > 15 ? '...' : '' }}</span>
        </a>
        @empty
        <strong>No Following yet!</strong>
        @endforelse
    </nav>
</div>
@endif