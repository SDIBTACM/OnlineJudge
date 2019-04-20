<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussTopicsTable extends Migration
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

        Schema::create('discuss_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->default(0);
            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('contest_id')->default(0);
            $table->unsignedInteger('problem_id')->default(0);
            $table->string('title');
            $table->tinyInteger('status')->default(0)
                ->comment("r->l count, 0 = false. 0bit: is locked, 1bit: is topping");
            $table->bigInteger('views')->default(0);
            $table->unsignedInteger('replies')->default(0);
            $table->dateTime('latest_reply_at');

            $table->index('contest_id', 'idx_contest_id');
            $table->index('problem_id', 'idx_problem_id');
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
        Schema::dropIfExists('discuss_topics');
    }
}
