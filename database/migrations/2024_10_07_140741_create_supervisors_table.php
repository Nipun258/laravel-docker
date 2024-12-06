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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->integer('applicant_id');
            $table->string('initials');
            $table->string('last_name');
            $table->string('permanent_add1')->nullable();
            $table->string('permanent_add2')->nullable();
            $table->string('permanent_add3')->nullable();
            $table->integer('permanent_city_id')->default(0);
            $table->string('email');
            $table->string('mobile_no',15);
            $table->string('tel_home',15)->nullable();
            $table->string('tel_office',15)->nullable();
            $table->integer('intercom')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
