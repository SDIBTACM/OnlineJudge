<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginLogsTable extends Migration
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
           $table->timestamp('created_at', 3)->default(DB::raw('CURRENT_TIMESTAMP(3)'));
           $table->timestamp('updated_at', 3)->default(DB::raw('CURRENT_TIMESTAMP(3) ON UPDATE CURRENT_TIMESTAMP(3)'));
           $table->unsignedInteger('user_id');
           $table->string('ip', 40)->default('');

           $table->index('user_id', 'idx_user');
           $table->index('created_at' , 'idx_login_time');
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
