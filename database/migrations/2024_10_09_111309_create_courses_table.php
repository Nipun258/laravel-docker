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
        Schema::create('courses', function (Blueprint $table) {
            $table->id()->startingValue(3000);
            $table->integer('previous_course_code')->nullable();
            $table->integer('course_main_category');
            $table->integer('course_application_open_method');
            $table->string('course_name');
            $table->integer('medium_cat_id');
            $table->integer('payment_course_code');
            $table->integer('application_acc_number')->nullable();
            $table->integer('course_cat_id');
            $table->integer('study_board_id');
            $table->integer('created_emp')->nullable();
            $table->date('created_date')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
