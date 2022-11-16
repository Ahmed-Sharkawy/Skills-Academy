<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Message;
use App\Models\Setting;

class ContactController extends Controller
{

    public function create()
    {
        $setting = Setting::select("email", "phone")->first();
        return view('Web.contact.contact', compact('setting'));
    }

    public function store(ContactRequest $request)
    {
        Message::create(['body' => $request->message] + $request->validated());

        return response()->json(['success' => 'your message sent successfullysuccessfully']);
    }
}
