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
        Schema::create('open_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('application_type_id');
            $table->integer('course_code');
            $table->integer('subject_code')->default(0);
            $table->integer('reg_year');
            $table->integer('intake');
            $table->date('start_date');
            $table->date('closing_Date');
            $table->string('display_name')->nullable();
            $table->integer('deadline_extented_status')->default(0);
            $table->date('deadline_extented_date')->nullable();
            $table->integer('deadline_extented_emp')->nullable();
            $table->integer('created_emp');
            $table->date('created_date');
            $table->integer('updated_emp')->nullable();
            $table->date('updated_date')->nullable();
            $table->integer('active_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_applications');
    }
};
