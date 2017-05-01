<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
            $table->string('trademark');
            $table->string('model');
            $table->string('plate');
            $table->string('serial')->unique();
            $table->unsignedSmallInteger('power');
            $table->unsignedSmallInteger('displacement');
            $table->unsignedTinyInteger('cams');
            $table->string('color');
            $table->unsignedTinyInteger('doors');
            $table->unsignedMediumInteger('kilometers');
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
        Schema::dropIfExists('vehicles');
    }
}
