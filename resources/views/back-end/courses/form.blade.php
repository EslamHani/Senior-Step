<div class="row">
  <div class="col-md-6">
    @php $input = 'course_name' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Course Name</label>
      <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off">
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    @php $input = 'teacher' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Teacher</label>
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
  <div class="col-md-6">
    <div class="form-group">
      @php $select = "cat_id" @endphp
      <select id="inputState" class="form-control @error($select) is-invalid @enderror" name="{{$select}}">
        <option value="" {{ isset($row->{$select}) && $row->{$select} == "" ? 'selected' : '' }}>Choose Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ isset($row->{$select}) && $row->{$select} == $category->id ? 'selected' : '' }}>
              {{ $category->category_name }}
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
  <div class="col-md-6" style="margin-top: 10px; margin-bottom: 15px">
      @php $input = "image" @endphp
      <input type="file" name="{{$input}}" class="form-control @error($input) is-invalid @enderror" >
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
  <div class="col-md-6">
    @php $input = 'meta_keywords' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Meta Keywords</label>
      <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input)}}" autocomplete="off">
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <div class="form-group bmd-form-group">
        @php $input = "course_desc" @endphp
        <label class="bmd-label-floating">Course Description</label>
        <textarea class="form-control @error($input) is-invalid @enderror" rows="5" name="{{ $input }}">{{ isset($row->{$input}) ? $row->{$input} : old($input) }}</textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <div class="form-group bmd-form-group">
        @php $input = "meta_desc" @endphp
        <label class="bmd-label-floating">Meta Description</label>
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
    <div class="form-group">
      <label>Skills</label>
      @php $select = "skills[]" @endphp
      <select id="inputState" class="form-control @error($select) is-invalid @enderror" name="{{$select}}" multiple style="height:100px;">
        @foreach($skills as $skill)
            <option value="{{ $skill->id }}" {{ in_array($skill->id, $selectedSkills) ? 'selected' : '' }}>
              {{ $skill->skill_name }}
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
      <label>Tags</label>
      @php $select = "tags[]" @endphp
      <select id="inputState" class="form-control @error($select) is-invalid @enderror" name="{{$select}}" multiple style="height:100px;">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
              {{ $tag->tag_name }}
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
  <div class="col-md-12">
    <div class="form-group">
      <label>Questions</label>
      @php $select = "questions[]" @endphp
      <select id="inputState" class="form-control @error($select) is-invalid @enderror" name="{{$select}}" multiple style="height:200px;">
        @foreach($questions as $question)
            <option value="{{ $question->id }}" {{ in_array($question->id, $selectedQuestions) ? 'selected' : '' }}>
              {{ substr(strip_tags($question->question), 0, 200) }}{{ strlen(strip_tags($question->question)) > 200 ? '...' : '' }}
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
</div>