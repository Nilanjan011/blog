@extends('front/layout.layout')

@section('page_title','contact Page')

@section('page_name','Contact Us')

@section('container')
<form action="{{ url('contact')}}" method="post">
    @if ($message = Session::get('message'))
      <div class="alert alert-danger alert-block">
          <button class="close" data-dismiss="alert">X</button>
          <strong>{{$message}}</strong>
      </div>
    @endif
    @csrf
    <div class="form-group">
      <label for="Name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
      <span class="text-danger">{{$errors->first('name')}}</span>
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
      <span class="text-danger">{{$errors->first('email')}}</span>
    </div>
    
    <div class="form-group">
        <label for="phone">Phone No.</label>
        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="mobile" required>
        <span class="text-danger">{{$errors->first('mobile')}}</span>
      </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1" class='bold'>Message</label>
      <textarea class="form-control" id="msg" name="msg" rows="3" placeholder="Messager..."  required></textarea>
      <span class="text-danger">{{$errors->first('email')}}</span>
      <input type="submit" value="Submit" class="btn btn-primary">
    </div>
  </form>

@endsection