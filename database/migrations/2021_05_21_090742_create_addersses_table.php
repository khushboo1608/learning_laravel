<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdderssesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addersses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('a_type');
            $table->string('a_name');
            $table->string('a_number');
            $table->string('a_houser_no');
            $table->string('a_lendmark');
            $table->string('a_adderss');
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addersses');
    }
}
