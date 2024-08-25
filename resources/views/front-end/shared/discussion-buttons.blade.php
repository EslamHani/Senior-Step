<div class="form-group">
    <button type="submit" class="btn btn-danger">
        {{ $button }} <i class="fa fa-paper-plane" aria-hidden="true"></i>
    </button>
    <a href="{{ route('userprofile', ['user' => currentuser()->id]) }}" target="_self" class="btn btn-outline-danger">
        Cancel <i class="fa fa-undo" aria-hidden="true"></i>
    </a>
</div>