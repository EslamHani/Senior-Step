<div class="row">
  <div class="col-md-6">
    @php $input = 'name' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Name</label>
      <input type="text" class="form-control" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off" readonly="readonly">
    </div>
  </div>
  <div class="col-md-6">
    @php $input = 'email' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Email</label>
      <input type="text" class="form-control" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off" readonly="readonly">
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <div class="form-group bmd-form-group">
        @php $input = "message" @endphp
        <label class="bmd-label-floating">Message</label>
        <textarea class="form-control" rows="5" name="{{ $input }}" readonly="readonly">{{ isset($row->{$input}) ? $row->{$input} : old($input) }}</textarea>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <h4 style="color: #7b1fa2">Reply Message</h4><br>
      <div class="form-group bmd-form-group">
        @php $input = "replay" @endphp
        <label class="bmd-label-floating">Reply Message</label>
        <textarea class="form-control @error($input) is-invalid @enderror" rows="5" name="{{ $input }}" required>{{  old($input) }}</textarea>
        @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
</div>