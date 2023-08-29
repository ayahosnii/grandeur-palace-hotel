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
            $table->decimal('deduction_value', 8, 2)->default(0.00);
        });
    }

    public function down()
    {
        Schema::table('punctualities', function (Blueprint $table) {
            $table->dropColumn('deduction_value');
        });
    }

};
