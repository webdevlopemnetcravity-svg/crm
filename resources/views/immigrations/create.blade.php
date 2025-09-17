@php
    // Frontend-only Blade view for creating a Candidate.
    // Save as: resources/views/candidates/create.blade.php
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Candidate</title>
  <style>
    :root{
      --bg:#0b0f19;/* deep navy */
      --card:#111827;/* slate-900 */
      --muted:#9ca3af;/* gray-400 */
      --text:#e5e7eb;/* gray-200 */
      --primary:#60a5fa;/* blue-400 */
      --ring:#2563eb;/* blue-600 */
      --danger:#ef4444;
      --ok:#10b981;
      --input:#1f2937;/* gray-800 */
      --border:#374151;/* gray-700 */
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; background:linear-gradient(180deg,var(--bg),#0a0d14 60%);
      color:var(--text); font: 14px/1.4 system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Helvetica Neue", Arial;
    }
    .wrap{max-width:1100px; margin:40px auto; padding:0 16px}
    .page-title{font-size:28px; font-weight:800; letter-spacing:.3px; margin:0 0 18px}
    .subtitle{color:var(--muted); margin:0 0 24px}

    .card{background:radial-gradient(1200px 300px at -200px -100px, rgba(96,165,250,.15),transparent), var(--card);
      border:1px solid var(--border); border-radius:16px; padding:22px; margin:18px 0; box-shadow: 0 10px 30px rgba(0,0,0,.25)}

    .grid{display:grid; gap:14px}
    .cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}
    .cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}
    .cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}
    @media (max-width:900px){.cols-4{grid-template-columns:repeat(2,1fr)}}
    @media (max-width:760px){.cols-2,.cols-3{grid-template-columns:1fr}}

    fieldset{border:none; margin:0; padding:0}
    legend{font-weight:700; font-size:16px; margin-bottom:10px}

    label{display:block; font-weight:600; margin:2px 0 6px}
    .hint{font-size:12px; color:var(--muted); margin-top:6px}
    .row{display:grid; gap:14px}

    input[type="text"],input[type="number"],input[type="date"],input[type="email"],input[type="tel"],select,textarea{
      width:100%; background:var(--input); color:var(--text); border:1px solid var(--border);
      border-radius:10px; padding:10px 12px; outline:none; transition:.15s ease;
    }
    textarea{min-height:90px; resize:vertical}
    input:focus,select:focus,textarea:focus{border-color:var(--ring); box-shadow:0 0 0 3px rgba(37,99,235,.25)}

    .inline{display:flex; align-items:center; gap:10px}
    .pill{display:inline-block; padding:4px 10px; border-radius:999px; background:#0d1726; border:1px solid var(--border); color:var(--muted); font-size:12px}

    .toolbar{display:flex; flex-wrap:wrap; gap:10px; align-items:center; justify-content:space-between; margin-bottom:12px}

    .btn{appearance:none; border:none; border-radius:10px; padding:10px 14px; font-weight:700; cursor:pointer; transition:.15s ease; color:#0b1220}
    .btn-primary{background:var(--primary)}
    .btn-ghost{background:transparent; color:var(--text); border:1px solid var(--border)}
    .btn:focus{outline:2px solid rgba(96,165,250,.35); outline-offset:3px}

    .note{padding:10px 12px; background:#0d1726; border:1px dashed var(--border); color:var(--muted); border-radius:12px}

    .divider{height:1px; background:linear-gradient(90deg,transparent,var(--border),transparent); margin:18px 0}

    .sr-only{position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); border:0}

    .danger{color:var(--danger)}
    .ok{color:var(--ok)}
  </style>
</head>
<body>
  <div class="wrap">
    <h1 class="page-title">Candidate Form</h1>
    <p class="subtitle">Frontend-only blade. Wire up routes/controllers as needed. Fields mirror your spec exactly; “Other” inputs are provided where required.</p>

    <form action="#" method="POST" enctype="multipart/form-data" class="card">
      @csrf

      <!-- Header / Lead Source & Core Info -->
      <div class="toolbar">
        <span class="pill">Create</span>
        <div class="inline" style="gap:8px">
          <button type="reset" class="btn btn-ghost">Reset</button>
          <button type="submit" class="btn btn-primary">Save Candidate</button>
        </div>
      </div>

      <fieldset class="card">
        <legend>Basic Details</legend>
        <div class="grid cols-4">
          <div>
            <label for="application_number">Application Number</label>
            <input id="application_number" name="application_number" type="text" placeholder="APP-2025-0001" />
          </div>
          <div>
            <label for="application_date">Application Date</label>
            <input id="application_date" name="application_date" type="date" />
          </div>
          <div>
            <label for="lead_source">Lead Source</label>
            <select id="lead_source" name="lead_source">
              <option value="">Select</option>
              <option>Social Media</option>
              <option>Friend or Family Member</option>
              <option>Online Ad</option>
              <option>Search Engine (e.g., Google, Bing)</option>
              <option>Article or Blog Post</option>
              <option>Podcast</option>
              <option>Event or Conference</option>
              <option>Email Newsletter</option>
              <option>Word of Mouth</option>
              <option>Other</option>
            </select>
            <div class="hint">If "Other", specify below.</div>
          </div>
          <div>
            <label for="lead_source_other">Lead Source – Other (Specify)</label>
            <input id="lead_source_other" name="lead_source_other" type="text" placeholder="Specify source" />
          </div>
        </div>
        <div class="grid cols-2" style="margin-top:10px">
          <div>
            <label for="resume">Upload Resume</label>
            <input id="resume" name="resume" type="file" />
          </div>
        </div>
      </fieldset>

      <!-- Personal Details -->
      <fieldset class="card">
        <legend>Personal Details</legend>
        <div class="grid cols-4">
          <div><label for="surname">Surname</label><input id="surname" name="surname" type="text" /></div>
          <div><label for="given_name">Given Name</label><input id="given_name" name="given_name" type="text" /></div>
          <div><label for="gender">Gender</label>
            <select id="gender" name="gender">
              <option value="">Select</option>
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
              <option>Prefer not to say</option>
            </select>
          </div>
          <div><label for="marital_status">Marital Status</label>
            <select id="marital_status" name="marital_status">
              <option value="">Select</option>
              <option>Single</option>
              <option>Married</option>
              <option>Divorced</option>
              <option>Widowed</option>
            </select>
          </div>
          <div><label for="dob">Date Of Birth (DD/MM/YY)</label><input id="dob" name="dob" type="date" /></div>
          <div><label for="nationality">Country Of Origin (Nationality)</label><input id="nationality" name="nationality" type="text" /></div>
          <div class="cols-2" style="grid-column:1/-1"></div>
        </div>

        <div class="divider"></div>

        <legend class="sr-only">Addresses</legend>
        <div class="grid cols-3">
          <div>
            <label for="home_address">Home Address</label>
            <input id="home_address" name="home_address" type="text" />
          </div>
          <div><label for="home_city">City</label><input id="home_city" name="home_city" type="text" /></div>
          <div><label for="home_state">State</label><input id="home_state" name="home_state" type="text" /></div>
          <div><label for="home_pin">Pincode</label><input id="home_pin" name="home_pin" type="text" /></div>
        </div>

        <div class="grid cols-3" style="margin-top:10px">
          <div>
            <label for="mail_address">Mailing Address</label>
            <input id="mail_address" name="mail_address" type="text" />
          </div>
          <div><label for="mail_city">City</label><input id="mail_city" name="mail_city" type="text" /></div>
          <div><label for="mail_state">State</label><input id="mail_state" name="mail_state" type="text" /></div>
          <div><label for="mail_pin">Pin Code</label><input id="mail_pin" name="mail_pin" type="text" /></div>
        </div>

        <div class="divider"></div>

        <div class="grid cols-4">
          <div><label for="phone_primary">Primary Phone No</label><input id="phone_primary" name="phone_primary" type="tel" /></div>
          <div><label for="phone_secondary">Secondary Phone No</label><input id="phone_secondary" name="phone_secondary" type="tel" /></div>
          <div><label for="phone_work">Work Phone No</label><input id="phone_work" name="phone_work" type="tel" /></div>
          <div><label for="phones_last5">Other Phone Numbers Used In Last Five Years</label><textarea id="phones_last5" name="phones_last5" placeholder="Comma-separated"></textarea></div>
          <div><label for="email">Email Address</label><input id="email" name="email" type="email" /></div>
          <div><label for="emails_last5">Other Email Addresses Used In Last Five Years</label><textarea id="emails_last5" name="emails_last5" placeholder="Comma-separated"></textarea></div>
          <div><label for="social_presence">Social Media Presence</label>
            <select id="social_presence" name="social_presence">
              <option value="">Select</option>
              <option>Facebook</option>
              <option>Instagram</option>
              <option>LinkedIn</option>
              <option>Twitter / X</option>
              <option>Other</option>
            </select>
          </div>
          <div><label for="social_username">Social Media Username</label><input id="social_username" name="social_username" type="text" /></div>
          <div style="grid-column:1/-1"><label for="webapps_last5">Other Websites/Applications Used In Last Five Years</label><textarea id="webapps_last5" name="webapps_last5"></textarea></div>
          <div style="grid-column:1/-1"><label for="languages">Languages Spoken</label><textarea id="languages" name="languages" placeholder="e.g., English, Hindi, Gujarati"></textarea></div>
        </div>
      </fieldset>

      <!-- Passport Details -->
      <fieldset class="card">
        <legend>Passport Details</legend>
        <div class="grid cols-4">
          <div><label for="passport_number">Passport Number</label><input id="passport_number" name="passport_number" type="text" /></div>
          <div><label for="passport_country">Issuing Country</label><input id="passport_country" name="passport_country" type="text" /></div>
          <div><label for="passport_city">City Where Issued</label><input id="passport_city" name="passport_city" type="text" /></div>
          <div><label for="passport_issue_date">Issuance Date</label><input id="passport_issue_date" name="passport_issue_date" type="date" /></div>
          <div><label for="passport_expiry">Expiration Date</label><input id="passport_expiry" name="passport_expiry" type="date" /></div>
          <div style="grid-column:1/-1"><label for="passport_lost">Lost Passport History</label><textarea id="passport_lost" name="passport_lost"></textarea></div>
        </div>
      </fieldset>

      <!-- Relative Contact Information (Optional) -->
      <fieldset class="card">
        <legend>Relative Contact Information (Optional)</legend>
        <div class="grid cols-4">
          <div><label for="rel_surname">Surname</label><input id="rel_surname" name="rel_surname" type="text" /></div>
          <div><label for="rel_given">Given Name</label><input id="rel_given" name="rel_given" type="text" /></div>
          <div><label for="rel_org">Organisation Name</label><input id="rel_org" name="rel_org" type="text" /></div>
          <div><label for="rel_relation">Relationship To You</label><input id="rel_relation" name="rel_relation" type="text" /></div>
          <div style="grid-column:1/-1"><label for="rel_us_address">US Contact Address</label><input id="rel_us_address" name="rel_us_address" type="text" /></div>
          <div><label for="rel_us_city">City</label><input id="rel_us_city" name="rel_us_city" type="text" /></div>
          <div><label for="rel_us_state">State</label><input id="rel_us_state" name="rel_us_state" type="text" /></div>
          <div><label for="rel_us_zip">Zip Code</label><input id="rel_us_zip" name="rel_us_zip" type="text" /></div>
          <div><label for="rel_email">Email Address</label><input id="rel_email" name="rel_email" type="email" /></div>
          <div><label for="rel_phone">Phone Number</label><input id="rel_phone" name="rel_phone" type="tel" /></div>
        </div>
      </fieldset>

      <!-- Family Information -->
      <fieldset class="card">
        <legend>Family Information</legend>
        <div class="grid cols-4">
          <div><label for="father_surname">Father's Surname</label><input id="father_surname" name="father_surname" type="text" /></div>
          <div><label for="father_given">Father's Given Name</label><input id="father_given" name="father_given" type="text" /></div>
          <div><label for="father_dob">Father's Date Of Birth</label><input id="father_dob" name="father_dob" type="date" /></div>
          <div><label for="father_occupation">Father’s Occupation</label><input id="father_occupation" name="father_occupation" type="text" /></div>
          <div><label for="father_income">Father’s Yearly Income</label><input id="father_income" name="father_income" type="number" step="0.01" /></div>
          <div><label for="mother_surname">Mother's Surname</label><input id="mother_surname" name="mother_surname" type="text" /></div>
          <div><label for="mother_given">Mother's Given Name</label><input id="mother_given" name="mother_given" type="text" /></div>
          <div><label for="mother_dob">Mother's Date Of Birth</label><input id="mother_dob" name="mother_dob" type="date" /></div>
          <div><label for="mother_occupation">Mother's Occupation</label><input id="mother_occupation" name="mother_occupation" type="text" /></div>
          <div><label for="mother_income">Mother's Income</label><input id="mother_income" name="mother_income" type="number" step="0.01" /></div>
        </div>
      </fieldset>

      <!-- Spouse Details -->
      <fieldset class="card">
        <legend>Spouse Details</legend>
        <div class="grid cols-4">
          <div><label for="spouse_surname">Spouse's Surname</label><input id="spouse_surname" name="spouse_surname" type="text" /></div>
          <div><label for="spouse_given">Spouse's Given Name</label><input id="spouse_given" name="spouse_given" type="text" /></div>
          <div><label for="spouse_dob">Spouse's Date Of Birth</label><input id="spouse_dob" name="spouse_dob" type="date" /></div>
          <div><label for="spouse_country">Spouse's Country</label><input id="spouse_country" name="spouse_country" type="text" /></div>
          <div><label for="spouse_city_birth">Spouse's City Of Birth</label><input id="spouse_city_birth" name="spouse_city_birth" type="text" /></div>
          <div style="grid-column:1/-1"><label for="spouse_address">Spouse's Address</label><input id="spouse_address" name="spouse_address" type="text" /></div>
          <div><label for="spouse_city">City</label><input id="spouse_city" name="spouse_city" type="text" /></div>
          <div><label for="spouse_state">State</label><input id="spouse_state" name="spouse_state" type="text" /></div>
          <div><label for="spouse_postal">Postal Code</label><input id="spouse_postal" name="spouse_postal" type="text" /></div>
          <div><label for="spouse_phone">Spouse's Phone Number</label><input id="spouse_phone" name="spouse_phone" type="tel" /></div>
          <div><label for="spouse_education">Spouse's Education</label><input id="spouse_education" name="spouse_education" type="text" /></div>
          <div><label for="spouse_occupation">Spouse’s Occupation</label><input id="spouse_occupation" name="spouse_occupation" type="text" /></div>
          <div><label for="spouse_income">Spouse’s Yearly Income</label><input id="spouse_income" name="spouse_income" type="number" step="0.01" /></div>
        </div>
      </fieldset>

      <!-- Education -->
      <fieldset class="card">
        <legend>Education</legend>
        <div class="grid cols-3">
          <div style="grid-column:1/-1"><label for="leaving_certificate">Upload Leaving Certificate</label><input id="leaving_certificate" name="leaving_certificate" type="file" /></div>
          <div><label for="tenth_year">10th Passing Year</label><input id="tenth_year" name="tenth_year" type="text" /></div>
          <div><label for="tenth_board">Board Name</label><input id="tenth_board" name="tenth_board" type="text" /></div>
          <div><label for="tenth_percentage">Percentage</label><input id="tenth_percentage" name="tenth_percentage" type="number" step="0.01" /></div>
          <div style="grid-column:1/-1"><label for="tenth_marksheet">Upload 10th Marksheet</label><input id="tenth_marksheet" name="tenth_marksheet" type="file" /></div>
        </div>

        <div class="divider"></div>

        <div class="grid cols-3">
          <div><label for="twelfth_year">12th Passing Year</label><input id="twelfth_year" name="twelfth_year" type="text" /></div>
          <div><label for="twelfth_stream">Stream</label>
            <select id="twelfth_stream" name="twelfth_stream">
              <option value="">Select</option>
              <option>Arts</option>
              <option>Commerce</option>
              <option>Science</option>
            </select>
          </div>
          <div><label for="twelfth_board">Board Name</label><input id="twelfth_board" name="twelfth_board" type="text" /></div>
          <div><label for="twelfth_percentage">Percentage</label><input id="twelfth_percentage" name="twelfth_percentage" type="number" step="0.01" /></div>
          <div style="grid-column:1/-1"><label for="twelfth_marksheet">Upload 12th Marksheet</label><input id="twelfth_marksheet" name="twelfth_marksheet" type="file" /></div>
        </div>

        <div class="divider"></div>

        <div class="grid cols-3">
          <div><label for="grad_degree">Graduation Degree</label>
            <select id="grad_degree" name="grad_degree">
              <option value="">Select</option>
              <option>Bachelor of Fine Arts (B.F.A.)</option>
              <option>Bachelor of Business Administration (B.B.A.)</option>
              <option>Bachelor of Engineering (B.Eng. or B.S.E.)</option>
              <option>Bachelor of Education (B.Ed.)</option>
              <option>Bachelor of Medicine, Bachelor of Surgery (M.B.B.S.)</option>
              <option>Bachelor of Laws (LL.B.)</option>
            </select>
          </div>
          <div><label for="grad_university">University Name</label><input id="grad_university" name="grad_university" type="text" /></div>
          <div><label for="grad_percentage">Percentage</label><input id="grad_percentage" name="grad_percentage" type="number" step="0.01" /></div>
          <div style="grid-column:1/-1"><label for="grad_marksheet">Upload Graduation Marksheet</label><input id="grad_marksheet" name="grad_marksheet" type="file" /></div>
        </div>

        <div class="divider"></div>

        <div class="grid cols-3">
          <div><label for="pg_degree">Post Graduation</label>
            <select id="pg_degree" name="pg_degree">
              <option value="">Select</option>
              <option>Master of Arts (M.A.)</option>
              <option>Master of Science (M.S.)</option>
              <option>Master of Business Administration (M.B.A)</option>
              <option>Master of Education (M.Ed.)</option>
              <option>Master of Fine Arts (M.F.A.)</option>
              <option>Master of Public Health (M.P.H.)</option>
              <option>Master of Social Work (M.S.W.)</option>
              <option>Master of Laws (LL.M.)</option>
            </select>
          </div>
          <div><label for="pg_university">University Name</label><input id="pg_university" name="pg_university" type="text" /></div>
          <div><label for="pg_percentage">Percentage</label><input id="pg_percentage" name="pg_percentage" type="number" step="0.01" /></div>
        </div>
      </fieldset>

      <!-- Preferred Job Details -->
      <fieldset class="card">
        <legend>Preferred Job Details</legend>
        <div class="grid cols-4">
          <div><label for="pref_designation">Preferred Designation</label><input id="pref_designation" name="pref_designation" type="text" /></div>
          <div><label for="industry">Industry</label>
            <select id="industry" name="industry">
              <option value="">Select</option>
              <option>Agriculture</option>
              <option>Pharma</option>
              <option>Food</option>
            </select>
          </div>
          <div><label for="role_type">On Role / Off Role</label>
            <select id="role_type" name="role_type">
              <option value="">Select</option>
              <option>On Role</option>
              <option>Off Role</option>
            </select>
          </div>
          <div><label for="pref_country">Preferred Country</label>
            <select id="pref_country" name="pref_country">
              <option value="">Select</option>
              <option>Canada</option>
              <option>US</option>
              <option>UK</option>
              <option>Europe</option>
              <option>Other</option>
              <option>Australia</option>
              <option>New Zealand</option>
            </select>
          </div>
        </div>
      </fieldset>

      <!-- Professional Experience -->
      <fieldset class="card">
        <legend>Professional Experience</legend>
        <div class="note">Add More Job button is present for UI. Hook up JS later to clone the “Job 1” block.</div>
        <div class="card" id="job_1">
          <legend>Job 1</legend>
          <div class="grid cols-4">
            <div><label for="job1_duration_from">Duration – From</label><input id="job1_duration_from" name="job1_duration_from" type="month" /></div>
            <div><label for="job1_duration_to">Duration – To</label><input id="job1_duration_to" name="job1_duration_to" type="month" /></div>
            <div><label for="job1_country">Country</label><input id="job1_country" name="job1_country" type="text" /></div>
            <div><label for="job1_designation">Designation</label><input id="job1_designation" name="job1_designation" type="text" /></div>
            <div style="grid-column:1/-1"><label for="job1_company">Company Name</label><input id="job1_company" name="job1_company" type="text" /></div>
            <div><label for="job1_salary">Salary</label><input id="job1_salary" name="job1_salary" type="number" step="0.01" /></div>
            <div><label for="job1_offer">Upload Offer Letter</label><input id="job1_offer" name="job1_offer" type="file" /></div>
            <div><label for="job1_experience">Upload Experience Letter</label><input id="job1_experience" name="job1_experience" type="file" /></div>
          </div>
        </div>
        <div style="margin-top:10px" class="inline">
          <button type="button" class="btn btn-ghost" data-action="add-job">+ Add More Job</button>
        </div>
      </fieldset>

      <!-- Property Details -->
      <fieldset class="card">
        <legend>Property Details</legend>
        <div class="grid cols-4">
          <div style="grid-column:1/-1"><label for="property_total">Total Valuation</label><input id="property_total" name="property_total" type="number" step="0.01" /></div>
          <div class="inline"><input type="checkbox" id="prop_home" name="prop_home" /><label for="prop_home">Home</label></div>
          <div class="inline"><input type="checkbox" id="prop_land" name="prop_land" /><label for="prop_land">Land</label></div>
          <div class="inline"><input type="checkbox" id="prop_plot" name="prop_plot" /><label for="prop_plot">Plot</label></div>
          <div class="inline"><input type="checkbox" id="prop_shop" name="prop_shop" /><label for="prop_shop">Shop</label></div>
          <div class="inline"><input type="checkbox" id="prop_comm" name="prop_comm" /><label for="prop_comm">Commercials</label></div>
          <div class="inline"><input type="checkbox" id="prop_other" name="prop_other" /><label for="prop_other">Others</label></div>
          <div style="grid-column:1/-1"><label for="valuation_report">Upload Valuation Report</label><input id="valuation_report" name="valuation_report" type="file" /></div>
        </div>
      </fieldset>

      <!-- Financial Status -->
      <fieldset class="card">
        <legend>Financial Status</legend>
        <div class="grid cols-4">
          <div><label for="fin_father_income">Father’s Income</label><input id="fin_father_income" name="fin_father_income" type="number" step="0.01" /></div>
          <div><label for="fin_mother_income">Mother’s Income</label><input id="fin_mother_income" name="fin_mother_income" type="number" step="0.01" /></div>
          <div><label for="fin_candidate_income">Candidate’s Income</label><input id="fin_candidate_income" name="fin_candidate_income" type="number" step="0.01" /></div>
          <div><label for="fin_spouse_income">Spouse Income</label><input id="fin_spouse_income" name="fin_spouse_income" type="number" step="0.01" /></div>
          <div style="grid-column:1/-1"><label for="financials_attachments">IT Returns / Files (Upload)</label><input id="financials_attachments" name="financials_attachments" type="file" multiple /></div>
        </div>
      </fieldset>

      <!-- Work / Education / Training Information (free text) -->
      <fieldset class="card">
        <legend>Work / Education / Training Information</legend>
        <textarea name="wet_info" id="wet_info" placeholder="Enter details..."></textarea>
      </fieldset>

      <!-- Travel Details (US) -->
      <fieldset class="card">
        <legend>Travel Details (US)</legend>
        <div class="grid cols-4">
          <div style="grid-column:1/-1"><label for="trip_purpose">Purpose Of Trip To US</label><input id="trip_purpose" name="trip_purpose" type="text" /></div>
          <div><label for="arrive_date">Date Of Arrival In USA</label><input id="arrive_date" name="arrive_date" type="date" /></div>
          <div><label for="arrive_flight">Arrival Flight</label><input id="arrive_flight" name="arrive_flight" type="text" /></div>
          <div><label for="arrive_city">Arrival City</label><input id="arrive_city" name="arrive_city" type="text" /></div>
          <div><label for="depart_date">Date Of Departure From USA</label><input id="depart_date" name="depart_date" type="date" /></div>
          <div><label for="depart_flight">Departure Flight</label><input id="depart_flight" name="depart_flight" type="text" /></div>
          <div><label for="depart_city">Departure City</label><input id="depart_city" name="depart_city" type="text" /></div>
          <div style="grid-column:1/-1"><label for="places_us">Places To Visit In USA</label><textarea id="places_us" name="places_us"></textarea></div>
          <div><label for="us_phone">Phone Number (In USA)</label><input id="us_phone" name="us_phone" type="tel" /></div>
          <div style="grid-column:1/-1"><label for="us_address">Address Where You Will Stay In USA</label><input id="us_address" name="us_address" type="text" /></div>
          <div><label for="us_city">City</label><input id="us_city" name="us_city" type="text" /></div>
          <div><label for="us_state">State</label><input id="us_state" name="us_state" type="text" /></div>
          <div><label for="us_zip">Postal/Zip Code</label><input id="us_zip" name="us_zip" type="text" /></div>
          <div style="grid-column:1/-1"><label for="payer_details">Person Paying For Your Trip (Details)</label><textarea id="payer_details" name="payer_details"></textarea></div>
          <div><label for="mother_in_us">Is Your Mother In The US?</label>
            <select id="mother_in_us" name="mother_in_us"><option value="">Select</option><option>Yes</option><option>No</option></select>
          </div>
          <div><label for="immediate_relatives_us">Immediate Relatives In The US?</label>
            <select id="immediate_relatives_us" name="immediate_relatives_us"><option value="">Select</option><option>Yes</option><option>No</option></select>
          </div>
          <div><label for="other_relatives_us">Other Relatives In The US?</label>
            <select id="other_relatives_us" name="other_relatives_us"><option value="">Select</option><option>Yes</option><option>No</option></select>
          </div>
        </div>
      </fieldset>

      <!-- Footer Buttons -->
      <div class="toolbar">
        <div class="inline" style="gap:8px">
          <button type="reset" class="btn btn-ghost">Reset</button>
        </div>
        <button type="submit" class="btn btn-primary">Save Candidate</button>
      </div>
    </form>

    <p class="hint">Note: This is a static frontend. Add server-side validation, old() bindings, error states, and JS where needed.</p>
  </div>
</body>
</html>
