<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionFullResultsTable extends Migration
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

        Schema::create('solution_full_results', function (Blueprint $table) {
            $table->unsignedBigInteger('solution_id')->primary();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->text('data')->default('');
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
        Schema::dropIfExists('solution_full_results');
    }
}
