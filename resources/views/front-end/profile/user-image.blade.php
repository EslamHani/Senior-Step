<div class="owner">
    <div class="avatar">
        <img src="{{ url($user->image) }}" 
        	 id="myImg"  
        	 alt="{{  $user->name }}" 
        	 width="200" 
        	 height="150" 
        	 class="img-circle img-no-padding img-responsive" 
        	 style="width: 300px; filter: brightness(100%);"
        >
    </div>
    <div class="name">
        <h5 class="title UserName">
        	{{ $user->name }}
        </h5>
        <p class="bio">
        	{{ $user->bio }}
        </p><br>
    </div>
</div>