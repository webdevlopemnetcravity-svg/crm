@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Candidate Application Form</h2>

    {{-- Show success/error messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('candidate.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Personal Info --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Phone *</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control">
            </div>
        </div>

        {{-- Job Details --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Position Applied *</label>
                <input type="text" name="position" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Expected Salary</label>
                <input type="number" name="expected_salary" class="form-control">
            </div>
        </div>

        {{-- Education --}}
        <div class="mb-3">
            <label class="form-label">Education</label>
            <textarea name="education" class="form-control" rows="2"></textarea>
        </div>

        {{-- Skills --}}
        <div class="mb-3">
            <label class="form-label">Skills</label>
            <input type="text" name="skills" class="form-control" placeholder="e.g. PHP, Laravel, React">
        </div>

        {{-- Experience --}}
        <div class="mb-3">
            <label class="form-label">Work Experience</label>
            <textarea name="experience" class="form-control" rows="3"></textarea>
        </div>

        {{-- Resume Upload --}}
        <div class="mb-3">
            <label class="form-label">Upload Resume (PDF/DOC)</label>
            <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx">
        </div>

        {{-- Address --}}
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="2"></textarea>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
</div>
@endsection

