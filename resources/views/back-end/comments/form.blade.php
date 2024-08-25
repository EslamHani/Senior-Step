@php $input = 'comment' @endphp
  <input type="text" class="form-control" name="{{$input}}" value="{{ old($input) }}" placeholder="Comment" autocomplete="off" required>
  <span class="error_data" style="font-size: 12px; color: red;">
      <strong></strong>
  </span>