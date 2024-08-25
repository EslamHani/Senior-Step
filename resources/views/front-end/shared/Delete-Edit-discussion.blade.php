<div class="dropdown">
    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
    <div class="dropdown-content">
        @isset($edit)
        <a href="{{ route('discussions.edit', $discussion) }}" class="btn btn-link btn-default">
            <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
        </a>
        @endisset
        <form method="POST" action="{{ route($routeName.'.destroy', $parameter) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-link btn-default">
                <i class="fa fa-trash" aria-hidden="true"></i> Delete
            </button>
        </form>
    </div>
</div>