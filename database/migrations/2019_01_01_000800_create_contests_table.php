<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestsTable extends Migration
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

        Schema::create('contests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->default(0);
            $table->unsignedInteger('owner_id');
            $table->string('name')->default('');
            $table->dateTime('start_at');
            $table->dateTime('end_before');
            $table->unsignedTinyInteger('privilege')->default(0)
                ->comment('0: public 1: private 2: protect 3: need register');
            $table->string('privilege_info', 384);
            $table->bigInteger('allow_language')->default(0)
                ->comment('0 is all allow, if a bit set 1, that mean the kind of lang not allow');
            $table->tinyInteger('lock_rank_at')->default(0)
                ->comment('0 for no, 20 for at last 20% time');

            $table->index('start_at', 'idx_start');

            $table->index('privilege', 'idx_privilege');

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
        Schema::dropIfExists('contests');
    }
}
