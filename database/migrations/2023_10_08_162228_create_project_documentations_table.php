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
        Schema::create('project_documentations', function (Blueprint $table) {
            $table->id();
            $table->integer('supervisee_id');
            $table->integer('version');
            $table->enum('chapter_no', ['1','2','3','4','5'])->default('1');
            $table->enum('status', ['approved','unapproved','none'])->default('unapproved');
            $table->enum('type', ['upload','review'])->default('upload');
            $table->LongText('comment');
            $table->string('filename');
            $table->string('session');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_documentations');
    }
};
