@extends('katlo_front.katlo_fron_layout.master')
@section('title','الكتلة الاسلامية -الضفة الغربية')

@push('css')
	<style>
		.header-box .header-box-content {
			position: relative;
			top: 80% !important;
		}
		.header-box .header-box-content .header-box-slide .title {
			color: #ffffff;
		}
		.owl-stage-outer .owl-item:before {
			position: absolute;
			content: '';
			/*background: linear-gradient(transparent, #373535);*/
			background: linear-gradient(transparent, #5957577d);

			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			z-index: 5;
	}
		.header-box .header-box-content .header-box-slide h1 {
			padding: 1rem;
			padding-top: 6rem;
		}
		.gallary-box-content h5{
			display: inherit;
		}

		.gallary-box-content span{
			float: left;

		}

		.owl-item:after {
			position: absolute;
			content: "";
			width: 100%;
			height: 30%;
			bottom: 0;
			left: 0;
			transition: all 0.5s ease;
			background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(4, 4, 4, 1) 100%);
		}

		.blog-page .blog-box {
			text-align: center;
		}

		.box img {
			object-fit: fill;
		}
		.big-box{
			height: 370px;
		}
		.small-box{
			height: 230px;
		}
		.blog-page .blog-box:hover .blog-box-pic .shadow {
			position: absolute;
			content: "";
			width: 92%;
			height: 30%;
			bottom: 125px;
			left: 16px;
			transition: all 0.5s ease;
			background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(4, 4, 4, 1) 100%);
		}
		.banner .row {
			/* background: #009241; */
			margin: 0px;
			padding: 0;
			width: 100%;
		}

		.banner .row .img-banner {
			margin: 0px;
			padding: 0px;
			height: 100%;
			/* clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%); */
		}

		.banner .row .img-banner img {
			width: 100%;
			height: 160px;
		}

		.banner .row h1 {
			color: #fff;
			font-weight: bold;
			font-size: 30px;
			padding-right: 75px;
		}

		.banner .row .head-banner {
			position: relative;
			width: 100%;
			height: 160px;
			overflow: hidden;
			object-fit: cover;
			z-index: 2;
			background: url(http://kutla.ps/uploads/images/thump_770/55697.jpeg) no-repeat center;
			background-size: cover;
			display: flex;
			align-items: center;
			/* clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%);
            right: -75px; */
		}

		.banner .row .head-banner:after {
			position: absolute;
			content: "";
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.40);
			top: 0;
			left: 0;
			z-index: -2;
		}

		section {
			padding: 1rem 0;
		}
		.title-section .title {

			margin: 0;
			border-right: 3px solid #03BAAD !important;
			padding-right: 15px;
		}

	</style>

	@endpush
@section('content')
	@if($banner->active)
	<section class="banner">
		<div class="container">
			@if($banner->gif_active)
				<div class="col-lg-12 img-banner">
					<img src="{{asset($banner->gif_url)}}" alt="">
				</div>
			@else
			<a href="{{$banner->link}}">
				<div class="row" style="
    box-shadow: 5px 9px 28px 0 rgba(212,212,212,1);
