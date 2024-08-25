<div class="row">
  <div class="col-md-9">
    <div class="card">
      <div class="card-header card-header-primary">
        <div class="row">
            <div class="col-md-8">
              <h4 class="card-title">{{ $PageTitle }}</h4>
              <p class="card-category">{{ $PageDescription }}</p>
          </div>
          <div class="col-md-4 text-right">
            <a href="{{ route($routeName.'.index') }}" class="btn btn-white btn-round">
                Back<div class="ripple-container"></div>
             </a>
            </div>
        </div>
      </div>
      <div class="card-body">
        {{$slot}}
      </div>
    </div>
  </div>
</div>