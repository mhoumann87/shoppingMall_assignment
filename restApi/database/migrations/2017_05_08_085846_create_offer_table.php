<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer', function (Blueprint $table) {
            $table->increments('offer_id');
            $table->integer('store_number')->unsigned();
            $table->foreign('store_number')->references('offer_id')->on('store');
            $table->binary('offer_photo');
            $table->string('offer_title');
            $table->string('offer_description');
            $table->string('offer_normalprice');
            $table->string('offer_price');
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