">
					<div class="col-lg-3 img-banner">
						<img src="{{asset($banner->photo->file_name)}}" alt="">
					</div>
					<div class="col-lg-9 head-banner" style="background: url({{$banner->photo2->file_name}}) no-repeat center;background-size: cover;">
						<h1>{{$banner->title}}</h1>
					</div>
				</div>
			</a>
			@endif
		</div>
	</section>
	@endif
	<section class="recently pt-2 pb-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<!-- Please Put box-full Class if you need show ful DIV in home page  big-box small-box-->
					<div class="box  box-sub ">
						<img src="{{$sliders[0]->image_url}}" class="img-fluid" alt="">
						<ul class="nav icon">
							<li><a href="{{route('categoryGetAllPost',$sliders[0]->Category->id)}}"> {{$sliders[0]->Category->name}}</a></li>
						</ul>
						<div class="box-content">
							<a href="{{return_post_link($sliders[0])}}">
								<h4 class="title" title="{{$sliders[0]->title}}">{{$sliders[0]->title}}</h4>
							</a>
						</div>
					</div>

					<div class="box box-sub ">
						<img src="{{$sliders[1]->image_url}}" class="img-fluid" alt=" ">
						<ul class="nav icon">
							<li><a href="{{route('categoryGetAllPost',$sliders[1]->Category->id)}}">{{$sliders[1]->Category->name}}</a></li>
						</ul>
						<div class="box-content">
							<a href="{{return_post_link($sliders[1])}}">
								<h4 class="title">{{$sliders[1]->title}}</h4>
							</a>
						</div>
					</div>

					<!-- Please Put d-none Class if you don't need show this DIV in home page -->
					<div class="box-version  d-none">
						<div class="head">
							<p>إصدارات الكتلة</p>
						</div>
						<div class="content">
							<h4 class="title"></h4>
							<p class="datetime"></p>
						</div>
						<div class="arrow"><a href="" style="text-decoration: none;color: white;"><i class="fa fa-2x fa-angle-left"></i></a></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="box box-sub">
						<img src="{{$sliders[2]->image_url}}" class="img-fluid" alt=" ">
						<ul class="nav icon">
							<li><a href="{{route('categoryGetAllPost',$sliders[2]->Category->id)}}">{{ $sliders[2]->Category->name }}</a></li>
						</ul>
						<div class="box-content">
							<a href="{{return_post_link($sliders[2])}}">
								<h4 class="title">{{$sliders[2]->title}}</h4>
							</a>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="box box-sub">
								<img src="{{$sliders[3]->image_url}}" class="img-fluid" alt=" ">
								<ul class="nav icon">
									<li><a href="{{route('categoryGetAllPost',$sliders[3]->Category->id)}}">{{$sliders[3]->Category->name}}</a></li>
								</ul>
								<div class="box-content">
									<a href="{{return_post_link($sliders[3])}}">
										<h4 class="title">{{$sliders[3]->title}}</h4>
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="box box-sub">
								<img src="{{$sliders[4]->image_url}}" class="img-fluid" alt=" ">
								<ul class="nav icon">
									<li><a href="{{route('categoryGetAllPost',$sliders[4]->Category->id)}}">{{$sliders[4]->Category->name}}</a></li>
								</ul>
								<div class="box-content">
									<a href="{{return_post_link($sliders[4])}}">
										<h4 class="title">{{$sliders[4]->title}}</h4>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="logos">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-8">
					<ul class="nav nav-fill justify-content-center">
						@foreach($linkes as $link)
								<li class="nav-item">
									<a href="{{$link->link}}"  target="_blank" class="nav-link">
										<div class="circle">
											<div class="border"></div>
											<div class="stop"><img src="{{asset($link->photo->file_name)}}" alt=""></div>
										</div>
									</a>
								</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="blog-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8">

					<div class="row">
						<div class="col-lg-12">
							<div class="title-section">
								<h4 class="title">أخبار الكتلة الإسلامية</h4>
								<a href="https://kutla.ps/allNews" class="btn btn-link">المزيد</a>
							</div>
						</div>
					</div>

					<div class="row">
						@foreach($posts as $post)
						<div class="col-lg-6 col-sm-6">
							<div class="blog-box">
								<div class="blog-box-pic">
									<div class="shadow"></div>
									<img src="{{$post->image_url}}" class="img-fluid" alt="blog-post">
								</div>
								<div class="blog-box-content">
									<a href="{{return_post_link($post)}}">
										<h4 class="title" title="{{$post->title}}" style="min-height: 50px;">{{str_limit($post->title,50)}}</h4>
									</a>
								</div>
							</div>
						</div>
					@endforeach
					</div>

				</div>

				<div class="col-md-4">

					<div class="row">
						<div class="col-lg-12">
							<div class="title-section">
								<h4 class="title">تقارير الكتلة</h4>
								<a href="{{route('category_show','التقارير')}}" class="btn btn-link">المزيد</a>
							</div>
						</div>
					</div>
					<div class="row">
					@foreach($repotes as $repote)

						<div class="col-lg-12 col-sm-6">
							<div class="blog-box">
								<div class="blog-box-pic">
									<div class="shadow"></div>
									<img src="{{$repote->image_url}}" class="img-fluid" alt="blog-post">
								</div>
								<ul class="nav icon">
									<li><a href="{{route('category_show','التقارير')}}">تقرير</a></li>
								</ul>
								<div class="blog-box-content">
									<a href="{{return_post_link($repote)}}">
										<h4 class="title" title="{{$repote->title}}" style="min-height: 50px;">{{str_limit($repote->title,50)}}</h4>
									</a>
								</div>
							</div>
						</div>

						@endforeach
					</div>

				</div>

			</div>
		</div>
	</section>

	<section class="report">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-lg-12">
								<div class="title-section">
									<h4 class="title">بيانات الكتلة الإسلامية</h4>
									<a href="{{route('category_show','بيانات')}}" class="btn btn-link">المزيد</a>
								</div>
							</div>
						</div>
						<div class="row">
							@foreach($statments as $statment)
								<div class="col-md-12">
									<div class="box-report">
										<div class="box-report-date">
											<h4 class="day"> {{day_get($statment->created_at)}}</h4>
											<p class="month"> {{month_get($statment->created_at)}}</p>
										</div>
										<div class="box-report-content">
											<a href="{{return_post_link($statment)}}"><h4  style="min-height: 40px;" class="title">{{str_limit($statment->title,70)}}</h4> </a>
											<p class="description">{{str_limit(strip_tags($statment->descriptions,200))}}</p>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-lg-12">
								<div class="title-section">
									<h4 class="title">الصوتيات</h4>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
							<iframe width="100%" height="485" scrolling="no" frameborder="no" src="//w.soundcloud.com/player/?url=https://soundcloud.com/kutlawb?&amp;auto_play=false&amp;show_artwork=true&amp;visual=1" async></iframe>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section> 
		
	<section class="gallarys picture" id="gallarys">
			<div class="container"> 
				<div class="title-section">
					<h4 class="title">وسائط متعددة</h4>
					<ul class="nav nav-tabs nav-gallary">
						<li class="nav-item">
							<a href="#tab-1" data-tab="picture" data-toggle="tab" class="nav-link active"> معرض الصور</a>
						</li>
						<li class="nav-item">
							<a href="#tab-2" data-tab="videos" data-toggle="tab" class="nav-link"> معرض الفيديو</a>
						</li>
					</ul> 
				</div> 
				
				<div class="row">
					<div class="col-lg-12">
						<div class="tab-content">
							<div class="tab-pane fade show active gallary" id="tab-1">
								<div class="row">

									<div class="col-lg-3 col-md-6 col-sm-12">
										{{--<a href="{{route('alboms.images',$photo[1]->id)}}" data-fancybox="gallary" class="gallary-box sub">--}}
										<a href="{{route('alboms.images',$photo[1]->id)}}" class="gallary-box sub">
											<img src="{{$photo[1]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$photo[1]->name}}</h5>
												{{--<span>5</span>--}}
											</div>
										</a>
										<a href="{{route('alboms.images',$photo[2]->id)}}"  class="gallary-box sub">
											<img src="{{$photo[2]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$photo[2]->name}}</h5>
												{{--<span>5</span>--}}
											</div>
										</a>
									</div>
									
									<div class="col-lg-6 col-sm-12">
										<a href="{{route('alboms.images',$photo[0]->id)}}"  class="gallary-box">
											<img src="{{$photo[0]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$photo[0]->name}}</h5>
												{{--<span>5</span>--}}
											</div>
										</a>
									</div>
									
									<div class="col-lg-3 col-md-6 col-sm-12">
										<a href="{{route('alboms.images',$photo[3]->id)}}"  class="gallary-box sub">
											<img src="{{$photo[3]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$photo[3]->name}}</h5>
												{{--<span>5</span>--}}
											</div>
										</a>
										<a href="{{route('alboms.images',$photo[4]->id)}}"  class="gallary-box sub">
											<img src="{{$photo[4]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$photo[4]->name}}</h5>
												{{--<span>5</span>--}}
											</div>
										</a>
									</div> 
								</div>
								<div class="row justify-content-center">
									<div class="col-lg-3 col-md-6 col-sm-12"> 								
										<a href="/categories/معرض-الوسائط?type=photo" class="get-more"> تحميل المزيد </a>
									</div>
								</div>
							</div>
							<div class="tab-pane fade gallary" id="tab-2">
								<div class="row">

									<div class="col-lg-6 col-sm-12">
										<a class=" videos-gallery gallary-box"  href="{{$videos[0]->video_link}}"  onclick="getVideoUrl(this)" data-video_id="{{$videos[0]->id}}" data-fancybox="video" >
											<img src="{{$videos[0]->image_url}}" alt="">
											<div class="gallary-box-content">
												<div class="d-flex justify-content-between align-items-center">
													<h5>{{$videos[0]->name}}</h5>
													<ul class="nav video-option">
														{{--<li class="nav-item"> 05:19 </li>--}}
														<li class="nav-item"> <i class="fa fa-play"></i></li>
													</ul>
												</div>
											</div>
										</a>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-12"> 
										<a href="{{$videos[1]->video_link}}"  onclick="getVideoUrl(this)" data-video_id="{{$videos[1]->id}}" data-fancybox="video" class=" videos-gallery gallary-box sub">
											<img src="{{$videos[1]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$videos[1]->name}}</h5>
											</div>
										</a>
										<a href="{{$videos[2]->video_link}}" onclick="getVideoUrl(this)" data-video_id="{{$videos[2]->id}}"  data-fancybox="video" class=" videos-gallery gallary-box sub">
											<img src="{{$videos[2]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$videos[2]->name}}</h5>
											</div>
										</a>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-12">
										<a href="{{$videos[3]->video_link}}" onclick="getVideoUrl(this)" data-video_id="{{$videos[3]->id}}" data-fancybox="video" class=" videos-gallery gallary-box sub">
											<img src="{{$videos[3]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$videos[3]->name}}</h5>
											</div>
										</a>
										<a href="{{$videos[4]->video_link}}" onclick="getVideoUrl(this)" data-video_id="{{$videos[4]->id}}"  data-fancybox="video" class="videos-gallery gallary-box sub">
											<img src="{{$videos[4]->image_url}}" alt="">
											<div class="gallary-box-content">
												<h5>{{$videos[4]->name}}</h5>
											</div>
										</a>
									</div>  
								</div>
								<div class="row justify-content-center">
									<div class="col-lg-3 col-md-6 col-sm-12"> 								
										<a href="/categories/معرض-الوسائط?type=video" class="get-more"> تحميل المزيد </a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section> 
