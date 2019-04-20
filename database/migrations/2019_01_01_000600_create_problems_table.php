<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
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

        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->default(0);
            $table->unsignedInteger('owner_id');
            $table->string('title', 128)->default('');
            $table->string('source')->default('');
            $table->unsignedInteger('time_limit')->default(1000)->comment("Time limit in ms");
            $table->unsignedInteger('memory_limit')->default(1024)->comment('memory limit in kb');
            $table->unsignedTinyInteger('is_special_judge')->default(0)->comment("0 = false, 1 = true");
            $table->tinyInteger('type')->default(0)
                ->comment('0: normal 1: supplement after submit code. 2: supplement before judge');
            $table->unsignedBigInteger('similar_from')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0: normal, 1: hide');
            $table->timestamp('testdate_updated_at')->default(0);

            $table->index('source', 'idx_source');
            $table->index('title', 'idx_title');
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
        Schema::dropIfExists('problems');
    }
}
