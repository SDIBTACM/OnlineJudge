<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-03 15:42
 *
 * The Service is use to record how many database opt in a request
 */

namespace App\Providers;


use App\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class DatabaseServiceProvider extends ServiceProvider
{

    /**
     * 启动应用服务
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            if (strstr($query->sql, 'telescope_') == false) {
                Log::debug('', $query);
                $GLOBALS['QUERY_COUNT']++;
            }
        });
    }

    /**
     * 注册服务提供器
     *
     * @return void
     */
    public function register()
    {
        //
    }
}