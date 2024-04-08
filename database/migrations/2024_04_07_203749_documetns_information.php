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
        Schema::create('documents_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professor_id');
            $table->foreignId('student_id');
            $table->foreignId('personnel_id');
            $table->string('type');
            $table->string('series');
            $table->string('number');
            $table->string('created');
            $table->date('created_from');
            $table->date('valid_until');
            $table->timestamp('created_at')->nullable();
            $table->integer('init_user')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_information');
    }
};
