<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestRegistersTable extends Migration
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

        Schema::create('contest_registers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->default(0);
            $table->integer('contest_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('actual_name', 64)->default('');
            $table->string('college', 64)->default('');
            $table->string('discipline', 64)->default('')
                ->comment('it means: a branch of knowledge, typically one studied in higher education.');
            $table->unsignedTinyInteger('sex')->default(0)->comment('0: secret, 1: male, 2: female');
            $table->tinyInteger('status')->default(-1)
                ->comment('-1: pending 0: accept 1: wait for update info 2: reject');

            $table->index('contest_id', 'idx_contest');
            $table->unique(['user_id', 'contest_id', 'deleted_at'], 'uq_user_contest_deleted');
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
        Schema::dropIfExists('contest_registers');
    }
}
