<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Show contact form
    public function showForm()
    {
        return view('contact');
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        // validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // save to database
        Contact::create($request->all());

        // redirect back with success
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
