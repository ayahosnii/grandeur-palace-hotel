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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_type');
            $table->string('image');
            $table->decimal('price_per_night', 10, 2);
            $table->string('size');
            $table->integer('capacity');
            $table->string('bed_type');
            $table->text('services');
            $table->boolean('tv')->default(true);
            $table->boolean('wifi')->default(true);
            $table->boolean('air_condition')->default(true);
            $table->boolean('heater')->default(true);
            $table->boolean('phone')->default(true);
            $table->boolean('laundry')->default(false);
            $table->integer('adults')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
