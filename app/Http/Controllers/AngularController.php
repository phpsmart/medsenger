<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DB;

class AngularController extends Controller
{
    public function update(Request $request, JsonResponse $response)
    {		
		//$params = trim(file_get_contents('php://input'));
		//$obj = json_decode($params);
		
		$params = $request->input();
		$name = (string)$params['message'];
		//$name =  preg_replace('/[^a-zA-Zа-яА-Я,\.-?!_;()]+/u', ' ', $name);
		$remote_addr = $request->ip();
		
		if ($name) {
			$result = DB::insert('INSERT INTO message (name, remote_addr) VALUES (?, ?)', [$name, $remote_addr]);
		}
		
		return	$response
			->setEncodingOptions(JSON_UNESCAPED_UNICODE)
			->setData([
						'success' => $result,
				])
			->header("Access-Control-Allow-Origin", "*")
		;
    }

    public function index(JsonResponse $response)
    {
		$records = DB::select("SELECT id, name, remote_addr, to_char( created_at, 'DD.MM.YYYY HH24:MI' ) created_at FROM message ORDER BY id DESC LIMIT 19 OFFSET 0");
		
		return $response
			->setEncodingOptions(JSON_UNESCAPED_UNICODE)
			->setData([
						'records' => $records,
						'_debug' => gettype($records),
				])
			->header("Access-Control-Allow-Origin", "*")	
		;	
    }
}
