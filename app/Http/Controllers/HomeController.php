<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Verified;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAction(Request $req) {
        $auth_user = Auth::user();

        $model = new Message();
        $messages = $model->findExcludeDeactiveUsers();
        $messageMap = array_column($messages, null, 'id');

        $model = new User();
        $users = $model->get()->toArray();
        $userMap = array_column($users, null, 'id');

        return view('home2', [
            'messages'   => $messages,
            'messageMap' => $messageMap,
            'users'      => $userMap,
            'auth_user'  => $auth_user,
        ]);
    }

    // public function store(Request $req) {
    //     $user = json_decode(Auth::user(), true);

    //     $content = $req->content;

    //     DB::table('messages')->insert([
    //         'user_id' => $user['id'],
    //         'name'    => $user['name'],
    //         'content' => $content,
    //     ]);

    //     return redirect('home');
    // }

    // public function delete(Request $req) {
    //     $message_id = $req->id;

    //     DB::table('messages')->where('id', '=', $message_id)->update([
    //         'is_deleted' => true,
    //         'deleted_at' => Carbon::now(),
    //     ]);

    //     return redirect('home');
    // }

    public function getListAction(Request $req) {
        $model = new Message();
        $messages = $model->findExcludeDeactiveUsers();
        $messageMap = array_column($messages, null, 'id');


        // var_dump(json_decode($messages));die;

        return [
            'messages' => $messages,
            'messageMap' => $messageMap,
        ];
    }

    public function store(Request $req) {
        $user_id = $req->get('user_id');
        $user_name = $req->get('user_name');
        $content = $req->get('content');
        $reply_message_id = $req->get('reply_message_id');

        $model = new Message();
        $max_id = $model::max('id');

        $model->insert([
            'id'               => $max_id + 1,
            'user_id'          => $user_id,
            'name'             => $user_name,
            'content'          => $content,
            'reply_message_id' => $reply_message_id,
        ]);

        return [
            'id'               => $max_id + 1,
            'user_id'          => $user_id,
            'user_name'        => $user_name,
            'content'          => $content,
            'reply_message_id' => $reply_message_id,
        ];
    }

    public function destroy(Request $req) {
        $message_id = $req->message_id;
        $content = $req->get('content');

        $model = new Message();
        $model->deleteMessage($message_id);
        // $model->destroy($message_id);

        return [
            'message_id' => $message_id,
            'content'    => $content,
        ];
    }
}
