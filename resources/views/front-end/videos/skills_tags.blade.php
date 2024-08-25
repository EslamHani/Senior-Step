<br>
<div class="card" style="width: 100%;">
	<div class="card-body">
		<p class="card-title" style="margin-bottom: 6px; font-family: 'Amiri', serif;">
			<i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Skills
		</p>
		@foreach($course->skills()->get() as $skill)
			@php $skill_name = str_replace(' ', '_', $skill->skill_name) @endphp
			<a href="{{ route('frontend.skills', ['skill_name' => $skill_name ]) }}" target="_self">
				<span class="label label-primary">{{ $skill->skill_name }}</span>
			</a>
		@endforeach
		<p class="card-title" style="margin-bottom: 6px; font-family: 'Amiri', serif;">
			<i class="fa fa-tags" aria-hidden="true"></i>&nbsp;Tags
		</p>
		@foreach($course->tags()->get() as $tag)
			@php $tag_name = str_replace(' ', '_', $tag->tag_name) @endphp
			<a href="{{ route('frontend.tags', ['tag_name' => $tag_name]) }}" target="_self">
				<span class="label label-default">{{ $tag->tag_name }}</span>
			</a>
		@endforeach
	</div>
</div>