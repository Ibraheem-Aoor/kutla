@extends('katlo_front.katlo_fron_layout.master')
@section('title',$post->title)
@push('meta')

	<meta content="website" property="og:type">
	<meta property="og:url" content="{{return_post_link($post)}}">
	<meta name="twitter:url" content="{{return_post_link($post)}}">
	<meta property="og:title" content="{{$post->title}}">
	<meta name="description" property="og:description" content="{{str_limit(strip_tags($post->descriptions,200)) }}">
	<meta property="og:image" content="{{$post->image_url}}">
	@endpush

@push('css')
	<style>
		.big-banner:before{
			position: static !important;
		}
		.post-banner {
			padding-top: 0px !important;
			padding-bottom: 0px !important;
		}
	</style>
	@endpush
@section('content')
	<section class="blog-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<h1 class="title my-4">{{$post->title}}</h1>
					{{--<div class="big-banner post-banner mb-1"--}}
						 {{--style="background-image: url({{$post->image_url}}); height: 460px; background-position: center; background-size: contain;">--}}
					{{--</div>--}}
					<div class="big-banner post-banner mb-1 pt-0">
						<img src="{{$post->image_url}}" alt="" width="100%">
					</div>
					<div class="blogger-box">
						{{--<div class="media" style="--}}
    {{--/* padding-left: 14px; */--}}
    {{--margin-right: 10px;--}}
{{--">--}}
							{{--<div class="media-pic">--}}
								{{--<img src="{{asset('front_kotli/assets/img/logo.png')}}" class="img-fluid" alt="blogger-pic">--}}
							{{--</div>--}}
						{{--</div>--}}
					</div>
					<div class="blog-title" style="
    float: left;
">
						{{--<h3 class="text-primary">--}}{{--$post->title--}}{{--</h3>--}}

						<div class="zome-in-out">
							<button type="button" class="btn border" onclick="zoomText('in')"><h6>ض</h6></button>
							<button type="button" class="btn border" onclick="zoomText('out')"><small>ض</small></button>
						</div>
					</div>
					<div class="blog-time">
						<p><i class="far fa-clock"></i> {{returnDateFormay($post->published_at,true)}}</p>
						{{--<p><strong>رابط مختصر :</strong>{{route('post_show_twitter',$post->id)}}</p>--}}
						<p class="shorturl">

								<strong>رابط مختصر:</strong>
								<input class="input-clipboard" type="text" value="{{route('post_show_twitter',$post->id)}}" data-toggle="tooltip" data-placement="top" title="Copied!" data-original-title="Copied!">

						</p>
					</div>
					<div class="blog-details">
						{!! $post->descriptions !!}
					</div>
					<div class="blog-tags">
						<h6><span class="text-primary"> كلمات مفتاحية :
								@foreach ($post->postTags as $tag)
									<a href="{{route('post.tag',['tag'=>$tag->id,'slug'=>$tag->name])}}"> - {{$tag->name}}</a>
								@endforeach
							</span>
						</h6>

					</div>
					<div class="blog-share">
						<h6 class="text-primary"> مشاركة عبر  :  </h6>
						<ul class="nav share-icon">
							<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{return_post_link($post)}}&amp;display=popup"><i class="fab fa-facebook-f"></i></a></li>
							<li><a target="_blank" href="https://twitter.com/share?url={{route('post_show_twitter',$post->id)}}"><i class="fab fa-twitter"></i></a></li>
							<li><a target="_blank" href="https://telegram.me/share/url?url={{route('post_show_twitter',$post->id)}}&text={{$post->title}}"><i class="fab fa-telegram-plane" style="background: #0077B5;"></i></a></li>
							<li><a target="_blank" href="whatsapp://send?text={{route('post_show_twitter',$post->id)}}"><i class="fab fa-whatsapp" style="background: #82c91e"></i></a></li>

						</ul>
					</div>
				</div>
				<div class="col-lg-4 blogs">

					<div class="widget">
						<div class="bg-light d-flex justify-content-between align-items-center">
							<h4> الأكثر قراءة</h4>
							<a href="{{route('category_show','الاكثر-قراءة')}}">مشاهدة المزيد</a>
						</div>
						<div class="most-read">
							@foreach($popular as $item)
								<div class="media">
									<div class="media-body">
										<a href="{{return_post_link($item)}}"><h5 class="mt-0 title">{{$item->title}}</h5></a>
										<p></p>
										{{--<p><i class="fa fa-user"></i> اسم المدون يكتب هنــا</p>--}}
										<p>{{strip_tags(str_limit($item->descriptions,150))}} <a href="{{return_post_link($item)}}">اقرأ المزيد</a></p>
									</div>
								</div>
							@endforeach


						</div>
					</div>
					<div class="widget">
						<div class="bg-light inverse d-flex justify-content-between align-items-center">
							<h4> مواضيع ذات صلة</h4>
							<a href="{{return_category_link($post->Category)}}">مشاهدة المزيد</a>
						</div>
						<div class="most-read">
							@foreach($related as $relate)
								<div class="media">
									<div class="media-body">
										<a href="{{return_post_link($relate)}}"><h5 class="mt-0 title">{{$relate->title}}</h5></a>
										<p></p>
										{{--<p><i class="fa fa-user"></i> اسم المدون يكتب هنــا</p>--}}
										<p>{{strip_tags(str_limit($relate->descriptions,150))}} <a href="{{return_post_link($relate)}}">اقرأ المزيد</a></p>
									</div>
								</div>
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop
		
