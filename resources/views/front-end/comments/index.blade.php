<div class="row">
    <div class="col-md-12">
    <hr>
    @guest
    <p style="float: right;" class="p">
    Please <a href="{{ route('login') }}" class="btn btn-danger btn-sm">Login</a> To Add Comment
    </p>
    @else
    @endguest
    <p class="cm-header">
        <span id="count">0</span> Comments&nbsp;<i class="fa fa-comments" aria-hidden="true"></i>
    </p><hr>
    </div>
</div> 
<div id="comments-body" style="margin-bottom: 20px;">
    <input type="hidden" id="watchid" value="{{ $watch->id }}" readonly="readonly">
    <input type="hidden" id="authId" value="{{ auth()->id() ?: '' }}" readonly="readonly">
</div>