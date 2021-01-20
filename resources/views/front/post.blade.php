@extends('front/layout.layout')

@section('page_title',$result[0]->title)

@section('page_name',$result[0]->title)

@section('container')
@if ($result[0]->image!=null )
<img src="{{asset('images/'.$result[0]->image)}}" width="100px"/>
    
@endif
<p>{{$result[0]->long_desc}}</p>
         

@endsection