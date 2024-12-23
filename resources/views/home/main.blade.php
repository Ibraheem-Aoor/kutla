<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1">
	<title>رام الله - موقع رام الله الإخباري</title>
	<link rel="icon" href="{{asset('homeStyle')}}/images/favicon.png" type="image/png">
	<link href="{{asset('homeStyle')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('homeStyle')}}/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('homeStyle')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('homeStyle')}}/css/animate.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{asset('homeStyle')}}/css/owl.carousel.min.css">
	<link rel="stylesheet" href="{{asset('homeStyle')}}/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="{{asset('homeStyle')}}/css/jquery.mCustomScrollbar.css">

	<link href="{{asset('homeStyle')}}/css/style.css?time={{time()}}" rel="stylesheet" type="text/css">
	<link href="{{asset('homeStyle')}}/css/responsive.css?time={{time()}}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
	<style>
		.fancybox-slide>*{
			background-color:unset !important;
		}
		.error-block{
			color:red;
		}
		.hide_details{
			display: none;
		}

	</style>
	<meta property="fb:pages" content="1413400918974999" />
	@stack('meta_tag')
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-40113887-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-40113887-1');
</script>
</head>
@stack('data_erro')

<?php
$current_route=Null;
if(\Request::route()){
    $current_route=\Request::route()->getName();

}
?>
<body style="background: #fefefe !important;" @if($current_route=="home.post_details") class="post_detials_mobile" @endif>
<section class="urgent-news" id="breaking__news" style="display: none">
	<div class="container" id="put_urgent">

	</div>
