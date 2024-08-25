<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use App\Http\Requests\BackEnd\Questions\Store;
use App\Http\Requests\BackEnd\Questions\Update;

class QuestionsController extends BackEndController
{
    
    public function __construct(Question $model){
        parent::__construct($model);
    }

    protected function append($input){
        $array = [
            'options' => QuestionOption::where('question_id', $input)->get(),
        ];
        return $array;
    }

    public function index(Request $request)
    {
        $append = [];
        $rows = $this->model->when($request->search, function($query) use($request){
            return $query->where('question', 'like', '%'.$request->search.'%');
        })->orderBy('created_at', 'desc')->paginate(10);
        $ModulName = $this->getModelName();   // Like  User
        $PageTitle = "Control " . $this->getPluralModelName(); // Like Control Users
        $PageDescription = "Here you can add / edit / delete ".$ModulName;
        $routeName = $this->getSmallCharModelName();   // Like users
        $folderName = $this->getSmallCharModelName();   // Like users
        return view('back-end.'.$folderName.'.index', compact([
            'rows',
            'ModulName',
            'PageTitle',
            'PageDescription',
            'routeName',
            'folderName'
        ]))->with($append);
    }
    
    public function store(Store $request)
    {
        $requestArray = $request->all();
        $question = $this->model->create($requestArray);
        for($q = 1; $q <= 4; $q++){
            $option = $request->input('option_text_'.$q, '');
            if($option != ""){
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $option,
                    'correct'     => $request->input('correct_'.$q),
                ]);
            }
        }
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.index')->with('success', 'One question added successfully');
    }
    
    public function update(Update $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $requestArray = $request->all();
        $row->update($requestArray);
        $array = QuestionOption::where('question_id', $id)->get();
        $count = count($array);
        for($q = 0; $q <= $count; $q++){
            $option = $request->input('option_text_'.$q, '');
            if($option != ""){
                \DB::table('question_options')->where('id', $array[$q-1]->id)->update([
                    'question_id' => $row->id,
                    'option_text' => $option,
                    'correct'     => $request->input('correct_'.$q),
                ]);
            }
        }
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.edit', ['id' => $row->id]);
    }

    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);

        $row->delete();

        $routeName = $this->getSmallCharModelName();
        
        return redirect()->route($routeName.'.index');
    }
}
