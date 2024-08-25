<form action="{{ route($routeName.'.destroy', ['id' => $row->id])}}" method="post"  style="display:inline">
@csrf
@method('delete')
<button type="submit" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove {{ $ModulName }}">
<i class="material-icons">close</i>
</button>
</form>