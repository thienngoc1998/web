<div id="header">
	<div class="header-top">
		<div class="container">
			<div class="pull-left auto-width-left">
				<ul class="top-menu menu-beta l-inline">
					<li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
					<li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
				</ul>
			</div>
			<div class="pull-right auto-width-right">
				<ul class="top-details menu-beta l-inline">
					@if(Auth::check())
					<li ><a href="#"><i class="fa fa-user"></i>{{Auth::user()->username}}</a>
					</li>
					 <li><a href="{{Route('postlogout')}}">Đăng xuất</a></li>
					@else
					<li><a href="{{route('register')}}">Đăng kí</a></li>
					<li><a href="{{route('login')}}">Đăng nhập</a></li>
					@endif
				</ul>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-top -->
	<div class="header-body">
		<div class="container beta-relative">
			<div class="pull-left">
				<a href="index.html" id="logo"><img src="source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
			</div>
			<div class="pull-right beta-components space-left ov">
				<div class="space10">&nbsp;</div>
				<div class="beta-comp">
					<form role="search" method="get" id="searchform" action="{{route('postserch')}}">
				        <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
				        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
					</form>
				</div>

				<div class="beta-comp">
					@if(Session::has('cart'))
					<div class="cart">
						<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (@if(Session('cart')){{Session('cart')->totalQty}}@else Trống @endif ) <i class="fa fa-chevron-down"></i></div>
						<div class="beta-dropdown cart-body">
							@foreach($productcart as $pc)
							<div class="cart-item" id="{{$pc['item']['id']}}">
								<div class="media">
									<a class="pull-left" href="#"><img src="{{asset('source/image/product/'.$pc['item']['image'])}}" alt=""></a>
									<button class="btn btn-primary pull-right" onclick="XoaItemgiohang({{$pc['item']['id']}})">Xóa</button>
									{{--<a href="{{Route('xoagiohang',$pc['item']['id'])}}" class="btn btn-primary pull-right">Xóa</a>--}}
									<div class="media-body">
										<span class="cart-item-title">{{$pc['item']['name']}}</span>
										<span class="cart-item-options">Size: XS; Colar: Navy</span>
										<span class="cart-item-amount">{{$pc['qty']}}*<span>
                                        @if($pc['item']['promotion_price']==0)
										${{$pc['item']['unit_price']}}
										@else
                                        ${{$pc['item']['promotion_price']}}
                                        @endif
									</span></span>
									</div>
								</div>
							</div>
                            @endforeach 
							<div class="cart-caption">
								<div class="cart-total text-center">Tổng tiền: <span class="cart-total-value">
								@if(Session('cart')){{Session('cart')->totalPrice}} @endif
								        </span>
								<div class="clearfix"></div>

								<div class="center">
									<div class="space10">&nbsp;</div>
									<a href="{{Route('dathang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
					</div> <!-- .cart -->
					 @else
					 <div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng  (Trống) <i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">

								<div class="cart-caption">
									<div class="cart-total text-right">Subtotal: <span class="cart-total-value"></span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="#" class="beta-btn primary text-center">Checkout <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div> 
						@endif

				</div>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-body -->
	<div class="header-bottom" style="background-color: #0277b8;">
		<div class="container">
			<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
			<div class="visible-xs clearfix"></div>
			<nav class="main-menu">
				<ul class="l-inline ov">
					<li><a href="{{Route('trangchu')}}">Trang chủ</a></li>
					<li><a href="#">Sản phẩm</a>
						<ul class="sub-menu">
							@foreach($loaisp->all() as $lsp)
							<li><a href="{{Route('laysanpham',$lsp->id)}}">{{$lsp->name}}</a></li>
							@endforeach
						</ul>
					</li>
					<li><a href="{{Route('about')}}">Giới thiệu</a></li>
					<li><a href="contacts.html">Liên hệ</a></li>
				</ul>
				<div class="clearfix"></div>
			</nav>
		</div> <!-- .container -->
	</div> <!-- .header-bottom -->
</div> <!-- #header -->
</div>>