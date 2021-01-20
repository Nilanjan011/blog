<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class Admin_auth extends Controller
{
    function login_submit(Request $request){
		$request->validate([
			'email'=>['required','email'],
			'password'=>'required | min:6 | max:20',
		]);

		$email=$request->input('email');
		$password=$request->input('password');
		$result=User::where('email',$email)
				->where('password',$password)
				->first();
		// dd($result);

		if(isset($result->id)){
			if($result->status==1){
				$request->session()->put('BLOG_USER_ID',$result->id);
				$request->session()->put('BLOG_USER_NAME',$result->name);
				return redirect('/admin/post/list');
			}else{
				$request->session()->flash('msg','Account deactivated');
				return redirect('admin/login');
			}
		}else{
			$request->session()->flash('msg','Please enter valid login details');
			return redirect('admin/login');
		}
		
		
	}
}
