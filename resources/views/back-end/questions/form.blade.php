<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <div class="form-group bmd-form-group">
        @php $input = "question" @endphp
        <textarea class="form-control @error($input) is-invalid @enderror" id="{{ $input }}" rows="3" name="{{ $input }}" style="margin-top: 10px;" placeholder="Question ?">{{ isset($row->{$input}) ? $row->{$input} : old($input) }}</textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>
  </div>
  <div class="col-md-12">
    @php $input = 'score' @endphp
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Score</label>
      <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->{$input} : old($input, 1)}}" autocomplete="off">
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  @if(isset($options))
    @php  $question = 1  @endphp 
    @foreach($options as $option)
      <div class="col-md-12" style="margin: 10px 0px;">
        <div class="form-group">
          <div class="form-group bmd-form-group">
            @php $input = "option_text_" . $question @endphp
            @php $correct = "correct_" . $question @endphp
            <label class="bmd-label-floating">Option Text</label>
            <textarea class="form-control" rows="2" name="{{ $input }}">{{isset($option->option_text) ? $option->option_text : old($input) }}</textarea>
          </div>
          <div class="form-check">
            <label class="form-check-label">
                <input type="hidden" name="{{ $correct }}" value="0">
                <input class="form-check-input" type="checkbox" name="{{ $correct }}" value="1" {{ isset($option->correct) && $option->correct == 1 ? 'checked' : '' }}>
                Correct
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
          </div>
        </div>
      </div>
      @php $question++ @endphp
    @endforeach
  @else
    @for($question = 1; $question <= 4; $question++)
      <div class="col-md-12" style="margin: 10px 0px;">
        <div class="form-group">
          <div class="form-group bmd-form-group">
            @php $input = "option_text_" . $question @endphp
            @php $correct = "correct_" . $question @endphp
            <label class="bmd-label-floating">Option Text</label>
            <textarea class="form-control" rows="2" name="{{ $input }}">{{ old($input) }}</textarea>
          </div>
          <div class="form-check">
            <label class="form-check-label">
                <input type="hidden" name="{{ $correct }}" value="0">
                <input class="form-check-input" type="checkbox" name="{{ $correct }}" value="1">
                Correct
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
          </div>
        </div>
      </div>
    @endfor

  @endif

    
</div>