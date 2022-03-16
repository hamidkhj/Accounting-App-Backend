<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTimeTz('log_date');
            $table->string('gateway')->nullable();
            $table->string('line')->nullable();
            $table->string('address')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('bytes_in')->nullable();
            $table->integer('bytes_out')->nullable();
            $table->string('connect_speed')->nullable();
            $table->string('disc_cause')->nullable();
            $table->integer('disc_cause_ext')->nullable();
            $table->integer('connection_flag')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('connection_logs');
    }
}
