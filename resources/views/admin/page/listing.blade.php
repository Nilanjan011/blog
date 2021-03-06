@extends('admin/layout.layout')

@section('page_title','Page Listing')

@section('container')

<div class="">
	  <div class="page-title">
		 <div class="title_left">
			<h4>Page</h4>
			<h2><a href="{{url('/admin/page/add')}}">Add Page</a></h2>
		 </div>
	  </div>

	  <div class="clearfix"></div>
	  <div class="row">
		 <div class="col-md-12 col-sm-12 ">
			<div class="x_panel">
			   <div class="x_content">
				  <div class="row">
				  
					 <div class="col-sm-12 flash_msg">{{session('msg')}}</div>
					 <div class="col-sm-12">
						<div class="card-box table-responsive">
						   <table id="datatable" class="table table-striped table-bordered" style="width:100%">
							  <thead>
								 <tr>
									<th width="2%">NO.</th>
									<th width="4%">Name</th>
									<th width="45%">Description</th>
									<th width="18%">Action</th>
								 </tr>
							  </thead>
							  <tbody>
								  @php
									$i=1;
								  @endphp
								 @foreach($result as $list)
								 <tr>
									<td>{{$i++}}</td>
									<td>{{$list->name}}</td>
									<td>{{$list->description}}</td>
									<td>
										<a class="btn btn-info color_white"  href="{{url('admin/page/edit/'.$list->id)}}">Edit</a>
										<a class="btn btn-danger color_white" onclick="return confirm('are you sure?');" href="{{url('admin/page/delete/'.$list->id)}}">Delete</a>
									</td>
								 </tr>
								 @endforeach
							  </tbody>
						   </table>
						</div>
					 </div>
				  </div>
			   </div>
			</div>
		 </div>
	  </div>
   </div>
@endsection