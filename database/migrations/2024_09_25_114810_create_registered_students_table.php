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
        Schema::create('registered_students', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->string('old_nic',15);
            $table->string('new_nic',15);
            $table->integer('active_nic')->default(0);
            $table->string('intake');
            $table->string('reg_year');
            $table->integer('active');
            $table->integer('student_acc_id');
            $table->string('reg_no_report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_students');
    }
};
