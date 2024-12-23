@extends('new_kotla_front.new_kotla_front_layout.master')
@section('title','الكتلة الاسلامية -الضفة الغربية')

@push('css')
<style>
    .widget__item-link_title{
        position: absolute;
        bottom: 0;
        padding: 49px 10px;
        width: 100%;
        background: linear-gradient(
                180deg, rgba(255,0,0,0) 0%, rgba(0,0,0,1) 100%);
    }

</style>

@endpush
@section('content')
    <!-- begin:: section -->
    <div class="section p-0 section-hero" id="section--1">
        <div class="container">
            <div class="row py-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-12">
                    <div class="special-files">
                        <div class="swiper-container slider-files">
                            <div class="swiper-wrapper">
                                @foreach($linkes as $link)
                                    <div class="swiper-slide">
                                        <a class="widget__item-1" href="{{$link->link}}"  target="_blank" >

                                            <div class="widget__item-image"><img src="{{asset($link->photo->file_name)}}" alt="" /></div>
                                            <h3 class="widget__item-title">{{$link->title}}</h3>
                                        </a>
                                    </div>
                                @endforeach
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-2.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">جامعة الخليل</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-3.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">جامعة بيت لحم</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-4.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">فلسطين الأهلية</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-5.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">جامعة بيرزيت</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-6.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">فلسطين الأهلية</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-7.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">فلسطين الأهلية</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-1.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">فلسطين الأهلية</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-2.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">جامعة الخليل</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-3.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">جامعة بيت لحم</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                {{--<a class="widget__item-1" href="">--}}
                                {{--<div class="widget__item-image"><img src="assets/images/img-4.png" alt="" /></div>--}}
                                {{--<h3 class="widget__item-title">فلسطين الأهلية</h3>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <div class="swiper-button swiper-button-prev"><i class="fas fa-chevron-right"></i></div>
                        <div class="swiper-button swiper-button-next"><i class="fas fa-chevron-left"></i></div>
                    </div>
                </div>
            </div>


            <div class="row pb-4">
                @if($banner->gif_active)
                <div class="col-12">
                    <div class="ads">
                        <a href="{{$banner->link}}">
                            <img src="{{asset($banner->photo->file_name)}}"  alt="" style="width: 100%;    height: 160px;">

                        </a>
                    </div>
                </div>

                @endif
                {{--<div class="col-6">--}}
                {{--<div class="ads">--}}
                {{--<a href="">--}}
                {{--<img src="{{asset('new_front_kotla/assets/images/ads.png')}})" class="w-100" alt="">--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--</div>--}}

            </div>

            <div class="row pb-5 mb-3 mb-lg-0 pb-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-12">
                    <div class="main-slider-hero">
                        <div class="swiper-container slider-hero">
                            <div class="swiper-wrapper">
                                @foreach($sliders as $slider)
                                    <div class="swiper-slide">
                                        <div class="widget__item-2">
                                            <div class="widget__item-image"><img src="{{$slider->image_url}}" alt="" /></div>
                                            <div class="widget__item-content">
                                               <a href="{{return_new_post_link($slider)}}"><h2 class="widget__item-title font-medium text-white">{{$slider->title}}</h2></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: section -->

    <!-- start:: section -->
    <div class="section section section-video" id="section--2">
        <div class="container">
            <div class="row mb-4 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-12">
                    {{--<h2 class="title-section text-white font-medium">فيديو</h2>--}}
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="title-section text-white font-medium">فيديو</h2>
                        <a class="btn-more" href="/category/معرض-الوسائط?type=video">المزيد </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="widget__item-3 widget--1" href="{{$videos[0]->video_link}}" data-rel="lightcase:video">
                        <div class="widget__item-image"><img src="{{$videos[0]->image_url}}" alt="" /></div>
                        <div class="widget__item-icon"><i class="fas fa-play"></i></div>
                        <div class="widget__item-link_title"> <h2 class="widget__item-title font-medium text-white ">{{$videos[0]->name}}</h2></div>
                    </a>
                    {{--<div class="widget__item-content">--}}
                        {{--<a href="{{$videos[0]->video_link}}"><h2 class="widget__item-title font-medium text-white ">{{$videos[0]->name}}</h2></a>--}}
                    {{--</div>--}}

                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <a class="widget__item-3 widget--2" href="{{$videos[1]->video_link}}" data-rel="lightcase:video">
                        <div class="widget__item-image">
                            <img src="{{$videos[1]->image_url}}" alt="" />
                            <div class="widget__item-icon"><i class="fas fa-play"></i></div>
                        </div>
                        <div class="widget__item-content">
                            <h5 class="widget__item-title text-white">{{$videos[1]->name}}</h5>
                        </div>
                    </a>
                    <a class="widget__item-3 widget--2" href="{{$videos[2]->video_link}}" data-rel="lightcase:video">
                        <div class="widget__item-image">
                            <img src="{{$videos[2]->image_url}}" alt="" />
                            <div class="widget__item-icon"><i class="fas fa-play"></i></div>
                        </div>
                        <div class="widget__item-content">
                            <h5 class="widget__item-title text-white">{{$videos[2]->name}}</h5>
                        </div>
                    </a>
                    <a class="widget__item-3 widget--2" href="{{$videos[3]->video_link}}" data-rel="lightcase:video">
                        <div class="widget__item-image">
                            <img src="{{$videos[3]->image_url}}" alt="" />
                            <div class="widget__item-icon"><i class="fas fa-play"></i></div>
                        </div>
                        <div class="widget__item-content">
                            <h5 class="widget__item-title text-white">{{$videos[3]->name}}</h5>
                        </div>
                    </a>
                    <a class="widget__item-3 widget--2" href="{{$videos[4]->video_link}}" data-rel="lightcase:video">
                        <div class="widget__item-image">
                            <img src="{{$videos[4]->image_url}}" alt="" />
                            <div class="widget__item-icon"><i class="fas fa-play"></i></div>
                        </div>
                        <div class="widget__item-content">
                            <h5 class="widget__item-title text-white">{{$videos[4]->name}}</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: section -->
    <!-- start:: section -->
    <div class="section section" id="section--3">
        <div class="container">
            <div class="row mb-4 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="title-section font-medium">البيانات</h2>
                        <a class="btn-more" href="{{route('new.new_category_show','بيانات')}}">المزيد </a>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="0.2s">
                @foreach($statments as $statment)
                    <div class="col-lg-6">
                        <div class="widget__item-4">
                            <div class="widget__item-image">
                                <a href="{{return_new_post_link($statment)}}"> <img src="{{$statment->image_url}}" alt="" /></a>
                            </div>
                            <div class="widget__item-content">
                                <h6 class="widget__item-date"><i class="far fa-calendar-alt ms-1"></i>{{return_just_day($statment->created_at)}} , {{\Carbon\Carbon::parse($statment->created_at)->format('d-m-Y')}}</h6>
                                {{--<h6 class="widget__item-date"><i class="far fa-calendar-alt ms-1"></i>الثلاثاء, 2021-11-23</h6>--}}
                                <h3 class="widget__item-title font-medium"><a href="{{return_new_post_link($statment)}}"> {{$statment->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end:: section -->
    <!-- start:: section -->
    <div class="section section section-video" id="section--4">
        <div class="container">
            <div class="row mb-4 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="title-section text-white font-medium">مكتبة الصور</h2>
                        <a class="btn-more" href="/category/معرض-الوسائط?type=photo">المزيد </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-container slider-images wow fadeInUp" data-wow-delay="0.2s">
            <div class="swiper-wrapper">
                @foreach($photo as $image)
                    <div class="swiper-slide">
                        <a class="widget__item-5" href="{{route('new.alboms.images',$image->id)}}" >
                            {{--<a class="widget__item-5" href="{{route('alboms.images',$image->id)}}" data-rel="lightcase:image">--}}
                            <div class="widget__item-image"><img src="{{$image->image_url}}" alt="" /></div>
                            <div class="overlay">
                                <i class="icon-image"></i>
                                <p style="font-size: 20px; color:white;">{{$image->name}} </p>
                            </div>

                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- end:: section -->
    <!-- start:: section -->
    <div class="section section" id="section--5">
        <div class="container">
            <div class="row mb-4 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="title-section font-medium">التقارير</h2>
                        <a class="btn-more" href="{{route('new.new_category_show','التقارير')}}">المزيد </a>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="0.2s">
                @foreach($repotes as $repote)
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget__item-6">
                            <div class="widget__item-image">
                                <a href="{{return_new_post_link($repote)}}"> <img src="{{$repote->image_url}}" alt="" /></a>
                            </div>
                            <div class="widget__item-content">
                                <h3 class="widget__item-title font-medium"><a href="{{return_new_post_link($repote)}}"> {{str_limit($repote->title,90)}}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- end:: section -->
@stop
@push('js')

@endpush