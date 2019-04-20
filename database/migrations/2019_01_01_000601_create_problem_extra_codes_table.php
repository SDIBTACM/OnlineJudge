<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemExtraCodesTable extends Migration
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

        Schema::create('problem_extra_codes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedTinyInteger('blank_count')->default(0);
            $table->text('extra_code')->default('');
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
        Schema::dropIfExists('problem_extra_codes');
    }
}
