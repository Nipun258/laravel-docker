<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->integer('open_application_id')->index();
            $table->string('reference_no');

            $table->integer('title_id')->default(0);
            $table->string('initials')->nullable();
            $table->string('name_denoted_by_initials')->nullable();
            $table->string('last_name')->nullable();
            $table->string('old_nic',15);
            $table->string('new_nic',15);
            $table->integer('active_nic')->default(0);
            $table->date('dob');
            $table->integer('gender_cat_id')->default(0);
            $table->integer('civil_status_cat_id')->default(0);

            $table->string('permanent_add1')->nullable();
            $table->string('permanent_add2')->nullable();
            $table->string('permanent_add3')->nullable();
            $table->integer('permanent_city_id')->nullable();
            $table->string('postal_add1')->nullable();
            $table->string('postal_add2')->nullable();
            $table->string('postal_add3')->nullable();
            $table->integer('postal_city_id')->nullable();
            $table->string('email');
            $table->string('mobile_no',15)->nullable();
            $table->string('tel_home',15)->nullable();
            $table->string('tel_office',15)->nullable();

            $table->string('ref_name1')->nullable();
            $table->string('ref_email1')->nullable();
            $table->string('ref_mobile1',15)->nullable();
            $table->string('ref_name2')->nullable();
            $table->string('ref_email2')->nullable();
            $table->string('ref_mobile2',15)->nullable();

            $table->string('proposal_title',512)->nullable();

            $table->string('first_degree_name')->nullable();
            $table->text('major_subject')->nullable();
            $table->string('university')->nullable();
            $table->integer('class_cat_id')->default(0);
            $table->date('effective_date')->nullable();
            $table->integer('duration_cat_id')->default(0);
            $table->double('gpa')->nullable();

            $table->double('application_fee',10,2)->nullable();

            $table->integer('short_list_status')->default(0);
            $table->integer('coordinator_emp_no')->nullable();
            $table->date('short_list_date')->nullable();

            $table->integer('doc_check')->default(0);
            $table->integer('registrar_emp_no')->nullable();
            $table->date('doc_check_date')->nullable();

            $table->integer('interview')->default(0);
            $table->integer('coordinator_interview_emp_no')->nullable();
            $table->date('interview_date')->nullable();

            $table->integer('payment_type_cat_id')->default(0);
            $table->integer('insert_payment_system_status')->default(0);
            $table->date('insert_payment_system_date')->nullable();
            $table->integer('application_fee_payment_status')->default(0);
            $table->date('application_fee_payment_date')->nullable();
            $table->integer('submit_status')->default(0);
            $table->date('basic_data_submit_date')->nullable();
            $table->date('final_submit_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};

