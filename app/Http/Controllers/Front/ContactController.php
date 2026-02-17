<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('frontend.pages.contact');
    }
    public function store(ContactMessageRequest $request){

    ContactMessage::create($request->validated());
        return back()->with('success','Message Sent Successfully!');
    }
}