</section>
<header>
	<div class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-6 hidden-xs hidden-sm">
					<div class="top-header-item">
						<img src="{{$wether->type}}" style="width: 14%;">
						<span class="degree">{{$wether->high}}</span>
						<span style="margin-right: 12%;">{{returnDateFormay(date('Y-m-d'))}}</span>
					</div>
					<div class="top-header-item" style="font-size: 17px">
						<i class="fa fa-clock-o"></i>
						{{returnTimeFormay(date('H:i:s'))}} بتوقيت القدس المحتلة
					</div>
				</div>
				<div class="col-xs-12 col-md-6 text-left searchAndSocial">
					<ul class="social-ul hidden-xs">
						<li><a href="{{$setting->facebook}}"><i class="fa fa-facebook"></i></a></li>
						<li><a href="{{$setting->twitter}}"><i class="fa fa-twitter"></i></a></li>
						<li><a href="{{$setting->android}}"><i class="fa fa-android"></i></a></li>
						<li><a href="{{$setting->instagram}}"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#"><i class="fa fa-rss"></i></a></li>
					</ul>
					<div class="search-toggle"><i class="fa fa-search"></i></div>
					<button type="button" class="visible-xs navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{{asset('/')}}" class="mobile-logo visible-xs"><img src="{{asset('homeStyle')}}/images/logo-mobile.png" /></a>
				</div>
			</div>
		</div>
	</div>
	<form class="search-form" method="get" action="{{asset('home/search')}}">
		<input type="text" name="key" placeholder="ابحث في المحتوى" />
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
	<div class="main-header">
		<div class="container">
			<a href="{{asset('/')}}" class="logo hidden-xs" ><img style="width: 96% !important" src="{{asset('homeStyle')}}/images/logo.png" /></a>
			<div class="header-main-content">
				@if($adv_setting[0]->adv_part_1!=5)
					<div class="header-ads ads">

						@if($adv_setting[0]->adv_part_1==1)
							<div class="row main-ads one-ads" data-layout="1">
								<div class="col-xs-12">
									@if($adv_part_1 && $adv_part_1->iframe1)
										<div>{!! $adv_part_1->iframe1 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv1)
										<a target="_blank" href="{{asset($adv_part_1->url1)}}">
											<img src="{{asset($adv_part_1->image_adv1)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
									@endif
								</div>
							</div>
						@endif
						@if($adv_setting[0]->adv_part_1==2)
							<div class="row main-ads two-ads" data-layout="2">
								<div class="col-xs-12 col-sm-6">
									@if($adv_part_1 && $adv_part_1->iframe1)
										<div>{!! $adv_part_1->iframe1 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv1)
										<a target="_blank" href="{{asset($adv_part_1->url1)}}">
											<img src="{{asset($adv_part_1->image_adv1)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
									@endif
								</div>
								<div class="col-xs-12 col-sm-6">
									@if($adv_part_1 && $adv_part_1->iframe2)
										<div>{!! $adv_part_1->iframe2 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv2)
										<a target="_blank" href="{{asset($adv_part_1->url2)}}">
											<img src="{{asset($adv_part_1->image_adv2)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
									@endif
								</div>
							</div>
						@endif
						@if($adv_setting[0]->adv_part_1==3)
							<div class="row main-ads three-ads"  data-layout="3">
								<div class="col-xs-12 col-sm-4">
									@if($adv_part_1 && $adv_part_1->iframe1)
										<div>{!! $adv_part_1->iframe1 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv1)
										<a target="_blank" href="{{asset($adv_part_1->url1)}}">
											<img src="{{asset($adv_part_1->image_adv1)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
									@endif
								</div>
								<div class="col-xs-12 col-sm-4">
									@if($adv_part_1 && $adv_part_1->iframe2)
										<div>{!! $adv_part_1->iframe2 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv2)
										<a target="_blank" href="{{asset($adv_part_1->url2)}}">
											<img src="{{asset($adv_part_1->image_adv2)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
									@endif
								</div>
								<div class="col-xs-12 col-sm-4">
									@if($adv_part_1 && $adv_part_1->iframe3)
										<div>{!! $adv_part_1->iframe3 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv3)
										<a target="_blank" href="{{asset($adv_part_1->url3)}}">
											<img src="{{asset($adv_part_1->image_adv3)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
									@endif
								</div>
							</div>
						@endif
						@if($adv_setting[0]->adv_part_1==4)
							<div class="row main-ads four-ads"  data-layout="4">
								<div class="col-xs-12 col-sm-3">
									@if($adv_part_1 && $adv_part_1->iframe1)
										<div>{!! $adv_part_1->iframe1 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv1)
										<a target="_blank" href="{{asset($adv_part_1->url1)}}">
											<img src="{{asset($adv_part_1->image_adv1)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
									@endif
								</div>
								<div class="col-xs-12 col-sm-3">
									@if($adv_part_1 && $adv_part_1->iframe2)
										<div>{!! $adv_part_1->iframe2 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv2)
										<a target="_blank" href="{{asset($adv_part_1->url2)}}">
											<img src="{{asset($adv_part_1->image_adv2)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
									@endif
								</div>
								<div class="col-xs-12 col-sm-3">
									@if($adv_part_1 && $adv_part_1->iframe3)
										<div>{!! $adv_part_1->iframe3 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv3)
										<a target="_blank" href="{{asset($adv_part_1->url3)}}">
											<img src="{{asset($adv_part_1->image_adv3)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
									@endif
								</div>
								<div class="col-xs-12 col-sm-3">
									@if($adv_part_1 && $adv_part_1->iframe4)
										<div>{!! $adv_part_1->iframe4 !!}</div>
									@elseif($adv_part_1 && $adv_part_1->image_adv4)
										<a target="_blank" href="{{asset($adv_part_1->url4)}}">
											<img src="{{asset($adv_part_1->image_adv4)}}" /></a>
									@else
										<a href="#">
											<img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
									@endif
								</div>
							</div>
						@endif


					</div>
				@endif
				<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="social-ul visible-xs mobile-social">
							<li><a href="{{$setting->facebook}}"><i class="fa fa-facebook"></i></a></li>
							<li><a href="{{$setting->twitter}}"><i class="fa fa-twitter"></i></a></li>
							<li><a href="{{$setting->android}}"><i class="fa fa-android"></i></a></li>
							<li><a href="{{$setting->instagram}}"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-rss"></i></a></li>
						</ul>
						<ul class="nav navbar-nav">
                            <?php

                            $link_url=Request::path();
                            $cat_id_main=0;
                            $x=0;
                            ?>

							@foreach($categories as $category)
                                <?php

                                $link_url=Request::path();
                                $cat_id_main=0;
                                if(strpos($link_url, 'categories') !== false){
                                    $lin_split=explode("/",$link_url);
                                    $cat_id_main=$lin_split[1];
                                }
                                ?>
								@if($x==0)
									<li  @if(strpos($link_url, 'news') !== false) class="active" @endif><a style="font-size: 19px;" href="{{url('news')}}">{{$category->name}}</a></li>
								@else
									<li  @if($cat_id_main>0 && $cat_id_main==$category->id) class="active" @endif><a style="font-size: 19px;" href="{{url('categories/'.$category->id)}}">{{$category->name}}</a></li>

								@endif
                                <?php $x++;?>
							@endforeach
							<li @if(strpos($link_url, 'studio') !== false) class="active" @endif><a style="font-size: 19px;" href="{{asset('studio')}}" >معرض الصور</a></li>
							<li @if(strpos($link_url, 'hotels') !== false) class="active" @endif><a style="font-size: 19px;" href="{{asset('hotels')}}" >فنادق رام الله</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</nav>
			</div>
		</div>
	</div>
