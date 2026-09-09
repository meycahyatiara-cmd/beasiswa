<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['full', 'partial'])->default('partial');
            $table->enum('level', ['S1', 'S2', 'S3', 'D3'])->default('S1');
            $table->string('field_of_study')->nullable();
            $table->date('deadline');
            $table->string('link')->nullable();
            $table->text('requirements')->nullable();
            $table->integer('quota')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scholarships');
    }
};