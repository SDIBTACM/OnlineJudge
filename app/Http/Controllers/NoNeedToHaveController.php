<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-02 18:30
 *
 * This controller is some action that no need to have(莫须有)
 */

namespace App\Http\Controllers;

use App\Log;

class NoNeedToHaveController extends Controller
{
    /**
     * return 418 'HTTP/1.1 I'm a teapot'
     */
    public function teapot()
    {
        Log::info('Some one found the teapot');
        abort('418');
    }

}
