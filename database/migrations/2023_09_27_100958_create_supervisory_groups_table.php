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
        Schema::create('supervisory_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('supervisor_id');
            $table->integer('supervision_limit');
            $table->enum('supervision_type', ['project','siwes'])->default('project');
            $table->string('session');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisory_groups');
    }
};
