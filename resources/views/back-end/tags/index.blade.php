@extends('back-end.layout.app')

<!-- Meta Title -->
@section('title')
	{{ $PageTitle }}
@endsection

@section('content')
@if(session('success'))
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-primary">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
          </button>
          <span>
          <b> Success - {{ session('success') }}</b>
          </span>
      </div>
    </div>
  </div>
</div>
@endif
<!-- NavBar -->
@component('back-end.layout.header', ['nav' => $PageTitle ])
@endcomponent
<!-- End NavBar -->
@component('back-end.shared.table', ['PageTitle' => $PageTitle, 'PageDescription' => $PageDescription])
@slot('add_button')
<div class="col-md-7 text-right">
  <a href="{{ route($routeName.'.create') }}" class="btn btn-white btn-round">
    Add {{ $ModulName }}<div class="ripple-container"></div>
  </a>
</div>
@endslot
@slot('table')
<table class="table">
  <thead class=" text-primary">
    <tr><th>
      #
    </th>
    <th>
      Tag Name
    </th>
    <th>
      Permission
    </th>
    <th>
      Created At
    </th>
    <th class="text-right">
      Control
    </th>
  </tr></thead>
  <tbody>
  @foreach($rows as $row)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $row->tag_name }}</td>
      <td>{{ $row->permission  == 1 ? 'Published' : 'Not Published'}}</td>
      <td>{{ $row->created_at->diffForHumans() }}</td>
      <td class="td-actions text-right">
        @include('back-end.shared.buttons.edit')
        @include('back-end.shared.buttons.delete')
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
{!! $rows->appends(request()->query())->links() !!}
@endslot
@endcomponent
@endsection