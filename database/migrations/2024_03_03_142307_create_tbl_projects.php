<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public $timestamps = false;
    
    public function up(): void
    {
        Schema::create('tbl_projects', function (Blueprint $table) {
            $table->id('project_id');
            $table->unsignedBigInteger('project_owner');
            $table->foreign('project_owner')->references('id')->on('tbl_users');
            $table->string('project_name');
            $table->text('project_members');
            $table->text('project_desc');
            $table->integer('status');
            $table->timestamp('last_access');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_projects');
    }
};
