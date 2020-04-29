<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVehiculeImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicule_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vehicule_id')->unsigned()->index()->nullable();
            $table->string('veh_img_path')->nullable();
            $table->string('veh_img_caption')->nullable();
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
        Schema::dropIfExists('vehicule_images');
    }
}
