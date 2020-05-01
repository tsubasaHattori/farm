<?php

namespace App\Http\Controllers;

use App\Message;
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
        $user = Auth::user();

        $model = new Message();
        $messages = $model->findExcludeDeactiveUsers();

        return view('home2', [
            'user'     => $user,
            'messages' => $messages,
        ]);
    }

    public function store(Request $req) {
        $user = json_decode(Auth::user(), true);

        $content = $req->content;

        DB::table('messages')->insert([
            'user_id' => $user['id'],
            'name'    => $user['name'],
            'content' => $content,
        ]);

        return redirect('home');
    }

    public function delete(Request $req) {
        $message_id = $req->id;

        DB::table('messages')->where('id', '=', $message_id)->update([
            'is_deleted' => true,
            'deleted_at' => Carbon::now(),
        ]);

        return redirect('home');
    }
}
