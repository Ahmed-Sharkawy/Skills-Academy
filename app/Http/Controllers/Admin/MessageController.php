<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StorRequest;
use App\Mail\ContactResponseMail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{

    public function index()
    {
        $messages = Message::orderBy('id', 'DESC')->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function store(Message $message, StorRequest $request)
    {
        Mail::to($message->email)->send(new ContactResponseMail($message->name, $request->title, $request->body));
        Toastr::success('Email has been sent successfully');

        return redirect()->route('dashboard.messages.index');
    }

    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }
}
