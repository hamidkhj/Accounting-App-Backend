<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTimeTz('log_date');
            $table->string('nas')->nullable();
            $table->string('port')->nullable();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->text('detail')->nullable();
            $table->text('fa_why')->nullable();
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
        Schema::dropIfExists('calls_logs');
    }
}
