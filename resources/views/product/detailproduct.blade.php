@extends('master')
@section('body.content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Product</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Product</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						
						<div class="col-sm-4">
							<img src="{{asset('source/image/product/'.$detail->image)}}" alt="" width="320" height="270">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{$detail->name}}</p>
								<p class="single-item-price">
									<span>Giá :{{$detail->unit_price}}</span>
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$detail->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								<select class="wc-select" name="size">
									<option>Size</option>
									<option value="XS">XS</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
								</select>
								<select class="wc-select" name="color">
									<option>Color</option>
									<option value="Red">Red</option>
									<option value="Green">Green</option>
									<option value="Yellow">Yellow</option>
									<option value="Black">Black</option>
									<option value="White">White</option>
								</select>
								<select class="wc-select" name="color">
									<option>Qty</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="{{Route('themgiohang',$detail->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
						
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Description</a></li>
							<li><a href="#tab-reviews">Reviews (1)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							
							<p></p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>Sản phẩm này ăn rất ngon</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm liên quan:</h4>

						<div class="row">
							@foreach($relateproduct->all() as$rp)
							<div class="col-sm-4">
								<div class="single-item">
									<div class="single-item-header">
										<a href="{{Route('xemchitiet',$rp->id)}}"><img src="{{asset('source/image/product/'.$rp->image)}}" alt="" width="320" height="270"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$rp->name}}</p>
										<p class="single-item-price">
											@if($rp->promotion_price==0)
											<span>{{$rp->unit_price}}</span>
											@else
											<span class="flash-del">{{$rp->unit_price}}</span>
											<span class="flash-sale">{{$rp->promotion_price}}</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{Route('themgiohang',$rp->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{URL::route('xemchitiet', $rp->id)}}l">Chi tiết sản phẩm<i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
								<div class="row">
								{{$relateproduct->links()}}
							     </div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Giảm giá mạnh :</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/1.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/2.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/3.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới :</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($newproduct as $np)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{Route('xemchitiet',$np->id)}}"><img src="{{asset('source/image/product/'.$np->image)}}" alt=""></a>
									<div class="media-body">
										{{$np->name}}
										@if($np->promotion_price>0)
												<span class="flash-del">${{$np->unit_price}}</span>
												<span class="flash-sale">${{$np->promotion_price}}</span>
												@else
												  <span class="beta-sales-price">${{$np->unit_price}}</span>
										 @endif
										<!-- <span class="beta-sales-price">$34.55</span> -->
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection