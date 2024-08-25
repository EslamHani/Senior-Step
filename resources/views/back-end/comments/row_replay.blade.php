<tr>
	<td colspan="3">
		<div  style="margin-left: 60px;">
			<img src="{{ url($replay->user->image) }}" style="width: 50px; height: 50px; border-radius: 50px; ">
			<div style="padding:4px; border-radius:25px; display: inline; ">
				<strong>{{ $replay->user->name }}</strong>&nbsp;
				<label>{{ $replay->created_at->diffForHumans() }}</label>
			</div>
			<div style="width: 65%; overflow-wrap: break-word; padding:10px; border-radius: 25px; margin: -12px 0 0 60px; background-color: #ebebeb; border-radius: 0 25px 25px 25px; ">
				{{ $replay->replay_comment }}
			</div>
		</div>
	</td>
	<td colspan="1" class="td-actions text-right">
		<form action="{{ route('replay.destroy', ['id' => $replay->id]) }}" method="post">
			@csrf
			@method('delete')
			<button type="submit" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove Comment">
			<i class="material-icons">close</i>
			</button>
		</form>
	</td>
</tr>

