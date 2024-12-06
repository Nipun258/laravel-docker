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
        Schema::create('course_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('course_code');
            $table->integer('subject_code')->default(0);
            $table->integer('reg_year');
            $table->integer('batch');
            $table->integer('intake');
            $table->double('amount',10,2);
            $table->integer('pay_income_type_id');
            $table->integer('created_emp')->nullable();
            $table->date('created_date')->nullable();
            $table->integer('updated_emp')->nullable();
            $table->date('updated_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_fees');
    }
};
