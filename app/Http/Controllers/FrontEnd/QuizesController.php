<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Course;
use App\Models\Question;
use App\Models\TestResult;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use App\Http\Controllers\Controller;

class QuizesController extends Controller
{

	public function __construct(){
		$this->middleware('auth')->only('checkExam');
	}

    /* TO view Exam of specific course */
    public function quickquiz($course){
        $course_name = str_replace("_", " ", $course);
        $course = Course::where('permission', 1)
                        ->where('course_name', $course_name)
                        ->firstOrFail();

        $testResult = NULL;
        if(auth()->user()){
            $testResult = TestResult::where('user_id', auth()->user()->id)
                                    ->where('course_id', $course->id)
                                    ->first();
        }
         return view('front-end.quizes.index', compact('course', 'testResult'));
    }

    /* to check test and store test result */
    public function checkExam(Request $request){
        $score = 0;
        $correct_answers = 0;
        $uncorrect_answers = 0;
        $course = Course::where('permission', 1)->findOrFail($request->course_id);
        $course_name = str_replace(" ", "_", $course->course_name);
        if(!is_null($request->get('questions'))){
            foreach($request->get('questions') as $question_id => $answer_id){
                $question = Question::findOrFail($question_id);
                $option = QuestionOption::where('id', $answer_id)->where('question_id', $question->id)->firstOrFail();
                if($option->correct == 1){
                    $score += $question->score;
                    $correct_answers++;

                }else{
                    $uncorrect_answers++;
                }
            }
            $testResult = TestResult::create([
                'user_id' => auth()->user()->id,
                'course_id' => $course->id,
                'score' => $score,
                'correct_answers'   => $correct_answers,
                'uncorrect_answers' => $uncorrect_answers,
            ]);    
        }else{
            $testResult = TestResult::create([
                'user_id' => auth()->user()->id,
                'course_id' => $course->id,
                'score' => $score,
                'correct_answers' => $correct_answers,
                'uncorrect_answers' => $uncorrect_answers,
            ]);
        } 
        return redirect()->route('quickquiz', ['course' => $course_name]);
    }
}
