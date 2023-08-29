<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('absences', 10, 2)->default(0);
            $table->decimal('loans', 10, 2)->default(0);
            $table->decimal('health_insurance', 10, 2)->default(0);
            $table->decimal('incentives', 10, 2)->default(0);
            $table->decimal('commissions', 10, 2)->default(0);
            $table->date('effective_date');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_details');
    }
};
