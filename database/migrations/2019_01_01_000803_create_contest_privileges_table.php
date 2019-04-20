<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_privileges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('contest_id')->default(0);
            $table->unsignedInteger('user_id')->default(0);
            $table->tinyInteger('type')->default(0)->comment('0: allow take part in, 1: allow manage');

            $table->index('user_id', 'idx_user');
            $table->index('contest_id', 'idx_contest');
            $table->unique(['contest_id', 'user_id', 'type'], 'uq_contest_user_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_privileges');
    }
}
