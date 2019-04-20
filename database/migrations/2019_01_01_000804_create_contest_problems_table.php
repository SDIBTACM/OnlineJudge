<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_problems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('contest_id')->default(0);
            $table->unsignedInteger('problem_id')->default(0);
            $table->string('title', 128)->default('');
            $table->unsignedTinyInteger('problem_order')->default(0)
                ->comment('the serial number of problem');

            $table->index('contest_id', 'idx_contest');
            $table->unique(['contest_id', 'problem_id'], 'uq_contest_problem');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_problems');
    }
}
