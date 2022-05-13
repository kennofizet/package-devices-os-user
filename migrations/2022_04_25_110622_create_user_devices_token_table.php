+<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDevicesTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_devices_token', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->longText('secret_id');
            $table->longText('secret_token');
            $table->bigInteger('total_time');
            $table->longText('device');
            $table->longText('country');
            $table->longText('browser');
            $table->tinyInteger('is_mobile');
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
        Schema::dropIfExists('user_devices_token');
    }
}
