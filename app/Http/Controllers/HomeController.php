<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('homepage');
    }

    public function contact(ContactRequest $request)
    {
        $validatedData = $request->validated();
        Contact::create($validatedData);
        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.')->withFragment('contact');
    }
}
