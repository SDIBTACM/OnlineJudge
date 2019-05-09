<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $SQL_MODE = DB::select("select @@sql_mode sql_mode")[0]->sql_mode;
        DB::statement("set @@sql_mode = ''");

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->default(0);
            $table->string('username', 64);
            $table->string('nickname', 64);
            $table->string('password');
            $table->string('school', 32)->default('');
            $table->string('email');
            $table->string('role', 64)->default('student')->comment('student, teacher, admin');
            $table->timestamp('email_verified_at')->default(0);
            $table->tinyInteger('status')->default(0)
                ->comment("-1: lock, 0: normal, 1: need verify by admin");
            $table->string('remember_token', 100)->default('');

            $table->unique(['email', 'deleted_at'], 'uq_email');
            $table->unique(['username', 'deleted_at'],'uq_username');
        });

        DB::update('set @@sql_mode = ?' , ["$SQL_MODE"] );
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
