@extends('new_kotla_front.new_kotla_front_layout.master')
@section('title',$name)
@section('content')
	<div class="section section" >
		<div class="container">

			<div class="row wow fadeInUp" data-wow-delay="0.2s">
				@foreach($posts as $post)
					<div class="col-lg-4 col-sm-6">
						<div class="widget__item-6">
							<div class="widget__item-image">
								<a href="{{return_new_post_link($post)}}"> <img src="{{$post->image_url}}" alt="" /></a>
							</div>
							<div class="widget__item-content">
								<h3 class="widget__item-title font-medium"><a href="{{return_new_post_link($post)}}"> {{str_limit($post->title,65)}}</a></h3>
							</div>
						</div>
					</div>
				@endforeach

			</div>
		</div>
		<div class="row">
			<div class="col-12">
				{{ $posts->links('pagination.custom') }}
			</div>
		</div>
	</div>
		 

@stop
@push('js')

@endpush