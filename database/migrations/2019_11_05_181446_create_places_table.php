<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ka');
            $table->string('title_en');
            $table->string('address_ka');
            $table->string('address_en');
            $table->text('description_ka');
            $table->text('description_en');
            $table->json('location')->nullable();
            $table->json('gallery')->nullable();
            $table->integer('image_id');
            $table->boolean('trending')->default(false);
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
        Schema::dropIfExists('places');
    }
}
