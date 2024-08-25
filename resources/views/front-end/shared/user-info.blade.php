<div class="profileUserInfo">
    <p class="info">
        <i class="fa fa-user" aria-hidden="true"></i> 
        {{ $user->permission  == 1 ? 'Admin' : 'User' }}
    </p>
    <p class="info">
        <i class="fa fa-globe" aria-hidden="true"></i>
        <span id="coun">{{ $user->country }}</span>
    </p>
    <p class="info">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        <span id="add"> {{ $user->address }}</span>
    </p>
     <p class="info">
        <i class="fa fa-level-up" aria-hidden="true"></i> 
        Level {{ $user->level }} 
    </p>
    <p class="info">
        <i class="fa fa-star" aria-hidden="true"></i> 
        {{ $points }} Points
    </p>
    <p class="info">
        <i class="fa fa-users" aria-hidden="true"></i>
        {{ $user->followers()->count() }} Followers
    </p>
</div>