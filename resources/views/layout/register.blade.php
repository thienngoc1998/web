@extends('master')
@section('body.content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng kí</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{route('trangchu')}}">Home</a> / <span>Đăng kí</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		
		<div id="content">
			<form  method="post" class="beta-form-checkout">
				@csrf
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<div id="validation-errors"></div>
						<div class="alert alert-success" style ="display:none;"></div>
						<h4>Đăng kí</h4>
						<div class="space20">&nbsp;</div>
						<div class="form-block">
							<label for="your_last_name">Họ tên *</label>
							<input type="text" name="username" required>
						</div>
						<div class="form-block">
							<label for="email">Email *</label>
							<input type="email" name="email" required>
						</div>
						<div class="form-block">
							<label for="phone">Password *</label>
							<input type="password" name="password" required>
						</div>
						<div class="form-block">
							<label for="phone">Corfim password *</label>
							<input type="password" name="corfimpassword" required>
							<input type="hidden" name="provider" required value="0">
							<input type="hidden" name="provider_id" required value="0">
						</div>
						<div class="form-block">
							<button type="submit" class=" gui btn btn-primary">Đăng kí</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.gui').click(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            e.preventDefault();

            var name = $("input[name=username]").val();
            var email = $("input[name=email]").val();
            var password = $("input[name=password]").val();
            var corfimpassword = $("input[name=corfimpassword]").val();
            var provider = $("input[name=provider]").val();
            var provider_id = $("input[name=provider_id]").val();

            $.ajax({
                url:'{{route('postregister')}}',
                type:"POST",
                data:{username:name,email:email, password:password,corfimpassword:corfimpassword,provider:provider,provider_id:provider_id},
                dataType:'json'
            })
                .done(function(resuilt) {
                    alert(resuilt);

                    $('.alert-success').html(resuilt);
                    $('.alert-success').css('display','block');
                    window.location.href="http://localhost:8181/webbanbanh/public/dangnhap";

                })
                .fail(function(xhr) {
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        $('#validation-errors').append('<div class="alert alert-danger"><p>'+value+'</p></div>');
                    });
                })
                .always(function() {
                    console.log("complete");
                });

        });
    });
</script>