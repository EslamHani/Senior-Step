<?php
namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Videos\Store;
use App\Http\Requests\BackEnd\Videos\Update;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Course;


class VideosController extends BackEndController
{
    use CommentsTrait;

    public function __construct(Video $model){
        parent::__construct($model);
    }

    protected function append2(){
        $array = [
            'courses'  => Course::orderBy('id', 'desc')->get(),
            'comments' => [],
        ];
        if(request()->route()->parameter('video')){
            $video_id = request()->route()->parameter('video');
            $array['comments'] = $this->model->findOrFail($video_id)->comments()->orderBy('id', 'asc')->get();
        }
        return $array;
    }

    public function index(Request $request)
    {
        $append = [];
        $rows = $this->model->when($request->search, function($query) use($request){
            return $query->where('video_name', 'like', '%'.$request->search.'%');
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
        $requestArray['transcript'] = $request->input('transcript');
        $requestArray['video_desc'] = $request->input('video_desc');
        $this->model->create($requestArray);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.".index")->with('success', 'One video added successfully');
    }

    public function update(Update $request, $id)
    {
        $row = $this->model->findOrFail($id);
        $requestArray = $request->all();
        $requestArray['transcript'] = $request->input('transcript');
        $requestArray['video_desc'] = $request->input('video_desc');
        $row->update($requestArray);
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.".edit", ['id' => $row->id]);
    }

    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        $routeName = $this->getSmallCharModelName();
        return redirect()->route($routeName.'.index');
    }

}
