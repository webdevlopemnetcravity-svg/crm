<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImmigrationRequest;
use App\Http\Requests\UpdateImmigrationRequest;
use App\Models\Immigration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImmigrationController extends Controller
{
    /**
     * List page — simple grid for demo (newest first).
     */
    public function index(Request $request)
    {
        // For demo, show all. Add filters/pagination later.
        $immigrations = Immigration::orderByDesc('id')->get();

        return view('immigrations.index', compact('immigrations'));
    }

    /**
     * Show create form (accordion).
     */
    public function create()
    {
        return view('immigrations.create');
    }

    /**
     * Persist a new Immigration with all accordion sections + uploads.
     */
    public function store(StoreImmigrationRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        // ===== HEAD uploads =====
        if ($request->hasFile('resume')) {
            $data['resume_path'] = $request->file('resume')->store('immigrations/resume', 'public');
        }
        if ($request->hasFile('document_one')) {
            $data['document_one'] = $request->file('document_one')->store('immigrations', 'public');
        }
        if ($request->hasFile('document_two')) {
            $data['document_two'] = $request->file('document_two')->store('immigrations', 'public');
        }

        // ===== JSON sections =====
        // Personal
        $data['personal_info']  = $request->input('personal', []);

        // Passport
        $data['passport_info']  = $request->input('passport', []);

        // Relative
        $data['relative_info']  = $request->input('relative', []);

        // Family (parents)
        $data['family_info']    = $request->input('family', []);

        // Spouse
        $data['spouse_info']    = $request->input('spouse', []);

        // Education (+ files)
        $education = $request->input('education', []);

        if ($request->hasFile('education.leaving_certificate')) {
            $education['leaving_certificate_path'] = $request->file('education.leaving_certificate')
                ->store('immigrations/education', 'public');
        }
        if ($request->hasFile('education.tenth_marksheet')) {
            $education['tenth_marksheet_path'] = $request->file('education.tenth_marksheet')
                ->store('immigrations/education', 'public');
        }
        if ($request->hasFile('education.twelfth_marksheet')) {
            $education['twelfth_marksheet_path'] = $request->file('education.twelfth_marksheet')
                ->store('immigrations/education', 'public');
        }
        if ($request->hasFile('education.grad_marksheet')) {
            $education['grad_marksheet_path'] = $request->file('education.grad_marksheet')
                ->store('immigrations/education', 'public');
        }
        if ($request->hasFile('education.pg_marksheet')) {
            $education['pg_marksheet_path'] = $request->file('education.pg_marksheet')
                ->store('immigrations/education', 'public');
        }
        $data['education_info'] = $education;

        // Jobs (repeatable) + per-job uploads
        $jobs = $request->input('jobs', []);
        foreach ($jobs as $i => $row) {
            // attach UploadedFiles if present
            if ($request->file("jobs.$i.offer")) {
                $row['offer_path'] = $request->file("jobs.$i.offer")
                    ->store('immigrations/jobs', 'public');
            }
            if ($request->file("jobs.$i.experience")) {
                $row['exp_path'] = $request->file("jobs.$i.experience")
                    ->store('immigrations/jobs', 'public');
            }
            $jobs[$i] = $row;
        }
        $data['job_history'] = $jobs;

        // Property + valuation report
        $property = $request->input('property', []);
        if ($request->hasFile('property.valuation_report')) {
            $property['valuation_report_path'] = $request->file('property.valuation_report')
                ->store('immigrations/property', 'public');
        }
        $data['property_info'] = $property;

        // Finance + ITR
        $finance = $request->input('finance', []);
        if ($request->hasFile('finance.itr')) {
            $finance['itr_path'] = $request->file('finance.itr')
                ->store('immigrations/finance', 'public');
        }
        $data['finance_info'] = $finance;

        // Travel
        $data['travel_info'] = $request->input('travel', []);

        Immigration::create($data);

        return redirect()->route('immigrations.index')->with('status', 'Immigration saved.');
    }

    /**
     * Show edit form (accordion).
     */
    public function edit(Immigration $immigration)
    {
        return view('immigrations.edit', compact('immigration'));
    }

    /**
     * Update an Immigration, replacing files if new ones are uploaded.
     */
    public function update(UpdateImmigrationRequest $request, Immigration $immigration)
    {
        $data = $request->validated();

        // Helper to delete old path if exists
        $deleteOld = function (?string $path) {
            if (!empty($path)) Storage::disk('public')->delete($path);
        };

        // ===== HEAD uploads (replace if provided) =====
        if ($request->hasFile('resume')) {
            $deleteOld($immigration->resume_path);
            $data['resume_path'] = $request->file('resume')->store('immigrations/resume', 'public');
        }
        if ($request->hasFile('document_one')) {
            $deleteOld($immigration->document_one);
            $data['document_one'] = $request->file('document_one')->store('immigrations', 'public');
        }
        if ($request->hasFile('document_two')) {
            $deleteOld($immigration->document_two);
            $data['document_two'] = $request->file('document_two')->store('immigrations', 'public');
        }

        // ===== JSON sections =====
        $data['personal_info'] = $request->input('personal', []);
        $data['passport_info'] = $request->input('passport', []);
        $data['relative_info'] = $request->input('relative', []);
        $data['family_info']   = $request->input('family', []);
        $data['spouse_info']   = $request->input('spouse', []);

        // Education with file replacements
        $educationOld = is_array($immigration->education_info) ? $immigration->education_info : [];
        $education    = $request->input('education', []);

        if ($request->hasFile('education.leaving_certificate')) {
            $deleteOld($educationOld['leaving_certificate_path'] ?? null);
            $education['leaving_certificate_path'] = $request->file('education.leaving_certificate')
                ->store('immigrations/education', 'public');
        }
        if ($request->hasFile('education.tenth_marksheet')) {
            $deleteOld($educationOld['tenth_marksheet_path'] ?? null);
            $education['tenth_marksheet_path'] = $request->file('education.tenth_marksheet')
                ->store('immigrations/education', 'public');
        }
        if ($request->hasFile('education.twelfth_marksheet')) {
            $deleteOld($educationOld['twelfth_marksheet_path'] ?? null);
            $education['twelfth_marksheet_path'] = $request->file('education.twelfth_marksheet')
                ->store('immigrations/education', 'public');
        }
        if ($request->hasFile('education.grad_marksheet')) {
            $deleteOld($educationOld['grad_marksheet_path'] ?? null);
            $education['grad_marksheet_path'] = $request->file('education.grad_marksheet')
                ->store('immigrations/education', 'public');
        }
        if ($request->hasFile('education.pg_marksheet')) {
            $deleteOld($educationOld['pg_marksheet_path'] ?? null);
            $education['pg_marksheet_path'] = $request->file('education.pg_marksheet')
                ->store('immigrations/education', 'public');
        }
        $data['education_info'] = $education;

        // Jobs (replace arrays; if you want to diff & delete old files not reuploaded, we can add later)
        $jobs = $request->input('jobs', []);
        $oldJobs = is_array($immigration->job_history) ? $immigration->job_history : [];

        foreach ($jobs as $i => $row) {
            if ($request->file("jobs.$i.offer")) {
                // delete old offer if existed for same index
                if (isset($oldJobs[$i]['offer_path'])) $deleteOld($oldJobs[$i]['offer_path']);
                $row['offer_path'] = $request->file("jobs.$i.offer")
                    ->store('immigrations/jobs', 'public');
            } else {
                // keep existing path if not reuploaded
                if (isset($oldJobs[$i]['offer_path'])) $row['offer_path'] = $oldJobs[$i]['offer_path'];
            }

            if ($request->file("jobs.$i.experience")) {
                if (isset($oldJobs[$i]['exp_path'])) $deleteOld($oldJobs[$i]['exp_path']);
                $row['exp_path'] = $request->file("jobs.$i.experience")
                    ->store('immigrations/jobs', 'public');
            } else {
                if (isset($oldJobs[$i]['exp_path'])) $row['exp_path'] = $oldJobs[$i]['exp_path'];
            }

            $jobs[$i] = $row;
        }
        $data['job_history'] = $jobs;

        // Property + valuation report
        $propertyOld = is_array($immigration->property_info) ? $immigration->property_info : [];
        $property    = $request->input('property', []);
        if ($request->hasFile('property.valuation_report')) {
            $deleteOld($propertyOld['valuation_report_path'] ?? null);
            $property['valuation_report_path'] = $request->file('property.valuation_report')
                ->store('immigrations/property', 'public');
        }
        $data['property_info'] = $property;

        // Finance + ITR
        $financeOld = is_array($immigration->finance_info) ? $immigration->finance_info : [];
        $finance    = $request->input('finance', []);
        if ($request->hasFile('finance.itr')) {
            $deleteOld($financeOld['itr_path'] ?? null);
            $finance['itr_path'] = $request->file('finance.itr')
                ->store('immigrations/finance', 'public');
        }
        $data['finance_info'] = $finance;

        // Travel
        $data['travel_info'] = $request->input('travel', []);

        $immigration->update($data);

        return redirect()->route('immigrations.index')->with('status', 'Immigration updated.');
    }

    /**
     * Delete an Immigration and its stored files.
     */
    public function destroy(Immigration $immigration)
    {
        // Head files
        if ($immigration->document_one) Storage::disk('public')->delete($immigration->document_one);
        if ($immigration->document_two) Storage::disk('public')->delete($immigration->document_two);
        if ($immigration->resume_path)  Storage::disk('public')->delete($immigration->resume_path);

        // Education files
        $edu = is_array($immigration->education_info) ? $immigration->education_info : [];
        foreach ([
            'leaving_certificate_path','tenth_marksheet_path','twelfth_marksheet_path',
            'grad_marksheet_path','pg_marksheet_path'
        ] as $k) {
            if (!empty($edu[$k])) Storage::disk('public')->delete($edu[$k]);
        }

        // Job files
        $jobs = is_array($immigration->job_history) ? $immigration->job_history : [];
        foreach ($jobs as $j) {
            if (!empty($j['offer_path'])) Storage::disk('public')->delete($j['offer_path']);
            if (!empty($j['exp_path']))   Storage::disk('public')->delete($j['exp_path']);
        }

        // Property/Finance files
        $prop = is_array($immigration->property_info) ? $immigration->property_info : [];
        if (!empty($prop['valuation_report_path'])) Storage::disk('public')->delete($prop['valuation_report_path']);

        $fin = is_array($immigration->finance_info) ? $immigration->finance_info : [];
        if (!empty($fin['itr_path'])) Storage::disk('public')->delete($fin['itr_path']);

        $immigration->delete();

        return redirect()->route('immigrations.index')->with('status', 'Immigration deleted.');
    }
}
