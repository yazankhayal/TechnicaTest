<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_send', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('query_type_id')->unsigned()->index();
            $table->integer('call_stats_id')->unsigned()->index();
            $table->integer('campaign_id')->unsigned()->index();
            $table->foreign('query_type_id')->references('id')->on('query_type')->onDelete('cascade');
            $table->foreign('call_stats_id')->references('id')->on('call_stats')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaign')->onDelete('cascade');

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
        Schema::dropIfExists('system_send');
    }
}
