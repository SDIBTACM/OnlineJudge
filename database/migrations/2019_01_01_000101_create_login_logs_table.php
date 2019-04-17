<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_logs', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->integer('user_id');
           $table->timestamp('login_at', 3)->default(DB::raw('CURRENT_TIMESTAMP'));
           $table->string('ip', 40);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropAllTables("login_logs");
    }
}
