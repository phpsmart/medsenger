<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class AngularController extends Controller
{
    public function update(Request $request)
    {
		$params = trim(file_get_contents('php://input'));
		$obj = json_decode($params);
		$name =  preg_replace('/[^a-zA-Zа-яА-Я,\.-?!_;()]+/u', ' ', (string)$obj->message);
		$remote_addr = request()->ip();
		
		if ($name) {
			DB::insert('INSERT INTO message (name, remote_addr) VALUES (?, ?)', [$name, $remote_addr]);
		}
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
		
        $outp = "";
		$messages = DB::select("SELECT id, name, remote_addr, to_char( created_at, 'DD.MM.YYYY HH24:MI' ) created_at FROM message ORDER BY id DESC LIMIT 19 OFFSET 0");
		$endStr = '",';
		
        foreach ($messages as $message) {
            $outp .= '{"Id":"'.$message->id.$endStr;
            $outp .= '"Name":"'.$message->name.$endStr;
            $outp .= '"Remote_addr":"'.$message->remote_addr.$endStr;
            $outp .= '"Date":"'.$message->created_at.'"},';
        }

        $outp = substr_replace($outp, '', -1, 1);
        $outp ='{"records":['.$outp.']}';
		
        echo($outp);
    }
}
