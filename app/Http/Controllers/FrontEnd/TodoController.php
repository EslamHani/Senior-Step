<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Step;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\Todo\Store;
use App\Http\Requests\FrontEnd\Todo\Update;

class TodoController extends Controller
{

    protected $viewName;
    protected $pageName;

    public function __construct(){
        $this->middleware('auth');
        $this->viewName =  "front-end.todos.";
    }

    public function index()
    {
        $todos = auth()->user()->todos->sortBy('completed');
        return view($this->viewName."index", ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewName.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {

        //dd($request->all());
        $todo = auth()->user()->todos()->create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        foreach($request->steps as $step)
        {
            if(!is_null($step))
            {
                $todo->steps()->create(['name' => $step]);                
            }
        }
        alert()->success('Added successfully');
        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('list-permisions', $todo);
        return view($this->viewName.'show', ['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('list-permisions', $todo);
        return view($this->viewName.'edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('list-permisions', $todo);
        $todo->update([
            'name' => $request->name,
            'description' => $request->description,
            'user_id'     => auth()->id()
        ]);
        foreach($request->stepsName as $key =>  $value)
        {
            if(!is_null($value))
            {
                $id = $request->stepsId[$key];
                if(!$id)
                {
                    $todo->steps()->create(['name' => $value]);
                }else{
                    $step = Step::findOrFail($id);
                    $step->update(['name' => $value]);
                }
                              
            }
        }
        alert()->success('Updated successfully');
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('list-permisions', $todo);
        $todo->delete();
        alert()->success('Deleted successfully');
        return redirect()->route('todos.index');
    }

    public function completed($id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('list-permisions', $todo);
        if($todo->completed)
        {
            $todo->update([
                'completed' => false,
            ]);
        }else{
            $todo->update([
                'completed' => true,
            ]);
        }
        return redirect()->route('todos.index');
    }
}
