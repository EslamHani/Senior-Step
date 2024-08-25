<div class="row">
  <div class="col-md-6">
    @php $input = 'video_name' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Video Name</label>
      <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off">
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    @php $input = 'youtube' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Youtube Link</label>
      <input type="url" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off">
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
        <option value="" {{ isset($row->{$select}) && $row->{$select} == "" ? 'selected': '' }}>Choose Course</option>
        @foreach($courses as $course)
        <option value="{{ $course->id }}" {{ isset($row->{$select}) && $row->{$select} == $course->id ? 'selected': '' }}>
          {{$course->course_name}}
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
  <div class="col-md-6">
    @php $input = 'time' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Video Time (h:m:s)</label>
      <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off">
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  <div class="col-md-6" style="margin-top: 25px;">
    @php $input = "open_comments" @endphp
     <div class="form-check form-check-radio form-check-inline">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="{{ $input }}" id="inlineRadio1" value="1" {{ isset($row->{$input}) && $row->{$input} == 1 ? 'checked' : '' }}> Open Comments
        <span class="circle">
            <span class="check"></span>
        </span>
      </label>
    </div>
    <div class="form-check form-check-radio form-check-inline">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="{{ $input }}" id="inlineRadio1" value="0" {{ isset($row->{$input}) && $row->{$input} == 0 ? 'checked' : '' }}> Close Comments
        <span class="circle">
            <span class="check"></span>
        </span>
      </label>
    </div>
   </div>
  <div class="col-md-12" style="margin-top: 10px;">
    <div class="form-group">
        @php $input = "video_desc" @endphp
        <label>Video Description</label><br>
        <textarea  class="form-control @error($input) is-invalid @enderror" rows="15" name="{{ $input }}">{{ isset($row->{$input}) ? $row->{$input} : old($input) }}</textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div><br>
  <div class="col-md-12"  style="margin-top: 10px;">
    <div class="form-group">
        <label>Lesson Transcript</label><br>
        @php $input = "transcript" @endphp
        <textarea  class="form-control @error($input) is-invalid @enderror" rows="25" name="{{ $input }}">{{ isset($row->{$input}) ? $row->{$input} : old($input) }}</textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>
</div>