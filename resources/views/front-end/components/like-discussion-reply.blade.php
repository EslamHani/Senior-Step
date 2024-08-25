<div class="discLike">
    @auth
        @if($model->users->count() != 0)
            <div class="dropdown">

                <form method="POST" action="{{ route($routeName.'.like', $model) }}">
                    @csrf
                    <button type="submit" class="likebutton" style="outline: none;">
                        <span class="discReply" style="margin-right: 5px; {{ $model->isLikedBy(currentuser()) ? 'color: #d94040;' : '' }}">
                            <i class="fa fa-heart" aria-hidden="true"></i>  
                            {{ $model->likes->count() }}
                        </span>
                    </button>
                </form>

                <div class="dropdown-content">
                    @foreach($model->users as $user)
                        <a href="{{ route('userprofile', $user) }}">                    
                            <span class="u-likes">
                               {{ substr($user->name,0, 10) }}{{ strlen($user->name) > 10 ? '...' : '' }}
                            </span>
                        </a>
                    @endforeach
                </div>

            </div>
        @else

            <form method="POST" action="{{ route($routeName.'.like', $model) }}">
                @csrf
                <button type="submit" class="likebutton" style="outline: none;">
                    <span class="discReply" style="margin-right: 5px; {{ $model->isLikedBy(currentuser()) ? 'color: #d94040;' : '' }}">
                        <i class="fa fa-heart" aria-hidden="true"></i>  
                        {{ $model->likes->count() }}
                    </span>
                </button>
            </form> 

        @endif
        
    @else

        @if($model->users->count() != 0)
            <div class="dropdown">
                <a href="{{ route('login') }}" target="_self">
                    <span class="discReply" style="margin-right: 5px;">
                            <i class="fa fa-heart" aria-hidden="true"></i>  
                            {{ $model->likes->count() }}
                    </span>
                </a>
                <div class="dropdown-content">
                    @foreach($model->users as $user)
                        <a href="{{ route('userprofile', $user) }}">                    
                            <span class="u-likes">
                               {{ substr($user->name,0, 10) }}{{ strlen($user->name) > 10 ? '...' : '' }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" target="_self">
                <span class="discReply" style="margin-right: 5px;">
                        <i class="fa fa-heart" aria-hidden="true"></i>  
                        {{ $model->likes->count() }}
                </span>
            </a>
        @endif

    @endauth
</div> 