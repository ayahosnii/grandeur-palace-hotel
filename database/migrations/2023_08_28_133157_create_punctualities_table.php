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
        Schema::create('punctualities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_id');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'accept', 'reject'])->default('pending');
            $table->timestamps();

            $table->foreign('attendance_id')
                ->references('id')
                ->on('attendances')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('punctualities');
    }
};
