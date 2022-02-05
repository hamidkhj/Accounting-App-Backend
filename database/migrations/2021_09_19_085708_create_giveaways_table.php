<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiveawaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('giveaways', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('package_id')->nullable();
        //     $table->bigInteger('user_id')->nullable();
        //     $table->bigInteger('group_id')->nullable();
        //     $table->date('activate_on')->nullable();
        //     $table->integer('interval')->nullable(); //days
        //     $table->bigInteger('creator_id');
        //     $table->string('description');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giveaways');
    }
}
