 @extends('master')
 @section('body.content')
    <div class="rev-slider">
	<div class="fullwidthbanner-container">
					<div class="fullwidthbanner">
						<div class="bannercontainer" >
					    <div class="banner" >
								<ul>
									<!-- THE FIRST SLIDE -->
									@foreach($slide->all() as $sl)
									<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
													<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="{{asset('source/image/slide/'.$sl->image)}}" data-src="{{asset('source/image/slide/'.$sl->image)}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('{{asset('source/image/slide/'.$sl->image)}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
													</div>
									</div>
						            </li>
						              @endforeach
								
								</ul>
							</div>
						</div>

						<div class="tp-bannertimer"></div>
					</div>
    </div>
				<!--slider-->
	</div>
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
											<button type="button" class="btn btn-primary btn-sm" data-id="{{$pr->id}}" onclick="dathang({{$pr->id}})">
									          <span class="glyphicon glyphicon-shopping-cart"></span> Đặt
									        </button>
											<a class="beta-btn primary" href="{{URL::route('xemchitiet', $pr->id)}}">Chi tiết sản phẩm <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="row t1">
								{{$product->links()}}
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản phẩm cũ</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy :{{count($lastproduct)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($lastproduct->all() as $lp)
								<div class="col-sm-3 " style="margin-top: 20px;">
									<div class="single-item">
										@if($lp->promotion_price>0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Giảm giá</div></div>
										 @endif
										<div class="single-item-header">
											<a href="{{URL::route('xemchitiet', $lp->id)}}"  ><img src="{{asset('source/image/product/'.$lp->image)}}" alt="" width="320" height="270" ></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$lp->name}}</p>
											<p class="single-item-price">
												@if($lp->promotion_price>0)
												<span class="flash-del">{{$lp->unit_price}}</span>
												<span class="flash-sale">{{$lp->promotion_price}}</span>
												@else
												  <span>{{$lp->unit_price}}</span>
												 @endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{Route('themgiohang',$lp->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{URL::route('xemchitiet', $lp->id)}}">Chi tiết sản phẩm  <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>

									</div>
								</div>
								@endforeach
							</div> 
							<div class="row">
								{{$lastproduct->links()}}
							</div>
								</div>
							</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
