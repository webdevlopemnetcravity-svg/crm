@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <x-form id="save-candidate-form" enctype="multipart/form-data">
            <div class="add-client bg-white rounded p-4">

                <h4 class="mb-4">Immigration Candidate Form</h4>

                {{-- ============================= LEAD SOURCE ============================= --}}
                <div class="form-group">
                    <x-forms.select fieldId="lead_source" fieldLabel="Lead Source" fieldName="lead_source" fieldRequired="true">
                        <option value="">Select Lead Source</option>
                        <option>Social Media</option>
                        <option>Friend or Family Member</option>
                        <option>Online Ad</option>
                        <option>Search Engine (Google, Bing)</option>
                        <option>Article or Blog Post</option>
                        <option>Podcast</option>
                        <option>Event or Conference</option>
                        <option>Email Newsletter</option>
                        <option>Word of Mouth</option>
                        <option>Other</option>
                    </x-forms.select>
                </div>

                {{-- ============================= APPLICATION DETAILS ============================= --}}
                <div class="form-group">
                    <x-forms.text fieldLabel="Application Number" fieldName="application_number" fieldId="application_number" fieldRequired="true"/>
                </div>
                <div class="form-group">
                    <x-forms.datepicker fieldLabel="Application Date" fieldName="application_date" fieldId="application_date" fieldRequired="true"/>
                </div>
                <div class="form-group">
                    <label>Upload Resume</label>
                    <input type="file" name="resume" class="form-control">
                </div>

                {{-- ============================= PERSONAL DETAILS ============================= --}}
                <h5 class="mt-4">Personal Details</h5>
                <div class="form-group">
                    <x-forms.text fieldLabel="Surname" fieldName="surname" fieldId="surname" fieldRequired="true"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Given Name" fieldName="given_name" fieldId="given_name" fieldRequired="true"/>
                </div>
                <div class="form-group">
                    <x-forms.select fieldId="gender" fieldLabel="Gender" fieldName="gender" fieldRequired="true">
                        <option value="">Select</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </x-forms.select>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Marital Status" fieldName="marital_status" fieldId="marital_status"/>
                </div>
                <div class="form-group">
                    <x-forms.datepicker fieldLabel="Date of Birth" fieldName="dob" fieldId="dob"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Country of Origin" fieldName="country_origin" fieldId="country_origin"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Country of Residence" fieldName="country_residence" fieldId="country_residence"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Contact Number" fieldName="phone" fieldId="phone"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Email Address" fieldName="email" fieldId="email"/>
                </div>
                <div class="form-group">
                    <label>Upload Profile Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>

                {{-- ============================= PASSPORT DETAILS ============================= --}}
                <h5 class="mt-4">Passport Details</h5>
                <div class="form-group">
                    <x-forms.text fieldLabel="Passport Number" fieldName="passport_number" fieldId="passport_number"/>
                </div>
                <div class="form-group">
                    <x-forms.datepicker fieldLabel="Issue Date" fieldName="passport_issue_date" fieldId="passport_issue_date"/>
                </div>
                <div class="form-group">
                    <x-forms.datepicker fieldLabel="Expiry Date" fieldName="passport_expiry_date" fieldId="passport_expiry_date"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Place of Issue" fieldName="passport_place" fieldId="passport_place"/>
                </div>

                {{-- ============================= EDUCATION DETAILS ============================= --}}
                <h5 class="mt-4">Education</h5>
                <div class="form-group">
                    <x-forms.text fieldLabel="Highest Qualification" fieldName="highest_qualification" fieldId="highest_qualification"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Institution Name" fieldName="institution_name" fieldId="institution_name"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Year of Graduation" fieldName="year_of_graduation" fieldId="year_of_graduation"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Languages Known" fieldName="languages" fieldId="languages"/>
                </div>
                <div class="form-group">
                    <label>Upload Certificates</label>
                    <input type="file" name="certificates[]" multiple class="form-control">
                </div>

                {{-- ============================= WORK EXPERIENCE ============================= --}}
                <h5 class="mt-4">Work Experience</h5>
                <div class="form-group">
                    <x-forms.text fieldLabel="Current Occupation" fieldName="occupation" fieldId="occupation"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Employer/Company" fieldName="company" fieldId="company"/>
                </div>
                <div class="form-group">
                    <x-forms.number fieldLabel="Years of Experience" fieldName="experience_years" fieldId="experience_years"/>
                </div>
                <div class="form-group">
                    <label>Upload Resume/CV</label>
                    <input type="file" name="experience_resume" class="form-control">
                </div>

                {{-- ============================= FAMILY DETAILS ============================= --}}
                <h5 class="mt-4">Family Details</h5>
                <div class="form-group">
                    <x-forms.text fieldLabel="Spouse Name" fieldName="spouse_name" fieldId="spouse_name"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Children (if any)" fieldName="children" fieldId="children"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Father's Name" fieldName="father_name" fieldId="father_name"/>
                </div>
                <div class="form-group">
                    <x-forms.text fieldLabel="Mother's Name" fieldName="mother_name" fieldId="mother_name"/>
                </div>

                {{-- ============================= ADDITIONAL DETAILS ============================= --}}
                <h5 class="mt-4">Additional Information</h5>
                <div class="form-group">
                    <x-forms.textarea fieldLabel="Reason for Immigration" fieldName="reason" fieldId="reason"/>
                </div>
                <div class="form-group">
                    <x-forms.textarea fieldLabel="Other Notes" fieldName="notes" fieldId="notes"/>
                </div>

                {{-- ============================= ACTION BUTTONS ============================= --}}
                <x-form-actions>
                    <x-forms.button-primary id="save-candidate-form-btn" icon="check">Save</x-forms.button-primary>
                    <x-forms.button-cancel :link="route('lead-contact.index')" class="border-0">Cancel</x-forms.button-cancel>
                </x-form-actions>

            </div>
        </x-form>
    </div>
</div>
@endsection
