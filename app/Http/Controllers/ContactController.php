<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMessages;

class ContactController extends Controller
{
    function contact(){
        return view('contact'); 
        }
    function contact_post(Request $req){
        $req->validate([
        'fname' => ['required','max:40'],
        'email' => ['required'],
        'subject' => ['required'],
        'msg' => ['required'],
        ]);
        $details= [
            'fname' =>$req->fname,
            'email' =>$req->email,
            'subject' =>$req->subject,
            'msg' =>$req->msg,
        ];
        Contact::insert($req->except('_token') +[
        'created_at' => Carbon::now()
        ]);
        Mail::to('nazrul.safa@gmail.com')->send(new SendMessages($details));
        return back()->with('mesg_send', 'Thank You ! Your Message Send Successfully');
    }
}
