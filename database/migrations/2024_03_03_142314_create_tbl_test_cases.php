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
        Schema::create('tbl_test_cases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('project_id')->on('tbl_projects');
            $table->string('tc_title');
            $table->integer('tc_num');
            $table->string('tc_des_by');
            $table->string('tc_priority');
            $table->string('tc_des_date');
            $table->string('tc_module_name');
            $table->string('tc_exec_by');
            $table->text('tc_desc');
            $table->string('tc_exec_date');
            $table->string('tc_precon');
            $table->string('tc_postcon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_test_cases');
    }
};
