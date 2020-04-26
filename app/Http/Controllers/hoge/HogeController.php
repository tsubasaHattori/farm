<?php

namespace App\Http\Controllers\hoge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// use Request;

class HogeController extends Controller
{
    public function getAction(Request $req) {
        $results = DB::table('saif')->select('*')->get();
        return view('hoge')->with('results', json_decode($results, true));
    }

    public function add(Request $req) {
        $status = $req->status;
        $value = $req->value;
        $text = $req->text;

        DB::table('saif')->insert([
            'status'     => $status,
            'saif_text'  => $text,
            'saif_money' => $value,
        ]);

        return $this->getAction($req);
    }

    public function delete(Request $req) {
        $id = $req->id;

        DB::table('saif')->where('id', '=', $id)->delete();

        return $this->getAction($req);
    }
}
