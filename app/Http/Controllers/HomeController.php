<?php

namespace App\Http\Controllers;

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
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAction(Request $req) {
        $user = json_decode(Auth::user(), true);

        $messages = json_decode(DB::table('messages')->orderby('created_at', 'asc')->select('*')->get(), true);

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
