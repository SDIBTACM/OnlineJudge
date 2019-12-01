<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-18 16:35
 */

namespace App\Http\Controllers\App\User;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    /**
     * The action is use for show a user info
     * @param Request $request
     * @param $userId
     * @return Illuminate\Http\Response|Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $userId = null) {

        if ($userId == null && Auth::guest()) {
            return abort(404);
        } else {
            $userId = Auth::id();
        }

        $user = User::findOrFail($userId);
        dd($user);
//        return view();
    }
}