<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestResultsTable extends Migration
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

        Schema::create('contest_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('contest_problem_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('contest_id')->default(0);
            $table->integer('submit_count')->default('0')->comment('value mean submit times');
            $table->dateTime('ac_at')->default(0);

            $table->index('contest_problem_id', 'idx_contest_problem');
            $table->index('user_id', 'idx_user');
            $table->index('contest_id', 'idx_contest');
            $table->unique(['contest_problem_id', 'user_id', 'contest_id'], 'uq_user_contest_contest_problem');
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
        Schema::dropIfExists('contest_results');
    }
}
