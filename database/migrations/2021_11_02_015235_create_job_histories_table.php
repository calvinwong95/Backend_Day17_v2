<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_histories');
    }
}
