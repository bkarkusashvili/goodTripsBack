<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ka');
            $table->string('title_en');
            $table->string('address_ka');
            $table->string('address_en');
            $table->text('description_ka');
            $table->text('description_en');
            $table->string('author_ka')->nullable();
            $table->string('author_en')->nullable();
            $table->text('services')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->text('location')->nullable();
            $table->text('gallery')->nullable();
            $table->integer('image_id');
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
        Schema::dropIfExists('hotels');
    }
}
