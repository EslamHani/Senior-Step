@php $date = date('l jS F Y', strtotime($new->created_at)) @endphp
<img src="{{ url($new->image) }}" alt="" class="d-block w-100" style="max-height: 350px;">
<div class="title" style="margin-top: -10px;">
    <h3 class="h3">{{ $new->title }}</h3>
    <small><i class="fa fa-pencil" aria-hidden="true"></i> {{$new->author }}  &nbsp;/&nbsp;</small>
    <small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $date }}</small>
</div> 
<div style="margin-top: -20px;">
    <p class="p">{{ substr(strip_tags($new->content), 0, 300) }}{{ strlen(strip_tags($new->content)) > 350 ? "..." : "" }}</p>
</div>
 <a  href="{{ route('topic', ['topic' => $new->id]) }}" class="btn btn-danger" style="margin-top: 13px; margin-bottom: 30px;">Read More</a>