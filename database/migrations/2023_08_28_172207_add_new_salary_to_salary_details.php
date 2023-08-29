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
        Schema::table('salary_details', function (Blueprint $table) {
            $table->decimal('new_salary', 10, 2)->default(0);
            $table->unique(['employee_id', 'effective_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salary_details', function (Blueprint $table) {
            $table->dropUnique(['employee_id', 'effective_date']);
            $table->dropColumn('new_salary');
        });
    }
};
