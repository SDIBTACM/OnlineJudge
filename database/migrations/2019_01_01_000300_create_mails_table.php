<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
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

        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->default(0);
            $table->unsignedInteger('from_user_id')->default(0);
            $table->unsignedInteger('to_user_id')->default(0);
            $table->string('topic', 255)->default('');
            $table->tinyInteger('status')->default(0)
                ->comment('0: new mail, 1: has read');

            $table->index('from_user_id', 'idx_from_user_id');
            $table->index('to_user_id', 'idx_to_user_id');
            $table->index('created_at', 'idx_time');
            $table->index('status', 'idx_status');

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
        Schema::dropIfExists('mails');
    }
}
