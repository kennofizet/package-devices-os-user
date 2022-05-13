+<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCdbDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cdb_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->longText('address');
            $table->integer('id_country');
            $table->integer('id_device');
            $table->integer('id_browser');
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
        Schema::dropIfExists('user_cdb_detail');
    }
}
