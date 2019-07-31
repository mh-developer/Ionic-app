<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('brand');
            $table->double('price');
            $table->binary('img')->nullable();
            $table->longText('description')->nullable();
            $table->string('tag')->nullable();
            $table->dateTime('create_at');
            $table->dateTime('end_at');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
