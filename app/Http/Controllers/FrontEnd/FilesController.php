<?php

namespace App\Http\Controllers\FrontEnd;

use Storage;
use App\Models\File;
use App\Models\Course;;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{

	public function __construct(){
		$this->middleware('auth')->except('files');
	}

    /* This function to retuen all pdf files for specific course */
    public function files(){
        $course_name = str_replace("_", " ", request()->input('course'));
        $course = Course::where('permission', 1)->where('course_name', $course_name)->firstOrFail();
        $files  = File::where('permission', 1)->where('course_id', $course->id)->paginate(40);
        return view('front-end.pdf.index', compact('files', 'course'));
    }


    /* To view pdf file */
    public function ViewFile(){
        $id = request()->input('id');
        $file = File::where('permission', 1)->findOrFail($id);
        return view('front-end.pdf.show', compact('file'));
    }

    /* To Download pdf Files */
    public function DownloadFile(){
        $id = request()->input('id');
        $file = File::where('permission', 1)->findOrFail($id);
        $download = $file->download + 1;
        $file->update(['download' => $download]);
        return Storage::download($file->path, $file->real_name);
    }
}