@stop
@push('js')
	<script>
        var ID ='';
        $('.videos-gallery').fancybox({
            // Options will go here
            smallBtn: "auto",

            // Should display toolbar (buttons at the top)
            // Can be true, false, "auto"
            // If "auto" - will be automatically hidden if "smallBtn" is enabled
            toolbar: "auto",
            buttons: [
                "zoom",
                "share",
                "slideShow",
                //"fullScreen",
                //"download",
                "thumbs",
                "close"
            ],
            share: {
                url: function(instance, item) {
                    console.log(instance);
                    // // let url  =(
                    // //     (!instance.currentHash && !(item.type === "inline" || item.type === "html") ? item.origSrc || item.src : false) || window.location
                    // // );
                    let url2 =(window.location.origin+'/video/'+ID);
                    //
                    // return decodeURI(url2);//decodeURI()  ;

                    return url2;
                },
                tpl:
                    '<div class="fancybox-share">' +
                    "<h1>مشاركة عبر</h1>" +
                    "<p>" +
                    '<a class="fancybox-share__button fancybox-share__button--fb" href="https://www.facebook.com/sharer/sharer.php?u=@{{url_raw}}">' +
                    '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m287 456v-299c0-21 6-35 35-35h38v-63c-7-1-29-3-55-3-54 0-91 33-91 94v306m143-254h-205v72h196" /></svg>' +
                    "<span>Facebook</span>" +
                    "</a>" +
                    '<a class="fancybox-share__button fancybox-share__button--tw" href="https://twitter.com/intent/tweet?url=@{{url_raw}}&text=@{{descr}}">' +
                    '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m456 133c-14 7-31 11-47 13 17-10 30-27 37-46-15 10-34 16-52 20-61-62-157-7-141 75-68-3-129-35-169-85-22 37-11 86 26 109-13 0-26-4-37-9 0 39 28 72 65 80-12 3-25 4-37 2 10 33 41 57 77 57-42 30-77 38-122 34 170 111 378-32 359-208 16-11 30-25 41-42z" /></svg>' +
                    "<span>Twitter</span>" +
                    "</a>" +
                    '<a class="fancybox-share__button fancybox-share__button--pt" href="https://www.pinterest.com/pin/create/button/?url=@{{url_raw}}&description=@{{descr}}&media=@{{media}}">' +
                    '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m265 56c-109 0-164 78-164 144 0 39 15 74 47 87 5 2 10 0 12-5l4-19c2-6 1-8-3-13-9-11-15-25-15-45 0-58 43-110 113-110 62 0 96 38 96 88 0 67-30 122-73 122-24 0-42-19-36-44 6-29 20-60 20-81 0-19-10-35-31-35-25 0-44 26-44 60 0 21 7 36 7 36l-30 125c-8 37-1 83 0 87 0 3 4 4 5 2 2-3 32-39 42-75l16-64c8 16 31 29 56 29 74 0 124-67 124-157 0-69-58-132-146-132z" fill="#fff"/></svg>' +
                    "<span>Pinterest</span>" +
                    "</a>" +
                    "</p>" +
                    '<p><input class="fancybox-share__input" type="text" value="@{{url_raw}}" /></p>' +
                    "</div>"}
        });
        function getVideoUrl(e){
            ID =   $(e).data('video_id');
            console.log(ID);
        }


	</script>
@endpush