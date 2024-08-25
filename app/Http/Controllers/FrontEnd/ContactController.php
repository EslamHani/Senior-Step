<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /* To View Contact Form */
    public function viewContact(){
        return view('front-end.contact.message-form');
    }

    /* To Save message contact us */
    public function storeMessage(Request $request){
        $data = $request->validate([
            'name' => ['required', 'max:25', 'min:2'],
            'email' => ['required', 'email', 'max:40'],
            'message' => ['max:200'],
        ]);
        Message::create($data);
        alert()->success('We will contact you as soon as possible. Thank you')->persistent('Close');
        return redirect()->back();
    }
}
