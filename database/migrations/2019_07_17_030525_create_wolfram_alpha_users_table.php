<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWolframAlphaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wolfram_alpha_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unique();
            $table->string('status', 255)->nullable();
            $table->string('token', 255)->nullable();
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
        Schema::dropIfExists('wolfram_alpha_users');
    }
}
