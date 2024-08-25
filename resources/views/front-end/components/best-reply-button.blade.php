@can('discussion-permissions', $discussion)
    <form method="POST" action="{{ route('bestReply', ['discussionreply' => $reply->id]) }}" class="CreateBestReply">
        @csrf
        <button type="submit" class="btn btn-{{ $discussion->best_reply_id == $reply->id ? '' : 'outline-' }}success btn-round btn-sm" style="font-size: 10px;">
        Best Answer</button>
    </form>
@endcan

@cannot('discussion-permissions', $discussion)
    @if($discussion->best_reply_id == $reply->id)
        <button type="submit" class="btn btn-success btn-round btn-sm BestReply">
            Best Answer
        </button>
    @endif
@endcannot