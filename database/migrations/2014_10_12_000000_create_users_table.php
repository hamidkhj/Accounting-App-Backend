<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('group_id')->default(1);
            $table->smallInteger('title_id')->default(1);
            $table->smallInteger('role_id')->default(1);
            $table->smallInteger('marital_status_id')->default(1);
            $table->string('user_name')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->date('birthday');
            $table->string('address');
            $table->integer('phone');
            $table->integer('personal_code');
            $table->string('gender');
            $table->integer('meli_code');
            $table->integer('static_ip')->nullable();
            $table->string('email')->unique();
            $table->string('org_email')->unique()->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('password');
            $table->string('major');
            $table->integer('passport')->unique()->nullabe();
            $table->integer('mobile1')->nullable();
            $table->integer('mobile2')->nullable();
            $table->string('comment')->nullable();
            $table->string('picture')->nullable();
            $table->string('city')->nullable();
            $table->date('exp_date');
            $table->integer('hour_limit');
            $table->integer('connection_number')->default(1);
            $table->integer('mac_address')->nullable();
            $table->integer('bandwidth_limit')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
