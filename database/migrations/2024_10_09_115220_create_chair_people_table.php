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
        Schema::create('chair_people', function (Blueprint $table) {
            $table->id();
            $table->integer('study_board_id');
            $table->integer('emp_no');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('appointment_type_id');
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
        Schema::dropIfExists('chair_people');
    }
};
