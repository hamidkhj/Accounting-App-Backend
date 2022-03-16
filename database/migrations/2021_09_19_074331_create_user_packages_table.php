<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id');
            $table->bigInteger('user_id');
            $table->dateTimeTz('purchase_date');
            $table->dateTimeTz('expiration_date');
            $table->integer('remaining_megabyte');
            $table->integer('priority');
            $table->integer('price');
            $table->integer('duration');
            $table->integer('size');
            $table->integer('receipt_number');
            $table->string('payment_type');
            $table->string('name');
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
        Schema::dropIfExists('user_packages');
    }
}
