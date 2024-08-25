<?php

namespace App\Http\Controllers\BackEnd;

use Storage;
use App\Models\Tag;
use App\Models\Skill;
use App\Models\Course;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\BackEnd\Courses\Store;
use App\Http\Requests\BackEnd\Courses\Update;

class CoursesController extends BackEndController
{
    public function __construct(Course $model){
        parent::__construct($model);
    } // End of construct

    protected function append2(){
        $array = [
            'categories' => Category::get(),
            'skills'     => Skill::where('permission', 1)->get(),
            'tags'       => Tag::where('permission', 1)->get(),
            'questions'  => Question::get(),
            'selectedSkills'    => [],
            'selectedTags'      => [],
            'selectedQuestions' => [],
        ];

        if(request()->route()->parameter('course')){
            $course_id = request()->route()->parameter('course');
            $array['selectedSkills'] = $this->model->findOrFail($course_id)->skills()->get()->pluck('id')->toArray();
        }

        if(request()->route()->parameter('course')){
            $course_id = request()->route()->parameter('course');
            $array['selectedQuestions'] = $this->model->findOrFail($course_id)->questions()->get()->pluck('id')->toArray();
        }

        if(request()->route()->parameter('course')){
            $course_id = request()->route()->parameter('course');
            $array['selectedTags'] = $this->model->findOrFail($course_id)->tags()->pluck('tags.id')->toArray();
        }
        return $array;
    } // End of append2

    public function index(Request $request)
    {
        $append = [];
        $rows = $this->model->when($request->search, function($query) use($request){
            return $query->where('course_name', 'like', '%'.$request->search.'%')->orWhere('course_desc', 'like', '%'.$request->search.'%');
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
    } // End of index
    
    public function store(Store $request)
    {
        $requestArray = $request->except('image');
        $cat_id = $request->cat_id;
        $tempFolder = time();
        Storage::makeDirectory('uploads/images/'.$cat_id.'/'.$tempFolder);
        Image::make($request->image)->resize(350, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/images/'.$cat_id.'/'.$tempFolder."/".$request->image->hashName()));
        $requestArray['image'] = 'uploads/images/'.$cat_id.'/'.$tempFolder."/".$request->image->hashName();
        $row = $this->model->create($requestArray);
        $this->syncSkillsTagsQuestion($row, $requestArray);
        Storage::makeDirectory('uploads/images/'.$row->cat_id.'/'.$row->id);
        $newName = str_replace($tempFolder, $row->id, $row['image']);
        Storage::rename($row['image'], $newName);
        $this->model->where('id', $row->id)->update(['image' => $newName]);
        Storage::deleteDirectory('uploads/images/'.$row->cat_id.'/'.$tempFolder);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.index')->with('success', 'One course added successfully');
    } // End of Store

    public function update(Update $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $requestArray = $request->except('image');
        if($requestArray['cat_id'] != $row->cat_id){
            $newName = str_replace($row->cat_id, $requestArray['cat_id'], $row['image']);
            Storage::rename($row['image'], $newName);
            Storage::deleteDirectory('uploads/images/'.$row->cat_id.'/'.$row->id);
            $requestArray['image'] = $newName;
            if($request->hasFile('image')){
                Storage::delete($newName);
                Storage::makeDirectory('uploads/images/'. $requestArray['cat_id']. '/'. $row->id);
                Image::make($request->image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/'. $requestArray['cat_id']. '/'. $row->id ."/".$request->image->hashName()));
                $requestArray['image'] = 'uploads/images/'. $requestArray['cat_id']. '/'. $row->id ."/".$request->image->hashName();
            }
        }else{
            if($request->hasFile('image')){
                Storage::delete($row->image);
                Image::make($request->image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/'. $row->cat_id. '/'. $row->id ."/".$request->image->hashName()));
                $requestArray['image'] = 'uploads/images/'. $row->cat_id . '/'. $row->id ."/".$request->image->hashName();
            }
        }
        $row->update($requestArray);
        $this->syncSkillsTagsQuestion($row, $requestArray);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.edit', ['id' => $row->id]);
    } // End of update

    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        Storage::deleteDirectory('uploads/images/'.$row->cat_id.'/'.$row->id);
        $row->delete();
        return redirect()->route($this->getSmallCharModelName().'.index'); 
    } // End of destroy

    protected function syncSkillsTagsQuestion($row, $requestArray){
        if(isset($requestArray['skills']) && !empty($requestArray['skills'])){
            $row->skills()->sync($requestArray['skills']);
        }
        if(isset($requestArray['tags']) && !empty($requestArray['tags'])){
            $row->tags()->sync($requestArray['tags']);
        }
        if(isset($requestArray['questions']) && !empty($requestArray['questions'])){
            $row->questions()->sync($requestArray['questions']);
        }
    } // End of syncSkillsTagsQuestion

} // End of Controller
