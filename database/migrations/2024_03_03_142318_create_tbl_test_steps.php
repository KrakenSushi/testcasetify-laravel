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
        Schema::create('tbl_test_steps', function (Blueprint $table) {
            $table->id('step_id');
            $table->unsignedBigInteger('test_case_id');
            $table->foreign('test_case_id')->references('id')->on('tbl_test_cases');
            $table->integer('project_id');
            $table->integer('step_num');
            $table->text('test_step');
            $table->text('test_data');
            $table->text('expected_result');
            $table->text('actual_result');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_test_steps');
    }
};
