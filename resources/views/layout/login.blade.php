@extends('master')
@section('body.content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{route('trangchu')}}">Home</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	    <div class="container">
		 <div id="content">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
				           @if(session('thongbao'))
				            <div class="alert alert-success">
				            	{{session('thongbao')}}
				            </div>
				           @endif
                            @if(session('thatbai'))
                                 <div class="alert alert-danger">
                                     {{session('thatbai')}}
                                 </div>
                             @endif
						<form method="post" action="{{route('postdangnhap')}}">
						@csrf
						<h4>Đăng nhập</h4>
						<div class="space20">&nbsp;</div>
						<div class="form-block">
							<label for="email">Email *:</label>
							<input type="email" name="email" id="email" required/>
						</div>
						<div class="form-block">
							<label for="password">Password *:</label>
							<input type="password" name="password" id="password" required/>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Đăng nhập</button>

						</div>
						</form>

					 <div class="form-block">
						 <button class="btn btn-primary" style="margin-right: 10px"><a href="{{route('loginprovider','facebook')}}">Đăng nhập bằng facebook</a></button>
						 <button class="btn btn-danger">Đăng nhập bằng google</button>
					 </div>
					</div>
					<div class="col-sm-3"></div>
				</div>

		</div> <!-- #content -->
		
	</div> <!-- .container -->
	@endsection