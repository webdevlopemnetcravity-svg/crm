<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateDetail;

class CandidateDetailController extends Controller
{
    public function create()
    {
        return view('candidate_form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'portfolio' => 'nullable|url',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string',
            // 👉 Add any more fields from your migration here
        ]);

        if ($request->hasFile('resume')) {
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        CandidateDetail::create($validated);

        return back()->with('success', 'Candidate form submitted successfully!');
    }
}
