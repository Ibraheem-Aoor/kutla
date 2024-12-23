@extends('new_kotla_front.new_kotla_front_layout.master')
@section('title',$post->title)
<style>
	.blog-share .share-icon a .fa-facebook-f {
		background: #3b5999;
	}

	.blog-share .share-icon a i {
		width: 50px;
		height: 30px;
		line-height: 30px;
		display: block;
		border-radius: 4px;
		color: #fff;
		background: #f6f6f6;
		text-align: center;
	}
	.blog-share .share-icon a .fa-twitter {
		background: #55acee;
	}
	.blog-share .share-icon i:hover {
		opacity: 0.8;
	}

	.shorturl input {
		width: 183px;
		direction: ltr;
		padding: 5px 5px;
		margin-right: 5px;
		border: 1px solid #f3f3f3;
		text-align: left;
	}

</style>
@push('meta')

	<meta content="website" property="og:type">
	<meta property="og:url" content="{{return_post_link($post)}}">
	<meta name="twitter:url" content="{{return_post_link($post)}}">
	<meta property="og:title" content="{{$post->title}}">
	<meta name="description" property="og:description" content="{{str_limit(strip_tags($post->descriptions,200)) }}">
	<meta property="og:image" content="{{$post->image_url}}">
@endpush
@section('content')


	<!-- start:: section -->
	<div class="section section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
					<div class="single-post">
						<h2 class="single-post-title font-semi-bold mb-3">{{$post->title}}</h2>
						<div class="single-post-image">
							<img src="{{$post->image_url}}" class='w-100' alt="">
						</div>
						<div class="d-flex align-items-center justify-content-between mb-4 mt-2">
							<div class="single-post-date">
								<i class="far fa-clock"></i>
								{{returnDateFormay($post->published_at,true)}}
								<p class="shorturl">

									<strong>رابط مختصر:</strong>
									<input class="input-clipboard" type="text" value="{{route('new_post_show_twitter',$post->id)}}" data-toggle="tooltip" data-placement="top" title="Copied!" data-original-title="Copied!">

								</p>
							</div>
							<div class="single-post-action">
								<button type="button" class="btn border" onclick="zoomText('in')"><h5 class="font-semi-bold">ض</h5></button>
								<button type="button" class="btn border" onclick="zoomText('out')"><small>ض</small></button>
							</div>
						</div>
							<div class="single-post-text">
							<p class="mb-3">{!! $post->descriptions !!}</p>

						</div>
						<div class="mt-2" style=" padding: 1rem;   margin-bottom: 15px;    border-radius: 12px;    border: 2px solid #db2619 !important;   ">

							<h6><span class="text-primary"> كلمات مفتاحية :
									@foreach ($post->postTags as $tag)
										<a href="{{route('post.new_tag',['tag'=>$tag->id,'slug'=>$tag->name])}}"> - {{$tag->name}}</a>
									@endforeach
							</span>
							</h6>

						</div>
						<div class="blog-share" style="margin-bottom: 15px; box-sizing: border-box;">
							<h6 class="text-primary"> مشاركة عبر  :  </h6>
							<ul class="nav share-icon">
								<li style="margin-left: 5px;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{return_post_link($post)}}&amp;display=popup"><i class="fab fa-facebook-f"></i></a></li>
								<li style="margin-left: 5px;"><a target="_blank" href="https://twitter.com/share?url={{route('new_post_show_twitter',$post->id)}}"><i class="fab fa-twitter"></i></a></li>
								<li style="margin-left: 5px;"><a target="_blank" href="https://telegram.me/share/url?url={{route('new_post_show_twitter',$post->id)}}&text={{$post->title}}"><i class="fab fa-telegram-plane" style="background: #0077B5;"></i></a></li>
								<li style="margin-left: 5px;"><a target="_blank" href="whatsapp://send?text={{route('new_post_show_twitter',$post->id)}}"><i class="fab fa-whatsapp" style="background: #82c91e"></i></a></li>

							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
					<div class="mb-5">
						<div class="mb-3 bg--light d-flex justify-content-between align-items-center px-3 py-2">
							<h4 class="text-primary"> الأكثر قراءة</h4>
							<a href="{{route('new.new_category_show','الاكثر-قراءة')}}">مشاهدة المزيد</a>
						</div>
						<div class="widget-news">
							@foreach($popular as $item)
							<div class="widget-item mb-3">
								<h4><a href="{{return_new_post_link($item)}}" class="font-medium">{{$item->title}}</a></h4>
								<p class="text-muted">{{strip_tags(str_limit($item->descriptions,180))}}</p>
							</div>
							@endforeach
						</div>
					</div>
					<div class="mb-4">
						<div class="mb-3 bg-primary d-flex justify-content-between align-items-center px-3 py-2">
							<h4 class="text-white"> مواضيع ذات صلة</h4>
							<a href="{{return_new_category_link($post->Category)}}" class="text-white">مشاهدة المزيد</a>
						</div>
						<div class="widget-news">
							@foreach($related as $relate)
							<div class="widget-item mb-3">
								<h4><a href="{{return_new_post_link($relate)}}" class="font-medium">{{$relate->title}}</a></h4>
								<p class="text-muted">{{strip_tags(str_limit($relate->descriptions,150))}} </p>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end:: section -->
@stop
@push('js')
<script>
    function zoomText(status){
        var size = $(".single-post-text p").css('font-size');
        if(status == 'in'){
            var newSize = parseInt (size) + 1;
            $(".single-post-text p").css("font-size", "" + newSize + "px")
        }
        if(status == 'out'){
            var newSize = parseInt (size) - 1;
            $(".single-post-text p").css("font-size", "" + newSize + "px")
        }
    }
</script>
@endpush