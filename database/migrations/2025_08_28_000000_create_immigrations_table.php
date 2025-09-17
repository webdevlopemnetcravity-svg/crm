<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('immigrations', function (Blueprint $table) {
            if (!Schema::hasColumn('immigrations', 'application_number')) {
                $table->string('application_number')->nullable()->after('assigned_to');
            }
            if (!Schema::hasColumn('immigrations', 'application_date')) {
                $table->date('application_date')->nullable()->after('application_number');
            }
            if (!Schema::hasColumn('immigrations', 'lead_source')) {
                $table->string('lead_source')->nullable()->after('application_date');
            }
            if (!Schema::hasColumn('immigrations', 'lead_source_other')) {
                $table->string('lead_source_other')->nullable()->after('lead_source');
            }
            if (!Schema::hasColumn('immigrations', 'resume_path')) {
                $table->string('resume_path')->nullable()->after('document_two');
            }

            foreach ([
                'personal_info','passport_info','relative_info','family_info',
                'spouse_info','education_info','job_history','property_info',
                'finance_info','travel_info'
            ] as $col) {
                if (!Schema::hasColumn('immigrations', $col)) {
                    $table->json($col)->nullable()->after('resume_path');
                }
            }
        });
    }

    public function down(): void {
        Schema::table('immigrations', function (Blueprint $table) {
            $table->dropColumn([
                'application_number','application_date','lead_source','lead_source_other',
                'resume_path','personal_info','passport_info','relative_info','family_info',
                'spouse_info','education_info','job_history','property_info',
                'finance_info','travel_info'
            ]);
        });
    }
};
