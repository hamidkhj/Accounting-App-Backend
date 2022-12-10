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
            // $table->smallInteger('role_id')->default(1);
            $table->smallInteger('marital_status_id')->default(1);
            $table->string('user_name')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->date('birthday');
            $table->string('address');
            $table->string('phone');
            $table->integer('personal_code')->nullable();
            $table->string('gender');
            $table->string('meli_code');
            $table->string('email');
            $table->string('org_email')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('password');
            $table->string('major')->nullable();
            $table->string('passport')->nullable();
            $table->string('mobile1')->nullable();
            $table->string('mobile2')->nullable();
            $table->string('comment')->nullable();
            $table->string('picture')->nullable();
            $table->string('city')->nullable();
            $table->date('exp_date');
            $table->date('ip_exp_date')->nullable();
            $table->string('static_ip')->nullable();
            $table->integer('hour_limit')->nullable();
            $table->integer('connection_number')->default(1);
            $table->string('mac_address')->nullable();
            $table->integer('bandwidth_limit')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('pap')->nullable();
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
