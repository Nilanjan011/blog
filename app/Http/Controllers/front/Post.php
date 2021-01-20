<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Post extends Controller
{
    function home(){
		$data['result']=DB::table('posts')->orderBy('id','desc')->get();
		return view('front.home',$data);
	}
	
	function post($slug){
		$data['result']=DB::table('posts')->where('slug',$slug)->get();
		return view('front.post',$data);
	}
	public static function page_menu(){
		$result=DB::table('pages')->where('status','1')->get();
		return $result;
	}
	
	function page($slug){
		$data['result']=DB::table('pages')->where('slug',$slug)->get();
		return view('front.page',$data);
	}
}
