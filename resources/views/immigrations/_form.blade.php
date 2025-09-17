@php
    // Safe defaults so "create" doesn't 500
    $immigration = $immigration ?? [];
    $isEdit = !empty($immigration);

    // Helper to read prefill values (works even if nothing passed)
    $val = function ($group, $key, $default='') use ($immigration) {
        // Map JSON group names -> old() input group names on validation errors
        $oldGroup = $group;
        if (str_ends_with($oldGroup, '_info')) $oldGroup = substr($oldGroup, 0, -5);
        if ($group === 'job_history') $oldGroup = 'jobs';

        return old($oldGroup.'.'.$key, data_get($immigration, $group.'.'.$key, $default));
    };
@endphp

<div class="accordion" id="candAccordion">

    {{-- =========================
        Header / Lead Source
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c1" aria-expanded="true">
                Candidate Header
            </button>
        </h2>
        <div id="c1" class="accordion-collapse collapse show" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Lead Source</label>
                        @php $ls = old('lead_source', data_get($immigration,'lead_source','Social Media')); @endphp
                        <select name="lead_source" class="form-select" id="lead_source">
                            @foreach([
                                'Social Media',
                                'Friend or Family Member',
                                'Online Ad',
                                'Search Engine (e.g., Google, Bing)',
                                'Article or Blog Post',
                                'Podcast',
                                'Event or Conference',
                                'Email Newsletter',
                                'Word of Mouth',
                                'Other'
                            ] as $opt)
                                <option value="{{ $opt }}" @selected($ls===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                        <div class="text-muted small mt-1">If "Other", please specify below.</div>
                        <input type="text" class="form-control mt-2" name="lead_source_other"
                               placeholder="Please specify"
                               value="{{ old('lead_source_other', data_get($immigration,'lead_source_other')) }}"
                               id="lead_source_other" style="display:none;">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Application Number</label>
                        <input type="text" name="application_number" class="form-control"
                               placeholder="APP-YYYY-####"
                               value="{{ old('application_number', data_get($immigration,'application_number')) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Application Date</label>
                        <input type="date" name="application_date" class="form-control"
                               value="{{ old('application_date', data_get($immigration,'application_date')) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Upload Resume</label>
                        <input type="file" name="resume" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================
        Personal Details
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
                Personal Details
            </button>
        </h2>
        <div id="c2" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Surname</label>
                        <input name="personal[surname]" class="form-control" value="{{ $val('personal_info','surname') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Given Name</label>
                        <input name="personal[given_name]" class="form-control" value="{{ $val('personal_info','given_name') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gender</label>
                        @php $g=$val('personal_info','gender','Male'); @endphp
                        <select name="personal[gender]" class="form-select">
                            @foreach(['Male','Female','Other'] as $opt)
                                <option value="{{ $opt }}" @selected($g===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Marital Status</label>
                        @php $ms=$val('personal_info','marital_status','Single'); @endphp
                        <select name="personal[marital_status]" class="form-select">
                            @foreach(['Single','Married','Divorced','Widowed'] as $opt)
                                <option value="{{ $opt }}" @selected($ms===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" name="personal[dob]" class="form-control" value="{{ $val('personal_info','dob') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Country Of Origin (Nationality)</label>
                        <input name="personal[nationality]" class="form-control" value="{{ $val('personal_info','nationality') }}">
                    </div>

                    {{-- Home Address --}}
                    <div class="col-12"><h6 class="mt-3">Home Address</h6></div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input name="personal[home_address]" class="form-control" value="{{ $val('personal_info','home_address') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">City</label>
                        <input name="personal[home_city]" class="form-control" value="{{ $val('personal_info','home_city') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">State</label>
                        <input name="personal[home_state]" class="form-control" value="{{ $val('personal_info','home_state') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Pincode</label>
                        <input name="personal[home_pincode]" class="form-control" value="{{ $val('personal_info','home_pincode') }}">
                    </div>

                    {{-- Mailing Address --}}
                    <div class="col-12"><h6 class="mt-3">Mailing Address</h6></div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input name="personal[mail_address]" class="form-control" value="{{ $val('personal_info','mail_address') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">City</label>
                        <input name="personal[mail_city]" class="form-control" value="{{ $val('personal_info','mail_city') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">State</label>
                        <input name="personal[mail_state]" class="form-control" value="{{ $val('personal_info','mail_state') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Pin Code</label>
                        <input name="personal[mail_pincode]" class="form-control" value="{{ $val('personal_info','mail_pincode') }}">
                    </div>

                    {{-- Phones / Emails / Social --}}
                    <div class="col-md-4">
                        <label class="form-label">Primary Phone No</label>
                        <input name="personal[phone_primary]" class="form-control" value="{{ $val('personal_info','phone_primary') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Secondary Phone No</label>
                        <input name="personal[phone_secondary]" class="form-control" value="{{ $val('personal_info','phone_secondary') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Work Phone No</label>
                        <input name="personal[phone_work]" class="form-control" value="{{ $val('personal_info','phone_work') }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Other Phone Numbers Used In Last Five Years</label>
                        <textarea name="personal[phones_last5]" class="form-control" rows="2">{{ $val('personal_info','phones_last5') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input name="personal[email_primary]" class="form-control" value="{{ $val('personal_info','email_primary') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Other Email Addresses Used In Last Five Years</label>
                        <textarea name="personal[emails_last5]" class="form-control" rows="2">{{ $val('personal_info','emails_last5') }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Social Media Presence</label>
                        <input name="personal[social_presence]" class="form-control" value="{{ $val('personal_info','social_presence') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Social Media Username</label>
                        <input name="personal[social_username]" class="form-control" value="{{ $val('personal_info','social_username') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Other Websites/Applications Used In Last Five Years</label>
                        <input name="personal[webapps_last5]" class="form-control" value="{{ $val('personal_info','webapps_last5') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Languages Spoken</label>
                        <input name="personal[languages_spoken]" class="form-control" value="{{ $val('personal_info','languages_spoken') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================
        Passport Details
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h3">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c3">
                Passport Details
            </button>
        </h2>
        <div id="c3" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Passport Number</label>
                        <input name="passport[passport_number]" class="form-control" value="{{ $val('passport_info','passport_number') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Issuing Country</label>
                        <input name="passport[issuing_country]" class="form-control" value="{{ $val('passport_info','issuing_country') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">City Where Issued</label>
                        <input name="passport[issuing_city]" class="form-control" value="{{ $val('passport_info','issuing_city') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Issuance Date</label>
                        <input type="date" name="passport[issue_date]" class="form-control" value="{{ $val('passport_info','issue_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Expiration Date</label>
                        <input type="date" name="passport[expiry_date]" class="form-control" value="{{ $val('passport_info','expiry_date') }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Lost Passport History</label>
                        <textarea name="passport[lost_history]" class="form-control" rows="2">{{ $val('passport_info','lost_history') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================
        Relative Contact Information (Optional)
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h4">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c4">
                Relative Contact Information (Optional)
            </button>
        </h2>
        <div id="c4" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    @foreach([
                        ['rel_surname','Surname'],
                        ['rel_given_name','Given Name'],
                        ['rel_organisation','Organisation Name'],
                        ['rel_relationship','Relationship To You'],
                        ['rel_us_address','US Contact Address'],
                        ['rel_us_city','City'],
                        ['rel_us_state','State'],
                        ['rel_us_zip','Zip Code'],
                        ['rel_email','Email Address'],
                        ['rel_phone','Phone Number'],
                    ] as [$key,$label])
                        <div class="col-md-4">
                            <label class="form-label">{{ $label }}</label>
                            <input class="form-control" name="relative[{{ $key }}]" value="{{ $val('relative_info',$key) }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- =========================
        Family Information (Parents + Spouse)
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h5">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c5">
                Family Information
            </button>
        </h2>
        <div id="c5" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <h6>Parents</h6>
                <div class="row g-3">
                    @foreach([
                        ['father_surname','Father\'s Surname'],
                        ['father_given_name','Father\'s Given Name'],
                        ['father_dob','Father\'s Date Of Birth','date'],
                        ['father_occupation','Father’s Occupation'],
                        ['father_income','Father’s Yearly Income'],
                        ['mother_surname','Mother\'s Surname'],
                        ['mother_given_name','Mother\'s Given Name'],
                        ['mother_dob','Mother\'s Date Of Birth','date'],
                        ['mother_occupation','Mother\'s Occupation'],
                        ['mother_income','Mother\'s Income'],
                    ] as $cfg)
                        @php [$key,$label,$type] = array_pad($cfg,3,'text'); @endphp
                        <div class="col-md-4">
                            <label class="form-label">{{ $label }}</label>
                            <input type="{{ $type }}" class="form-control" name="family[{{ $key }}]" value="{{ $val('family_info',$key) }}">
                        </div>
                    @endforeach
                </div>

                <h6 class="mt-4">Spouse Details</h6>
                <div class="row g-3">
                    @foreach([
                        ['spouse_surname','Spouse\'s Surname'],
                        ['spouse_given_name','Spouse\'s Given Name'],
                        ['spouse_dob','Spouse\'s Date Of Birth','date'],
                        ['spouse_country','Spouse\'s Country'],
                        ['spouse_city_of_birth','Spouse\'s City Of Birth'],
                        ['spouse_address','Spouse\'s Address'],
                        ['spouse_city','City'],
                        ['spouse_state','State'],
                        ['spouse_postal_code','Postal Code'],
                        ['spouse_phone','Spouse\'s Phone Number'],
                        ['spouse_education','Spouse\'s Education'],
                        ['spouse_occupation','Spouse’s Occupation'],
                        ['spouse_income','Spouse’s Yearly Income'],
                    ] as $cfg)
                        @php [$key,$label,$type] = array_pad($cfg,3,'text'); @endphp
                        <div class="col-md-4">
                            <label class="form-label">{{ $label }}</label>
                            <input type="{{ $type }}" class="form-control" name="spouse[{{ $key }}]" value="{{ $val('spouse_info',$key) }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- =========================
        Education
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h6">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c6">
                Education
            </button>
        </h2>
        <div id="c6" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Upload Leaving Certificate</label>
                        <input type="file" name="education[leaving_certificate]" class="form-control">
                    </div>

                    <div class="col-12"><h6 class="mt-3">10th</h6></div>
                    <div class="col-md-3">
                        <label class="form-label">Passing Year</label>
                        <input name="education[tenth_year]" class="form-control" value="{{ $val('education_info','tenth_year') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Board name</label>
                        <input name="education[tenth_board]" class="form-control" value="{{ $val('education_info','tenth_board') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Percentage</label>
                        <input name="education[tenth_percentage]" class="form-control" value="{{ $val('education_info','tenth_percentage') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Upload Marksheet</label>
                        <input type="file" name="education[tenth_marksheet]" class="form-control">
                    </div>

                    <div class="col-12"><h6 class="mt-3">12th</h6></div>
                    <div class="col-md-3">
                        <label class="form-label">Passing Year</label>
                        <input name="education[twelfth_year]" class="form-control" value="{{ $val('education_info','twelfth_year') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Stream</label>
                        @php $stream=$val('education_info','twelfth_stream'); @endphp
                        <select name="education[twelfth_stream]" class="form-select">
                            @foreach(['Arts','Commerce','Science'] as $opt)
                                <option value="{{ $opt }}" @selected($stream===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Board name</label>
                        <input name="education[twelfth_board]" class="form-control" value="{{ $val('education_info','twelfth_board') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Percentage</label>
                        <input name="education[twelfth_percentage]" class="form-control" value="{{ $val('education_info','twelfth_percentage') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Upload Marksheet</label>
                        <input type="file" name="education[twelfth_marksheet]" class="form-control">
                    </div>

                    <div class="col-12"><h6 class="mt-3">Graduation</h6></div>
                    <div class="col-md-4">
                        <label class="form-label">Graduation Degree</label>
                        @php $gd=$val('education_info','grad_degree'); @endphp
                        <select name="education[grad_degree]" class="form-select">
                            @foreach([
                                'Bachelor of Fine Arts (B.F.A.)',
                                'Bachelor of Business Administration (B.B.A.)',
                                'Bachelor of Engineering (B.Eng. or B.S.E.)',
                                'Bachelor of Education (B.Ed.)',
                                'Bachelor of Medicine, Bachelor of Surgery (M.B.B.S.)',
                                'Bachelor of Laws (LL.B.)'
                            ] as $opt)
                                <option value="{{ $opt }}" @selected($gd===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">University Name</label>
                        <input name="education[grad_university]" class="form-control" value="{{ $val('education_info','grad_university') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Percentage</label>
                        <input name="education[grad_percentage]" class="form-control" value="{{ $val('education_info','grad_percentage') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Upload Marksheet</label>
                        <input type="file" name="education[grad_marksheet]" class="form-control">
                    </div>

                    <div class="col-12"><h6 class="mt-3">Post Graduation</h6></div>
                    <div class="col-md-4">
                        <label class="form-label">Post Graduation</label>
                        @php $pg=$val('education_info','pg_degree'); @endphp
                        <select name="education[pg_degree]" class="form-select">
                            @foreach([
                                'Master of Arts (M.A.)',
                                'Master of Science (M.S.)',
                                'Master of Business Administration (M.B.A)',
                                'Master of Education (M.Ed.)',
                                'Master of Fine Arts (M.F.A.)',
                                'Master of Public Health (M.P.H.)',
                                'Master of Social Work (M.S.W.)',
                                'Master of Laws (LL.M.)'
                            ] as $opt)
                                <option value="{{ $opt }}" @selected($pg===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">University Name</label>
                        <input name="education[pg_university]" class="form-control" value="{{ $val('education_info','pg_university') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Percentage</label>
                        <input name="education[pg_percentage]" class="form-control" value="{{ $val('education_info','pg_percentage') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Upload Marksheet</label>
                        <input type="file" name="education[pg_marksheet]" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================
        Preferred Job Details
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h7">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c7">
                Preferred Job Details
            </button>
        </h2>
        <div id="c7" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Preferred Designation</label>
                        <input name="education[preferred_designation]" class="form-control" value="{{ $val('education_info','preferred_designation') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Industry</label>
                        @php $ind=$val('education_info','preferred_industry'); @endphp
                        <select name="education[preferred_industry]" class="form-select">
                            @foreach(['Agriculture','Pharma','Food'] as $opt)
                                <option value="{{ $opt }}" @selected($ind===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">On Role / Off Role</label>
                        @php $onr=$val('education_info','on_role'); @endphp
                        <select name="education[on_role]" class="form-select">
                            @foreach(['On Role','Off Role'] as $opt)
                                <option value="{{ $opt }}" @selected($onr===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Preferred Country</label>
                        @php $pc=$val('education_info','preferred_country'); @endphp
                        <select name="education[preferred_country]" class="form-select">
                            @foreach(['Canada','US','UK','Europe','Other','Australia','New Zealand'] as $opt)
                                <option value="{{ $opt }}" @selected($pc===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================
        Professional Experience (repeatable)
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h8">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c8">
                Professional Experience
            </button>
        </h2>
        <div id="c8" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div id="jobsWrap">
                    @php $jobs = old('jobs', data_get($immigration,'job_history', [ [] ])); @endphp
                    @foreach($jobs as $i => $job)
                        <div class="border rounded p-3 mb-3 job-item" style="background:#fbfbfc;">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Duration (From)</label>
                                    <input name="jobs[{{ $i }}][from]" class="form-control" value="{{ $job['from'] ?? '' }}" placeholder="MM/YYYY">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">To</label>
                                    <input name="jobs[{{ $i }}][to]" class="form-control" value="{{ $job['to'] ?? '' }}" placeholder="MM/YYYY">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Country</label>
                                    <input name="jobs[{{ $i }}][country]" class="form-control" value="{{ $job['country'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Designation</label>
                                    <input name="jobs[{{ $i }}][designation]" class="form-control" value="{{ $job['designation'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Company name</label>
                                    <input name="jobs[{{ $i }}][company]" class="form-control" value="{{ $job['company'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Salary</label>
                                    <input name="jobs[{{ $i }}][salary]" class="form-control" value="{{ $job['salary'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Upload Offer letter</label>
                                    <input type="file" name="jobs[{{ $i }}][offer]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Upload Experience letter</label>
                                    <input type="file" name="jobs[{{ $i }}][experience]" class="form-control">
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2 remove-job">Remove</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-outline-primary" id="addJobBtn">+ Add More Job</button>
            </div>
        </div>
    </div>

    {{-- =========================
        Property Details & Financial Status
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h9">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c9">
                Property & Financial Status
            </button>
        </h2>
        <div id="c9" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Total Valuation</label>
                        <input name="property[total_valuation]" class="form-control" value="{{ $val('property_info','total_valuation') }}">
                    </div>
                    @foreach(['home'=>'Home','land'=>'Land','plot'=>'Plot','shop'=>'Shop','commercials'=>'Commecials','others'=>'Others'] as $k=>$label)
                        <div class="col-md-2 form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="property[{{ $k }}]" value="1"
                                   @checked((bool) data_get($immigration,'property_info.'.$k)) id="prop_{{ $k }}">
                            <label class="form-check-label" for="prop_{{ $k }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    <div class="col-md-6">
                        <label class="form-label">Upload Valuation Report</label>
                        <input type="file" name="property[valuation_report]" class="form-control">
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-3">
                        <label class="form-label">Father’s Income</label>
                        <input name="finance[father_income]" class="form-control" value="{{ $val('finance_info','father_income') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Mother’s Income</label>
                        <input name="finance[mother_income]" class="form-control" value="{{ $val('finance_info','mother_income') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Candidate’s Income</label>
                        <input name="finance[candidate_income]" class="form-control" value="{{ $val('finance_info','candidate_income') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Spouse Income</label>
                        <input name="finance[spouse_income]" class="form-control" value="{{ $val('finance_info','spouse_income') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">ITR File Upload</label>
                        <input type="file" name="finance[itr]" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================
        (Optional) Work / Education / Training Info (free text)
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h9b">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c9b">
                Work / Education / Training Information
            </button>
        </h2>
        <div id="c9b" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <textarea class="form-control" rows="3" name="education[notes]"
                    placeholder="Any additional details about work/education/training...">{{ $val('education_info','notes') }}</textarea>
            </div>
        </div>
    </div>

    {{-- =========================
        Travel Details (USA)
    ========================== --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="h10">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c10">
                Travel Details (USA)
            </button>
        </h2>
        <div id="c10" class="accordion-collapse collapse" data-bs-parent="#candAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    @foreach([
                        ['purpose','Purpose Of Trip To US'],
                        ['arrival_date','Date Of Arrival In USA','date'],
                        ['arrival_flight','Arrival Flight'],
                        ['arrival_city','Arrival City'],
                        ['departure_date','Date Of Departure From USA','date'],
                        ['departure_flight','Departure Flight'],
                        ['departure_city','Departure City'],
                        ['places_to_visit','Places To Visit In USA'],
                        ['us_phone','Phone Number (In USA)'],
                        ['us_address','Address Where You Will Stay In USA'],
                        ['us_city','City'],
                        ['us_state','State'],
                        ['us_zip','Postal/Zip Code'],
                        ['payer_details','Person Paying For Your Trip (Details)'],
                    ] as $cfg)
                        @php [$key,$label,$type] = array_pad($cfg,3,'text'); @endphp
                        <div class="col-md-4">
                            <label class="form-label">{{ $label }}</label>
                            <input type="{{ $type }}" class="form-control" name="travel[{{ $key }}]" value="{{ $val('travel_info',$key) }}">
                        </div>
                    @endforeach

                    {{-- Yes/No questions --}}
                    <div class="col-md-4">
                        <label class="form-label d-block">Is Your Mother In The US?</label>
                        @php $m=$val('travel_info','mother_in_us'); @endphp
                        <select name="travel[mother_in_us]" class="form-select">
                            @foreach(['Yes','No'] as $opt)
                                <option value="{{ $opt }}" @selected($m===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label d-block">Immediate Relatives In The US?</label>
                        @php $ir=$val('travel_info','immediate_relatives_in_us'); @endphp
                        <select name="travel[immediate_relatives_in_us]" class="form-select">
                            @foreach(['Yes','No'] as $opt)
                                <option value="{{ $opt }}" @selected($ir===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label d-block">Other Relatives In The US?</label>
                        @php $or=$val('travel_info','other_relatives_in_us'); @endphp
                        <select name="travel[other_relatives_in_us]" class="form-select">
                            @foreach(['Yes','No'] as $opt)
                                <option value="{{ $opt }}" @selected($or===$opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lead Source -> Other toggle
    const lsSel = document.getElementById('lead_source');
    const lsOther = document.getElementById('lead_source_other');
    function toggleOther() {
        if (!lsSel || !lsOther) return;
        if (lsSel.value === 'Other') lsOther.style.display = '';
        else { lsOther.style.display = 'none'; lsOther.value=''; }
    }
    toggleOther();
    if (lsSel) lsSel.addEventListener('change', toggleOther);

    // Add / Remove Job blocks
    const jobsWrap = document.getElementById('jobsWrap');
    const addBtn = document.getElementById('addJobBtn');
    if (jobsWrap && addBtn) {
        addBtn.addEventListener('click', () => {
            const idx = jobsWrap.querySelectorAll('.job-item').length;
            const html = `
            <div class="border rounded p-3 mb-3 job-item" style="background:#fbfbfc;">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Duration (From)</label>
                        <input name="jobs[${idx}][from]" class="form-control" placeholder="MM/YYYY">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">To</label>
                        <input name="jobs[${idx}][to]" class="form-control" placeholder="MM/YYYY">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Country</label>
                        <input name="jobs[${idx}][country]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Designation</label>
                        <input name="jobs[${idx}][designation]" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Company name</label>
                        <input name="jobs[${idx}][company]" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Salary</label>
                        <input name="jobs[${idx}][salary]" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Upload Offer letter</label>
                        <input type="file" name="jobs[${idx}][offer]" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Upload Experience letter</label>
                        <input type="file" name="jobs[${idx}][experience]" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 remove-job">Remove</button>
                    </div>
                </div>
            </div>`;
            jobsWrap.insertAdjacentHTML('beforeend', html);
        });

        jobsWrap.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-job')) {
                e.target.closest('.job-item').remove();
            }
        });
    }
});
</script>
@endpush
