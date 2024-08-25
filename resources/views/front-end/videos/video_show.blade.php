@php $url = getYoutubeId($watch->youtube) @endphp
@php $views = thousandsCurrencyFormat($watch->views) @endphp
<iframe width="100%" 
		height="450" 
		src="https://www.youtube.com/embed/{{$url}}?rel=0" 
		frameborder="0" 
		allowfullscreen="1" 
		title="YouTube video player">

</iframe>
<label style="float: right;" class="description">
	{{ $views }}  
	<i class="fa fa-eye" aria-hidden="true"></i> 
	Views
</label>

<style type="text/css">
	.heartlike :hover{
		color: red;
	}
	.liked{
		color: red;
	}
</style>

<label  style="float: right; margin-right: 5px;" class="description heartlike">
	<strong id="count2">{{ $watch->likes->count() ?: 0 }}</strong>
	@auth
		<button type="button" 
				id="likeButton"
				style="background: transparent;border: none; outline: none; cursor: pointer;" 
				class="{{ $watch->isLikedBy(currentuser()) ? 'liked' : '' }}" 
				onclick="likeVideo({{ $watch->id }})">
			<i class="fa fa-heart" aria-hidden="true" style="font-size: 18px;"></i> Like
		</button>
	@else
		<a href="{{ route('login') }}" style="color: #9A9A9A;">
			<i class="fa fa-heart" aria-hidden="true" style="font-size: 18px;"></i> Like
		</a>
	@endauth
		|
</label>

<p class="pVideo">
    Lesson : 
</p>

<p class="description videoDisc">
	{{ $watch->video_name }} 
	<i class="fa fa-angle-double-right" aria-hidden="true"></i> 
	<a href="#transcript" class="a">Lesson Transcript</a>
</p>

<p class="pVideo">
	Description :
</p>

<div style="margin-bottom: 20px;">
	{!! $watch->video_desc !!}
</div>
