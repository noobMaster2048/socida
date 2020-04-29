<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom')->nullable();
            $table->boolean('disponible')->nullable();
            $table->unsignedInteger('marque_id')->nullable()->index();
            $table->unsignedInteger('categorie_id')->nullable()->index();
            $table->integer('prix')->nullable();
            $table->string('description')->nullable();
            $table->string('lien_visuel_ext')->nullable();
            $table->string('lien_visuel_int')->nullable();
            $table->string('consommation')->nullable();
            $table->string('img_path')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->integer('hauteur')->nullable();
            $table->integer('longueur')->nullable();
            $table->integer('largeur')->nullable();
            $table->integer('nb_places')->nullable();
            $table->integer('cap_coffre')->nullable();
            $table->integer('ray_braq')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicules');
    }
}
