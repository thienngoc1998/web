@extends('master')
@section('body.content')
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>New Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy :{{count($product)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
							@foreach($product->all() as $pr)
								<div class="col-sm-3 " style="margin-top: 20px;">
									<div class="single-item">
										@if($pr->promotion_price>0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										 @endif
										<div class="single-item-header">
											<a href="{{URL::route('xemchitiet', $pr->id)}}"  ><img src="{{asset('source/image/product/'.$pr->image)}}" alt="" width="320" height="270" ></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$pr->name}}</p>
											<p class="single-item-price">
												@if($pr->promotion_price>0)
												<span class="flash-del">{{$pr->unit_price}}</span>
												<span class="flash-sale">{{$pr->promotion_price}}</span>
												@else
												  <span>{{$pr->unit_price}}</span>
												 @endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{Route('themgiohang',$pr->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{URL::route('xemchitiet', $pr->id)}}">Chi tiết sản phẩm <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								@endforeach
							</div>
							
						</div> <!-- .beta-products-list -->

				

					</div>
				</div> <!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection