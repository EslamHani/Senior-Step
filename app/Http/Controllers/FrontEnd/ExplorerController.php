<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExplorerController extends Controller
{
    public function __invoke()
    {
    	$users = User::where('id', '!=', auth()->id())->inRandomOrder()->get();
    	return view('front-end.explorer.index', ['users' => $users]);
    }
}
