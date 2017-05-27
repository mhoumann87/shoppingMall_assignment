<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('store_id');
            $table->integer('store_number')->unique();
            $table->string('store_name');
            $table->string('store_open_week');
            $table->string('store_open_sat');
            $table->string('store_open_sun');
            $table->string('store_description');
            $table->string('store_logo');
            $table->string('store_phoneno');
            $table->string('store_website');
            $table->string('store_event')->nullable();
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
        //
    }
}
