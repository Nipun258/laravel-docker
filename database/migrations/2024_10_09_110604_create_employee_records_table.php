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
        Schema::create('employee_records', function (Blueprint $table) {
            $table->id();
            $table->integer('applicant_id');
            $table->integer('employment_type_id');
            $table->string('employer')->nullable();
            $table->string('postal_add1')->nullable();
            $table->string('postal_add2')->nullable();
            $table->string('postal_add3')->nullable();
            $table->integer('postal_city_id')->default(0);
            $table->string('designation');
            $table->string('institution');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_records');
    }
};
