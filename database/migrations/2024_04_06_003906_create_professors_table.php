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
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('parent_name')->nullable();
            $table->string('permission');
            $table->string('function')->nullable();
            $table->integer('status_code');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignIdFor(\App\Models\University::class,  'university_id');
            $table->foreignIdFor(\App\Models\Department::class,  'department_id');
            $table->string('uid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
