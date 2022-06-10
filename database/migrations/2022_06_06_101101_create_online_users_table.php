<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('user_package_id');
            $table->string('calling_station_id');
            $table->string('framed_ip_address');
            $table->string('logdate');
            $table->string('log_time');
            $table->string('acct_session_time');
            $table->integer('interim_upload');
            $table->integer('interim_download');
            $table->string('service')->nullable();
            $table->string('nas_ip_address')->nullable();
            $table->string('called_station_id')->nullable();
            $table->string('nas_port')->nullable();
            $table->string('acct_unique_session_id')->nullable();
            $table->string('acct_session_id')->nullable();
            $table->string('radius_ip_address')->nullable();
            $table->boolean('to_be_deleted')->default(0);
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
        Schema::dropIfExists('online_users');
    }
}
