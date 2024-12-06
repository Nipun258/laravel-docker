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
        Schema::create('study_board_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
        Schema::dropIfExists('study_board_subjects');
    }
};
