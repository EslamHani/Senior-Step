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
@endslot
@slot('table')
<table class="table">
  <thead class=" text-primary">
    <tr>
    <th>
       # 
    </th>
    <th>
      Name
    </th>
    <th>
      Email
    </th>
    <th>
      Message
    </th>
    <th>
      Reply Message
    </th>
    <th>
      Time
    </th>
    <th class="text-right">
      Control
    </th>
  </tr></thead>
  <tbody>
  @foreach($rows as $row)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $row->name }}</td>
      <td>{{ $row->email }}</td>
      <td>{{ substr($row->message,0, 40) }}{{ strlen($row->message) > 40 ? '...' : '' }}</td>
      <td>{{ $row->replay == 1 ? 'Done' : 'Not Done' }}</td>
      <td>{{ $row->created_at->diffForHumans() }}</td>
      <td class="td-actions text-right">
        <a href="{{ route($routeName.'.edit', ['id' => $row->id]) }}" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Replay {{ $ModulName }}">
        <i class="material-icons">edit</i>
        </a>
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