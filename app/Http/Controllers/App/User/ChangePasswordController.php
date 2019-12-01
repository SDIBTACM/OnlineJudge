<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-18 16:36
 */

namespace App\Http\Controllers\App\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * show the change from to the user.
     * @param Request $request
     */
    public function showFrom(Request $request) {
//        return response()->json([CONTROLLER_START]);
    }

    /**
     * check and update password from user
     * @param Request $request
     */
    public function update(Request $request) {

    }
}