<form method="post" action="{{ route('checkexam') }}" style="margin-top: 50px;">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course->id }}">
    @foreach($course->questions as $question)
        <div class="form-section">
            <span class="scorequiz">
                Question Score : {{$question->score == 1 ? '1 Point' : $question->score.' Points' }}
            </span>
            <table class="table table-bordered table-question">
                <thead>
                    <th width="20%" class="text-left text-bold align-top">
                        Question {{ $loop->iteration }} of {{ $course->questions->count() }} 
                    </th> 
                    <th class="text-left text-bold">
                        <span>
                            {!! $question->question !!} 
                        </span>
                    </th>
                </thead> 
                <tbody>
                    <tr>
                        <td class="text-left text-bold questionoptions">Options</td> 
                        <td class="text-left">
                            @foreach($question->options as $option)
                            <div class="form-check">
                                <input type="radio" name="questions[{{ $question->id }}]" value="{{ $option->id }}" class="form-check-input">
                                <label class="questionoptions">
                                    {{ $option->option_text }}
                                </label>
                            </div>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
    <div class="form-navigation">
        <button type="button" class="previous btn btn-danger float-left">
            Previous
        </button>
        <button type="button" class="next btn btn-danger float-right">
            Next
        </button>
        <button type="submit" id="myButtonId" class="btn btn-danger float-right" onclick="timeExam()">
            Submit
        </button>  
    </div>
</form>
