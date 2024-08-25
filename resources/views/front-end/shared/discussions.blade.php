
@forelse($discussions as $discussion)
<div class="disc1">
    <div class="discImg">
        <div class="showImg">
            <a href="{{ route('userprofile', $discussion->user) }}">
                <img  src="{{ url($discussion->user->image) }}"  
                      width="50"
                      height="50" 
                      alt="User Image" 
                      style="border-radius: 50px;">
            </a>

            <span class="showLevel">
                Level {{ $discussion->user->level }}
            </span>
        </div>
    </div>

    <a href="{{ route('userprofile', $discussion->user) }}">
        <strong class="showName">
           {{ $discussion->user->name }}
        </strong>
    </a>
    
    <strong class="discDot">
      .
    </strong>

    <span class="discDate">
      {{ $discussion->created_at->diffForHumans() }}
    </span>

    <a href="{{ route('discussions.index', ['cat' => $discussion->category->category_name]) }}" class="btn btn-outline-danger btn-round btn-sm discCat">
            {{ $discussion->category->category_name }}
    </a>

    <div class="alert alert-primary showTitle">
        @php $disc = str_replace(' ', '-', $discussion->title)  @endphp
        <a href="{{ route('discussions.show', $disc) }}" target="_self" class="title-anchor"> 
            <p class="titledisc">
                {{ substr($discussion->title, 0, 60) }}{{ strlen($discussion->title) > 60 ? '...' : '' }}
            </p>
        </a>
    </div>

    <div class="discDivBody">
        <a href="{{ route('discussions.show', $disc) }}" target="_self" class="title-anchor"> 
            <p class="discBody">
                {{ substr(strip_tags($discussion->body), 0, 200) }}
                {{ strlen(strip_tags($discussion->body)) > 200 ? '...' : '' }}
            </p>
        </a>
      
        <span class="discView">
            <i class="fa fa-eye" aria-hidden="true"></i> {{ $discussion->views }}
        </span>

        <span class="discReply">
            <i class="fa fa-comments" aria-hidden="true"></i> {{ $discussion->discussionreplies->count() }}
        </span>

        <span class="discReply" 
            style="margin-right: 5px; 
            {{  currentuser() && $discussion->isLikedBy(currentuser()) ? 'color: #d94040;' : ''  }}"
        >
            <i class="fa fa-heart" aria-hidden="true"></i>  
            {{ $discussion->likes->count() }}
        </span>

        @can('profile-permissions', $discussion->user)
            @include('front-end.shared.Delete-Edit-discussion', [
                'edit' => '',
                'routeName' => 'discussions',
                'parameter' => $discussion,
            ])
        @endcan

        @if(!is_null($discussion->best_reply_id))
            <button class="btn btn-outline-info btn-round btn-sm discSolve">
                <i class="fa fa-check" aria-hidden="true"></i>Solved
            </button>
        @endif  
    </div>
</div><br>
@empty
<div class="disc1">
    <center>
        <p class="discEmpty">No Discussions Yet</p>
    </center>
</div>
@endforelse
{{ $discussions->appends(request()->query())->links() }}