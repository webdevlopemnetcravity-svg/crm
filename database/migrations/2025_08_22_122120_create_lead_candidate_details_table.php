<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('lead_candidate_details', function (Blueprint $table) {
        $table->id();

        // If your lead table is named 'lead_contacts', keep this.
        // If it's 'leads', change the column name accordingly in Step 2 (I'll handle it).
        $table->unsignedBigInteger('lead_contact_id')->index()->nullable();

        // Top-level replacements
        $table->string('application_number')->unique();
        $table->date('application_date')->nullable();

        // Files
        $table->string('resume_path')->nullable();
        $table->string('it_return_path')->nullable();
        $table->string('valuation_report_path')->nullable();

        // Grouped sections as JSON (easy to expand later)
        $table->json('personal_details')->nullable();         // surname, given name, gender, phones, emails, socials, etc.
        $table->json('passport_details')->nullable();         // number, country, city, issue/expiry, lost history
        $table->json('relative_contact')->nullable();         // optional US contact
        $table->json('parents_details')->nullable();
        $table->json('spouse_details')->nullable();

        $table->json('education')->nullable();                // 10th, 12th, grad, PG + files
        $table->json('experience')->nullable();               // repeatable jobs + files
        $table->json('property_details')->nullable();         // valuation + types
        $table->json('financial_status')->nullable();         // father/mother/candidate/spouse income
        $table->json('work_education_training')->nullable();  // extra section you mentioned
        $table->json('travel_details')->nullable();           // purpose, flights, addresses, relatives in US etc.

        // Lead source (we’ll also seed options in Step 2)
        $table->string('lead_source')->nullable();            // store the selected source
        $table->string('lead_source_other')->nullable();      // if "Other" specify text

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('lead_candidate_details');
    }
};
