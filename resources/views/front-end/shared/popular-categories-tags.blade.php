<div class="col-lg-4 col-md-4 col-sm-12" >
    <div class="card card-nav-tabs">
        <div class="card-header card-header-danger p">
            <i class="fa fa-university" aria-hidden="true"></i> Popular Categories 
        </div>
        <ul class="list-group list-group-flush">
            @foreach($all_categories as $category)
                @php $category_name = str_replace(" ", "_",  $category->category_name) @endphp
                <a href="{{ route('category.courses', ['category_name' => $category_name]) }}" target="_self">
                    <li class="list-group-item">{{ $category->category_name }}</li>
                </a>
            @endforeach
        </ul>
    </div>

    <div>
        <div class="card card-nav-tabs">
            <div class="card-header card-header-danger p">
                <i class="fa fa-tags" aria-hidden="true"></i> Popular Tags 
            </div>
            <ul class="list-group list-group-flush">
                @foreach($all_tags as $tag)
                    @php $tag_name = str_replace(" ", "_",  $tag->tag_name) @endphp
                    <a href="{{ route('frontend.tags', ['tag_name' => $tag_name]) }}" target="_self">
                        <li class="list-group-item">{{ $tag->tag_name }}</li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div> 
</div>