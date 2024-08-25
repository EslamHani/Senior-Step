<div class="card card-exam">
    <div class="card-body">
        <center>
            <span>
              Your test score : <b>{{ $testResult->score }}</b> {{ $testResult->score > 1  ? 'Points' : 'Point'}}
            </span><br>
            <span> 
              You have answered {{ $testResult->correct_answers }} correct answers out of {{ $course->questions->count() }} questions
            </span><br>
            <span> 
              You have answered {{ $testResult->uncorrect_answers }} uncorrect answers out of {{ $course->questions->count() }} questions
            </span>
            <br>
            Good Luck
        </center>
    </div>
</div>