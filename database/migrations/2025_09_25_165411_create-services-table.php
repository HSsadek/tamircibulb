<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * create services table 
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //ilişkilendirmek için 
            $table->string('company_name');
            $table->text('description')->nullable();
            $table->string('working_hours')->nullable();
            $table->float('rating')->default(0);
            $table->boolean('verified')->default(false); //admin onayı 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