</header>

@yield('content')

<section class="section contact-section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="section-header">
					<h3 class="section-title">إستفتاء</h3>
				</div>
				@if($vote)
					<div class="main-contact-section poll">
						<h3 class="poll-title">
							{{$vote->name}}
						</h3>
						<div class="poll-content">
							@foreach($vote->answers as $answer)
                                <?php
                                if($answer_count>0){
                                    $get_rasio=($answer->answer_count/$answer_count)*100;
                                    $get_rasio=number_format((float)$get_rasio, 1, '.', '');
                                }else{
                                    $get_rasio=0;
                                }

                                ?>
								<input type="hidden" id="vote_id_answer" value="{{$vote->id}}">

								<div class="pull-item">
                                <span class="pull-input">
                                    <label class="poll-label">
                                        <input type="radio" name="poll_name" id="vot_answer_poll_{{$answer->id}}" value="{{$answer->id}}">
                                        <span class="checkmark"></span>
										{{$answer->name}}
                                    </label>
                                </span>
									<div class="poll-value">
										<div class="progress">
											<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{{$get_rasio}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$get_rasio}}%"></div>
										</div>
									</div>
									<span class="pull-text-value">%{{$get_rasio}}</span>
								</div>

							@endforeach
							@if($can_vote)
								<div id="alert_poll"  class="alert alert-success " role="alert"  style="display: none;">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    width: 13px;
    margin: unset;
    border: unset;
    background-color: unset;
    color: black;
    margin-top: -2%;">
										<span aria-hidden="true">&times;</span>
									</button>
									تم اضافة تصويتك بنجاح
								</div>

								<div class="text-left" >
									<button class="poll-submit" id="answer_vote">تصويت  <i style="display: none;"  id="loader_poll" class="fa fa-spinner fa-spin"></i></button>
								</div>
							@endif
						</div>
					</div>
				@endif
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="section-header">
					<h3 class="section-title">تابعونا على</h3>
				</div>
				<div class="main-contact-section contact">
					<div class="row social-followers">
						<div class="col-xs-6">
							<a href="{{$setting->facebook}}" class="social-followers-item facebook">
								<i class="fa fa-facebook"></i>
								<span class="pull-right">فيسبوك</span>
								<span class="pull-left"><b>1.563</b> متابع</span>
							</a>
						</div>
						<div class="col-xs-6">
							<a href="{{$setting->twitter}}" class="social-followers-item twitter">
								<i class="fa fa-twitter"></i>
								<span class="pull-right">تويتر</span>
								<span class="pull-left"><b>1.563</b> متابع</span>
							</a>
						</div>
						<div class="col-xs-6">
							<a href="{{$setting->youtube}}" class="social-followers-item youtube">
								<i class="fa fa-youtube"></i>
								<span class="pull-right">يوتيوب</span>
								<span class="pull-left"><b>1.563</b> متابع</span>
							</a>
						</div>
						<div class="col-xs-6">
							<a href="#" class="social-followers-item rss">
								<i class="fa fa-rss"></i>
								<span class="pull-right">RSS</span>
								<span class="pull-left"><b>1.563</b> متابع</span>
							</a>
						</div>
					</div>
					<div class="mail-list-wrap">
						<form class="mail-list-form form_contact"  action="#" id="add_to_mail">
							<div id="alert"  class="alert alert-success " role="alert"  style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    width: 13px;
    margin: unset;
    border: unset;
    background-color: unset;
    color: black;
    margin-top: -2%;">
									<span aria-hidden="true">&times;</span>
								</button>
								تم اشتراكك في القائمة البريدية بنجاح
							</div>
							<div id="faild_send"  class="alert alert-danger " role="alert" style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    width: 13px;
    margin: unset;
    border: unset;
    background-color: unset;
    color: black;
    margin-top: -2%;">
									<span aria-hidden="true">&times;</span>
								</button>
								الايميل المدخل موجود مسبقا
							</div>
							<input type="email" placeholder="أدخل البريد الإلكتروني" id="email_list" name="email_list" />
							<button type="submit" class="btn btn_contact" ><i class="fa fa-paper-plane"></i> <i style="display: none;"  id="loader" class="fa fa-spinner fa-spin"></i> إشتراك</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<footer>
	<div class="container">
		<div class="top-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 text-center">
					<img src="{{asset('homeStyle')}}/images/footer-logo.png" />
				</div>
				<div class="col-md-9 hidden-xs hidden-sm text-left">
					<ul class="footer-ul">
						@foreach($categories as $category)
                            <?php

                            $link_url=Request::path();
                            $cat_id=0;
                            if(strpos($link_url, 'categories') !== false){
                                $lin_split=explode("/",$link_url);
                                $cat_id=$lin_split[1];
                            }
                            ?>
							<li  @if($cat_id>0 && $cat_id=$category->id) class="active" @endif><a style="font-size: 19px;" href="{{url('categories/'.$category->id)}}">{{$category->name}}</a></li>
						@endforeach

					</ul>
				</div>
			</div>
		</div>
		<div class="bottom-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-5">
					<span class="copyrights">جميع الحقوق محفوظة لرام الله الاخباري</span>
				</div>
				<div class="col-xs-12 col-sm-7 text-left">
					<ul class="footer-ul bottom-ul">
						<li><a href="{{asset('page/1')}}">من نحن</a></li>
						<li><a href="{{asset('home/contact_us')}}">إتصل بنا</a></li>
						<li><a href="{{asset('page/3')}}">سياسة الخصوصية</a></li>
						<li><a href="{{asset('page/4')}}">الشروط والأحكام</a></li>
						<li><a target="_blank" href="https://www.facebook.com/dotMediaa/"><img src="{{asset('homeStyle')}}/images/dot-media.png" width="100px" /></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<a href="#" class="go-top hidden-xs hidden-sm" style="display: none"><i class="fa fa-angle-up"></i></a>
