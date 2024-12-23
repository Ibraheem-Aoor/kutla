@extends('new_kotla_front.new_kotla_front_layout.master')
@section('title',$name)
@if(isset($video_sharing))
    @push('meta')

        <meta content="website" property="og:type">
        <meta property="og:url" content="{{route('show_video',$video_sharing->id)}}">
        <meta name="twitter:url" content="{{route('show_video',$video_sharing->id)}}">
        <meta property="og:title" content="{{$video_sharing->name}}">
        <meta name="description" property="og:description" content="{{str_limit(strip_tags($video_sharing->name,200)) }}">
        <meta property="og:image" content="{{$video_sharing->image_url}}">
    @endpush
@endif

@section('content')
    <!-- start:: section -->
    <div class="section section ">
        <div class="container">

            <div class="row wow fadeInUp" data-wow-delay="0.2s">
                @foreach($videos as $video)
                    <div class="col-lg-4 col-sm-6 mb-3 mt-2" >
                        <a class="widget__item-3 widget--1" href="{{asset($video->video_link)}}" data-rel="lightcase:video">
                            <div class="widget__item-image"><img src="{{asset($video->image_url)}}" alt=""></div>
                            <div class="widget__item-icon"><i class="fas fa-play"></i></div>
                        </a>
                    </div>

                @endforeach

            </div>


            </div>
        <div class="row">
            <div class="col-12">
                {{ $videos->links('pagination.custom') }}
            </div>
        </div>
        </div>

    <!-- end:: section -->

@stop
