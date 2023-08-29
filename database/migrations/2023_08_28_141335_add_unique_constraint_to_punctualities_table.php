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
        Schema::table('punctualities', function (Blueprint $table) {
            $table->unique('attendance_id');
        });
    }

    public function down()
    {
        Schema::table('punctualities', function (Blueprint $table) {
            $table->dropUnique('punctualities_attendance_id_unique');
        });
    }
};