</footer>

<script type="text/javascript" src="{{asset('homeStyle')}}/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/script.js?time={{time()}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/youtube-video-player.jquery.js"></script>
<script type="text/javascript" src="{{asset('homeStyle/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'error-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    $('#add_to_mail').validate({

        rules: {
            email_list: {required: true, email: true},

        },
        messages: {

            email_list: {required: "هذا الحقل مطلوب", email: "يرجى إدخال إيميل صحيح"},


        },
        submitHandler: function (form) {

            var dataString1 = new FormData();
            dataString1.append('email', $('#email_list').val());
            dataString1.append('_token', '{{csrf_token()}}');

            $("#loader").show();
            $('input').attr('disabled', 'disabled');
            $('select').attr('disabled', 'disabled');
            $('button').attr('disabled', 'disabled');
            $.ajax({
                url: "{{ URL::to('home/add_to_mail')}}",
                type: 'POST',
                dataType: 'json',
                data: dataString1,
                async: false,
                cache: false,

                success: function (response) {

                    $("#loader").hide();
                    $("#alert").show();
                    $('#alert').fadeOut(10000);
                    $('input').removeAttr('disabled');
                    $('select').removeAttr('disabled');
                    $('button').removeAttr('disabled');
                    $('#email_list').val('');

                },
                error: function (response) {
                    $('input').removeAttr('disabled');
                    $('select').removeAttr('disabled');
                    $('button').removeAttr('disabled');
                    $("#loader").hide();
                    $("#faild_send").show();
                    $('#faild_send').fadeOut(10000);

                },
                contentType: false,
                processData: false,
            });

        }
    });

