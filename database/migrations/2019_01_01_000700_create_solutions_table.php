<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('owner_id')->default(0);
            $table->unsignedInteger('contest_id')->default(0);
            $table->unsignedInteger('problem_id')->default(0);
            $table->unsignedBigInteger('contest_problem_id')->default(0);
            $table->string('hash')->default('');
            $table->unsignedTinyInteger('lang')->default(0);
            $table->tinyInteger('result')->default(-2)
                ->comment('-3:RJ WAIT, -2:WAIT, -1:RUN, 0:AC, 1:WA, 2:PE, 3:TLE, 4:MLE, 5:OLE, 6:RE, 7:SE');
            $table->unsignedInteger('time_used')->default(0)->comment('ms');
            $table->unsignedInteger('memory_used')->default(0)->comment('kb');
            $table->unsignedBigInteger('similar_at')->default(0);
            $table->unsignedTinyInteger('similar_percent')->default(0);

            $table->index('owner_id', 'idx_user');
            $table->index('problem_id', 'idx_problem');
            $table->index('result', 'idx_result');
            $table->index('contest_id', 'idx_contest_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solutions');
    }
}
