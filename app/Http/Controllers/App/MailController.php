<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-19 12:38
 */

namespace App\Http\Controllers\App;


use App\Http\Controllers\Controller;
use App\Models\Mail;
use App\Models\MailContext;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException as ValidationExceptionAlias;
use Mews\Purifier\Facades\Purifier;
use \Parsedown;

/**
 * Class MailController use for site-in mail server, only support simple context.
 * @package App\Http\Controllers\App
 *
 */
class MailController extends Controller
{
    /**
     * list all mail sent to the user and sent from the user
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function list(Request $request) {
        $sentMail = Mail::where('from_user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(20);
        $receivedMail = Mail::where('to_user_id', Auth::id())->orderBy('created_at', 'desc')->orderBy('status', 'desc')->paginate(20);

        return view('app.mail.list', [
            'title' => __('site mail'),
            'sent' => $sentMail,
            'received' => $receivedMail,
        ]);
    }

    /**
     * get the user mail count, include unread, read, sent;
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function count(Request $request) {
        $unread = Mail::where('to_user_id', Auth::id())->where('status', 0)->count();
        $read = Mail::where('to_user_id', Auth::id())->where('status', 1)->count();
        $sent = Mail::where('from_user_id', Auth::id())->count();
        return response()->json([
            'unread' => $unread,
            'read' => $read,
            'sent' => $sent,
        ]);
    }

    /**
     * show the new mail form
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function add(Request $request) {
        return view('app.mail.new');
    }

    /**
     * add a new mail record to the mail.
     * @param Request $request
     *
     * @throws ValidationExceptionAlias
     */

    public function send(Request $request) {
        $this->validateRequest($request);


        $mailContext = new MailContext(['context' => $request->input('content')]);

        $mail = new Mail;
        $mail->from_user_id = Auth::id();
        $mail->to_user_id = User::where('username', $request->input('to_user'))->pluck('id');
        $mail->topic = $request->input('topic');

        $mail->save();
        $mail->context->save($mailContext);
    }

    /**
     * Validate the user request.
     *
     * @param Request $request
     * @return void
     *
     * @throws ValidationExceptionAlias
     */
    protected function validateRequest(Request $request)
    {
        $request->validate([
            'topic' => 'required|max:250',
            'to_user' => [
                'require',
                Rule::exists('user', 'username'),
            ],
            'content' => 'require',
        ]);
    }


    /**
     * show detail mail
     * @param Request $request
     * @param integer $mailId
     * @return Illuminate\Http\Response
     */
    public function detail(Request $request, $mailId) {
        $mail = Mail::with(['fromUser', 'toUser', 'context'])->findOrFail($mailId);
        if (Auth::id() != $mail->from_user_id && Auth::id() != $mail->to_user_id) {
            return abort(403);
        }

        return view('app.mail.detail', [
            'title' => 'Mail from: ' . $mail->fromUser->username . ' to: ' . $mail->toUser->username . ' at:' . $mail->created_at->toRfc7231String() ,
            'mail' => $mail
        ]);
    }
}