</script>
@if($can_vote)
	<script>
        $(document).on('click','#answer_vote',function () {
            var answer_poll=$('input[name=poll_name]:checked').val();

            if(answer_poll){
                $("#loader_poll").show();
                $('input').attr('disabled', 'disabled');
                $('select').attr('disabled', 'disabled');
                $('button').attr('disabled', 'disabled');
                var dataString1 = new FormData();
                dataString1.append('vote_id', $('#vote_id_answer').val());
                dataString1.append('vot_answer', answer_poll);

                dataString1.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: "{{ URL::to('home/answer_vote')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: dataString1,
                    async: false,
                    cache: false,

                    success: function (response) {

                        $("#loader_poll").hide();
                        $("#alert_poll").show();
                        $('#alert_poll').fadeOut(10000);
                        $("#answer_vote").remove();
                        $('input').removeAttr('disabled');
                        $('select').removeAttr('disabled');
                        $('button').removeAttr('disabled');

                    },
                    error: function (response) {


                    },
                    contentType: false,
                    processData: false,
                });
            }

        })



	</script>
@endif
<script>
    $(document).ready(function() {
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+' '+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();;
        setTimeout(function(){

            $.ajax({
                url: "{{ asset('home/get_urgent') }}",
                success: function (data) {
                    var urgents= data.urgents;

                    if(urgents.length>0){
                        var i=0
                        function loop() {
                            if(i>urgents.length-1){
                                i=0;
							}
							var url_urgent='javascript:;';
                            if(urgents[i]['url']){
                                url_urgent=urgents[i]['url'];
							}
                            var html='<div class="close-urgent-news"><span><i class="fa fa-times"></i></span></div>' +
                                '<a href="javascript:;" class="urgent-news-cat">عاجل</a>' +
                                '<a href="'+url_urgent+'" class="urgent-news-title">'+urgents[i]['title']+'</a>';

                            $("#breaking__news").show();
                            $("#put_urgent").html(html);
                            $("#urgent_count").text(urgents.length);
                            $(".breaking__news_content").addClass('open');
                            $("#hade_urgent").val('yes');
                            if (++i < urgents.length) {
                                setTimeout(loop, 10000);  // call myself in 3 seconds time if required
                            }
                        };
                        loop();
                        setInterval(loop, 30000);
                    }else{
                        $("#hade_urgent").val('no');
                        $("#breaking__news").hide();
                    }
                }
            });

        }, 3000);
    });
</script>
@stack('scripts')
</body>
</html>