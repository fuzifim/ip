<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IpAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip',255)->nullable();
            $table->string('base_64',255)->index();
            $table->string('as',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('countryCode',255)->nullable();
            $table->string('isp',255)->nullable();
            $table->string('lat',255)->nullable();
            $table->string('lon',255)->nullable();
            $table->string('org',255)->nullable();
            $table->string('region',255)->nullable();
            $table->string('regionName',255)->nullable();
            $table->string('timezone',255)->nullable();
            $table->string('zip',255)->nullable();
            $table->string('browser',255)->nullable();
            $table->string('operating_system',255)->nullable();
            $table->enum('by', ['tracemyip','ip_api']);
            $table->enum('status', ['active','disable','delete']);
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
