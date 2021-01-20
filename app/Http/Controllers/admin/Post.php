<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Post extends Controller
{
    function listing(){
		$data['result']=DB::table('posts')->orderBy('id','desc')->get();
		return view('admin.post.listing',$data);
	}
	
	function submit(Request $request){
		$slug=(Str::random(20));
		$request->validate([
			'title'=>'required',
			'short_desc'=>'required',
			'long_desc'=>'required',
			'image'=>'mimes:jpeg,jpg,png',
			'post_date'=>'required'
		]);
		
		//$image=$request->file('image')->store('public/post');
		if ($request->has('image')) {
			
			$image=$request->file('image');
			// dd($image);
			$ext=$image->extension();
			$file=time().'.'.$ext;
			$image->move(public_path('images'),$file);
			//$image->storeAs('/public/post',$file);
			
			
			$data=array(
				'title'=>$request->input('title'),
				'slug'=>$slug,
				'short_desc'=>$request->input('short_desc'),
				'long_desc'=>$request->input('long_desc'),
				'image'=>$file,
				'post_date'=>$request->input('post_date'),
				'status'=>1,
				'added_on'=>date('Y-m-d h:i:s')
			);
			
		} else {
			$data=array(
				'title'=>$request->input('title'),
				'slug'=>$slug,
				'short_desc'=>$request->input('short_desc'),
				'long_desc'=>$request->input('long_desc'),
				'post_date'=>$request->input('post_date'),
				'status'=>1,
				'added_on'=>date('Y-m-d h:i:s')
			);
			
		}
		
		DB::table('posts')->insert($data);
		$request->session()->flash('msg','Post saved');
		return redirect('/admin/post/list');
	}
	
	
    function delete(Request $request,$id){
		$image=(DB::table('posts')->select('image')->where('id',$id)->first());
		DB::table('posts')->where('id',$id)->delete();
		if($image->image!=null){
			//print($image->image);
			//exit;
			unlink(public_path('images/'.$image->image));
		}
		$request->session()->flash('msg','Post delete');
		return redirect('/admin/post/list');
	}
	
	function edit(Request $request,$id){
		$data['result']=DB::table('posts')->where('id',$id)->get();
		return view('admin.post.edit',$data);
	}
	
	function update(Request $request,$id){
		$request->validate([
			'title'=>'required',
			'short_desc'=>'required',
			'long_desc'=>'required',
			'image'=>'mimes:jpeg,jpg,png',
			'post_date'=>'required'
		]);

		if($request->has('image'))
		{
			$Old_image=(DB::table('posts')->select('image')->where('id',$id)->first());
			if($Old_image->image!=null){
				//print($image->image);
				//exit;
				unlink(public_path('images/'.$Old_image->image));
			}
			$image=$request->file('image');
			$ext=$image->extension();
			$file=time().'.'.$ext;
			$image->move(public_path('images'),$file);
	
			$data=array(
				'title'=>$request->input('title'),
				'short_desc'=>$request->input('short_desc'),
				'long_desc'=>$request->input('long_desc'),
				'image'=>$file,
				'post_date'=>$request->input('post_date'),
				'status'=>1,
				'added_on'=>date('Y-m-d h:i:s')
			);
			
		} else {
			$Old_image=(DB::table('posts')->select('image')->where('id',$id)->first());
			if($Old_image->image!=null){
				unlink(public_path('images/'.$Old_image->image));
			}
			$data=array(
				'title'=>$request->input('title'),
				'short_desc'=>$request->input('short_desc'),
				'long_desc'=>$request->input('long_desc'),
				'post_date'=>$request->input('post_date'),
				'image'=>null,
				'status'=>1,
				'added_on'=>date('Y-m-d h:i:s')
			);
			
		}
	
				
		DB::table('posts')->where('id',$id)->update($data);
		$request->session()->flash('msg','Post updated');
		return redirect('/admin/post/list');
	}
	
}
