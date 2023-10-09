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
        Schema::create('project_work_activities', function (Blueprint $table) {
            $table->id();
            $table->string('session')->unique();
            $table->enum('status', ['active','ended'])->default('active'); 
            $table->enum('submission_status', ['opened','closed'])->default('opened'); 
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_work_activities');
    }
};
