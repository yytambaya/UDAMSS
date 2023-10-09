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
        Schema::table('supervisees', function (Blueprint $table) {
            $table->enum('assignment_type', ['auto','manual','applied','reassined'])->default('applied'); 
            $table->enum('assignment_action', ['noaction','approved','rejected'])->default('noaction'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisees');
    }
};
