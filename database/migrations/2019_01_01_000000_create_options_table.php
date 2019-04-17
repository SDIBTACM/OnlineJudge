<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
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

        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(0);

            $table->string('key', 64)->unique();
            $table->text('value')->comment("data in json");
            $table->text('comment');

        });

        DB::table('options')->insert(
            array(

                [
                    "key" => "system_status",
                    "value" => "[0]",
                    "comment" => "0: normal, 1: in vip contest"
                ],

                [
                    "key" => "deny_login_ips",
                    "value" => "{}",
                    "comment" => "the ip list that do not allow login"
                ],

                [
                    "key" => "allow_login_ips",
                    "value" => "{}",
                    "comment" => "the ip list that which can login; if not empty, it will be checked first"
                ],

                [
                    "key" => "deny_visit_ips",
                    "value" => "{}",
                    "comment" => "the ip list that do not allow view any page. You may deny yourself, be careful!"
                ],

                [
                    "key" => "allow_visit_ips",
                    "value" => "{}",
                    "comment" => "the ip list that can view page; if not empty, " .
                        "it will be checked first; You may deny yourself, be careful!"
                ],
            )
        );

        DB::update('set @@sql_mode = ?' , ["$SQL_MODE"] );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options_tables');
    }
}
