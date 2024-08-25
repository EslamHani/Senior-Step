@section('background-image')
<div class="page-header-1 section-dark" style="background-image: url('{!! asset('/frontend/img/gray.jpg') !!}')">
<div class="filter"></div>
    <div class="container">
    	<div class="col-md-4" style="margin-top: 200px;">
    		<a href="{{ route('landing') }}" style="font-weight: bold; color: white;">Home</a>
    		<span style="font-weight: bold; color: #f5593d;"> / {{ $CurrentPage }}</span>
    	</div>
        <div class="col-md-10 offset-md-2">
        @include('front-end.search.form')
        </div>
    </div>
</div>
@endsection