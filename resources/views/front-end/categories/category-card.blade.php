<div class="col-lg-4 col-md-6 col-sm-12">
	<div class="card text-left">
		@php $category_name = str_replace(" ", "_", $category->category_name) @endphp
		<a href="{{ route('category.courses', ['category_name' =>  $category_name ]) }}" target="_self">
		<img class="card-img-top" src="{{url($category->image)}}" alt="Category image" style="max-height:180px;">
		<div class="card-body">
  			<h5 class="card-title category-name">
  				{{ $category->category_name }}
  			</h5>
  			<p class="card-text p">
  				<strong>Total Courses : {{ $category->courses->count() }}</strong>
  			</p>
		</div>
		</a>
	</div>
</div>