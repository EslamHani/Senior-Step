<div class="row">
  <div class="col-md-6">
    @php $input = 'title' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">File Title</label>
      <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off">
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      @php $select = "course_id" @endphp
      <select id="inputState" class="form-control @error($select) is-invalid @enderror" name="{{$select}}">
        <option value="" {{ isset($row->{$select}) && $row->{$select} == "" ? 'selected' : '' }}>Choose Course</option>
        @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ isset($row->{$select}) && $row->{$select} == $course->id ? 'selected' : '' }}>
              {{ $course->course_name }}
            </option>
        @endforeach 
      </select>
      @error($select)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  <div class="col-md-6" style="margin-bottom: 15px">
      @php $input = "file" @endphp
      <label>PDF File</label>
      <input type="file" name="{{$input}}" class="form-control @error($input) is-invalid @enderror" >
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
  <div class="col-md-6" style="margin-bottom: 15px">
      @php $input = "image" @endphp
      <label>Image File</label>
      <input type="file" name="{{$input}}" class="form-control @error($input) is-invalid @enderror" >
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <div class="form-group bmd-form-group">
        @php $input = "description" @endphp
        <label class="bmd-label-floating">File Description</label>
        <textarea class="form-control @error($input) is-invalid @enderror" rows="5" name="{{ $input }}">{{ isset($row->{$input}) ? $row->{$input} : old($input) }}</textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>
  </div>
  <div class="col-md-6">
    @php $input = 'author' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Author</label>
      <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off">
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      @php $select = "permission" @endphp
      <select id="inputState" class="form-control @error($select) is-invalid @enderror" name="{{$select}}">
        <option value="" {{ isset($row->{$select}) && $row->{$select} == "" ? 'selected': '' }}>Choose Permission</option>
        <option value="1" {{ isset($row->{$select}) && $row->{$select} == 1 ? 'selected': '' }}>Published</option>
        <option value="0" {{ isset($row->{$select}) && $row->{$select} == 0 ? 'selected': '' }}>Not Published</option>
      </select>
      @error($select)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
</div>