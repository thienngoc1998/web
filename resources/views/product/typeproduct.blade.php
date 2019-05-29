	@extends('master')
	@section('body.content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm : {{$loai->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{Route('trangchu')}}">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($loaisanpham->all() as $lsp)
							<li><a href="{{Route('laysanpham',$lsp->id)}}">{{$lsp->name}}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Sản phẩm mới </h4>
							<div class="beta-products-details">
								<p class="pull-left">Đã tìm thấy </p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
									@foreach($sanpham->all() as $sp)
							     		<div class="col-sm-4">
										<div class="single-item">
										@if($sp->promotion_price >0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										 @endif
										<div class="single-item-header">
											<a href="product.html"  ><img src="{{asset('source/image/product/'.$sp->image)}}" alt="" width="320" height="270" ></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$sp->name}}</p>
											<p class="single-item-price">
												@if($sp->promotion_price>0)
												<span class="flash-del">{{$sp->unit_price}}</span>
												<span class="flash-sale">{{$sp->promotion_price}}</span>
												@else
												  <span>{{$sp->unit_price}}</span>
												 @endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{URL::route('xemchitiet', $sp->id)}}">Chi tiết sản phẩm <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								   @endforeach
								</div>
								<div class="row">
								{{$sanpham->links()}}
							     </div>
							
						 <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Top Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">438 styles found</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($sanphamcu->all() as $spc)
								<div class="col-sm-4">
										<div class="single-item">
										@if($spc->promotion_price >0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										 @endif
										<div class="single-item-header">
											<a href="product.html"  ><img src="{{asset('source/image/product/'.$spc->image)}}" alt="" width="320" height="270" ></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$spc->name}}</p>
											<p class="single-item-price">
												@if($spc->promotion_price>0)
												<span class="flash-del">{{$spc->unit_price}}</span>
												<span class="flash-sale">{{$spc->promotion_price}}</span>
												@else
												  <span>{{$spc->unit_price}}</span>
												 @endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{URL::route('xemchitiet', $spc->id)}}">Chi tiết sản phẩm <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								@endforeach
							     
							</div>
							<div class="row">
								{{$sanphamcu->links()}}
							     </div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection