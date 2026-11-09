<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nim');
            $table->string('university');
            $table->string('major');
            $table->string('semester');
            $table->string('gpa');
            $table->string('phone');
            $table->text('address');
            $table->text('skills');
            $table->text('experiences');
            $table->text('motivation'); // Alasan mendaftar beasiswa
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicant_profiles');
    }
};