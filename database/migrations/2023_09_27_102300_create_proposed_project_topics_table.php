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
        Schema::create('proposed_project_topics', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->longText('topic_1');
            $table->longText('topic_2');
            $table->longText('topic_3');
            $table->enum('approved_topic', ['1','2','3'])->default('1'); 
            $table->string('session');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposed_project_topics');
    }
};
