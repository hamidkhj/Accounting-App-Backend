<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParsianRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsian_records', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->integer('user_id');
            $table->string('sale_order_id')->unique();
            $table->string('price');
            $table->string('token')->nullable();
            $table->string('status')->nullable();
            $table->text('message')->nullable();
            $table->string('RNN')->nullable();
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
        Schema::dropIfExists('parsian_records');
    }
}
