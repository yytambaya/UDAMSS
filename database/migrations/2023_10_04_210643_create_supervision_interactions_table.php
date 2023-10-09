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
        Schema::create('supervisory_interactions', function (Blueprint $table) {
            $table->id();
            $table->integer('supervisory_group_id');
            $table->integer('user_id');
            $table->enum('publicity', ['private','public'])->default('private');
            $table->enum('status', ['active','hidden','deleted'])->default('active');
            $table->longText('content');
            $table->integer('likes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervision_interactions');
    }
};
