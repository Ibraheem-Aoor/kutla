<!DOCTYPE html>
<html>
<head>
    @php
        $setting = \App\Models\Setting::first();
        $linkes  =  \App\Link::orderBy('created_at','desc')->get();
        $weather=yahoo_weather();
        $w_static = yahoo_weather()->high;

   // dd($weather);

    @endphp
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>الكتلة الاسلامية -الضفة الغربية</title>
    <meta property="og:type" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content=" " />
    <meta property="og:image" content="" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content=" " />
    <meta property="og:ttl" content="" />
    <meta name="twitter:card" content="" />
    <meta name="twitter:domain" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:creator" content="" />
    <meta name="twitter:image:src" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:title" content="الكتلة الاسلامية -الضفة الغربية " />
    <meta name="twitter:url" content="" />
    <meta name="description" content="{{$setting->description}}" />
    <meta name="keywords" content="{{$setting->main_tags}}" />
    <meta name="author" content="موقع الكتلة الاسلامية -الضفة الغربية" />
    <meta name="copyright" content="موقع الكتلة الاسلامية -الضفة الغربية " />
    <link rel="stylesheet" href="{{asset('new_front_kotla/assets/css/plugin.min.css')}}" />
    <link rel="stylesheet" href="{{asset('new_front_kotla/assets/css/main.css')}}" />
    <link rel="shortcut icon" href="{{asset('front_kotli/assets/img/logo.png')}}" type="image/x-icon" >
</head>
<body>
<!-- begin:: Page -->
<div class="main-wrapper">
    <div class="overlay-site"></div>
    <div class="loader-page"><span></span><span></span></div>
    <div class="search-box">
        <div class="container">
            <div class="search-container">
                <form class="search-form" action="" method="get">
                    <label class="d-flex align-items-center h-100 w-100 m-0" for="searchInput">
                        <input id="searchInput" type="text" placeholder="ابحث هنا" />
                    </label>
                </form>
                <div class="search-toggle"><i class="fas fa-arrow-left"></i></div>
            </div>
        </div>
    </div>
    <!-- begin:: Header -->
    <header class="main-header">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="logo ms-lg-5">
                    <a href="{{route('front.index')}}"><img src="{{asset('new_front_kotla/assets/images/logo.png')}}" alt="" /></a>
                </div>
                <div class="menu--mobile">
                    <div class="menu-container d-lg-none">
                        <div class="btn-close-header-mobile justify-content-end"><i class="fas fa-times"></i></div>
                    </div>
                    <div class="menu-container col mx-lg-5">
                        <ul class="main-menu list-main-menu d-lg-flex justify-content-between">
                            <li class="menu_item"><a  target="_blank" href="{{route('allNews')}}" class="menu_link active" >الأخبار</a></li>
                            <li class="menu_item"><a class="menu_link" data-scroll="section--5">التقارير</a></li>
                            <li class="menu_item"><a class="menu_link" data-scroll="section--3">بيانات</a></li>
                            <li class="menu_item"><a class="menu_link" data-scroll="section--2">معرض الوسائط </a></li>
                            <li class="menu_item"><a class="menu_link" href="{{route('aboutUs')}}">من نحن </a></li>
                            {{--<li class="menu_item"><a class="menu_link" href="#">منصات الجامعة </a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="menu-container col-auto me-auto me-lg-0">
                    <ul class="main-menu header-tools d-flex align-items-lg-center">
                        <li class="menu_item" style=" display: flex;   justify-content: space-between;">

                                <span class="head"  > <i class="icon-cloudy"></i> </span>
                                <span  style="margin-top: 8px;   margin-right: 8px;" > {{$w_static}} القدس </span>

                        </li>


                        <li class="menu_item">
                            <span class="head search-toggle"><i class="icon-search"></i></span>
                        </li>
                        {{--<li class="menu_item">--}}
                            {{--<div class="span head"><i class="icon-advertising"></i></div>--}}
                        {{--</li>--}}
                    </ul>
                </div>
                <div class="header-mobile__toolbar d-lg-none fa-lg me-3">
                    <svg width="25" height="16" viewBox="0 0 33 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line x1="33" y1="0.5" x2="-4.37115e-08" y2="0.499997" stroke="#0D3334"></line>
                        <line x1="33" y1="8.5" x2="-4.37115e-08" y2="8.5" stroke="#0D3334"></line>
                        <line x1="33" y1="15.5" x2="16" y2="15.5" stroke="#0D3334"></line>
                    </svg>
                </div>
            </div>
        </div>
    </header>
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

                <div class="col-12">
                    <div class="ads">
                        <a href="{{$banner->link}}">
                            <img src="{{asset($banner->photo->file_name)}}"  alt="" style="width: 100%;    height: 160px;">

                        </a>
                    </div>
                </div>
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
                                            <h2 class="widget__item-title font-medium text-white">{{$slider->title}}</h2>
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
                        <a class="btn-more" href="/categories/معرض-الوسائط?type=video">المزيد </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="widget__item-3 widget--1" href="{{$videos[0]->video_link}}" data-rel="lightcase:video">
                        <div class="widget__item-image"><img src="{{$videos[0]->image_url}}" alt="" /></div>
                        <div class="widget__item-icon"><i class="fas fa-play"></i></div>
                    </a>
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
                            <h5 class="widget__item-title text-white">الكتلة الإسلامية تنفذ سلسلة زيارات لقادة حركه حماس</h5>
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
                        <a class="btn-more" href="{{route('category_show','بيانات')}}">المزيد </a>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="0.2s">
                @foreach($statments as $statment)
                <div class="col-lg-6">
                    <div class="widget__item-4">
                        <div class="widget__item-image">
                            <a href="{{return_post_link($statment)}}"> <img src="{{$statment->image_url}}" alt="" /></a>
                        </div>
                        <div class="widget__item-content">
                            <h6 class="widget__item-date"><i class="far fa-calendar-alt ms-1"></i>{{return_just_day($statment->created_at)}} , {{\Carbon\Carbon::parse($statment->created_at)->format('d-m-Y')}}</h6>
                            {{--<h6 class="widget__item-date"><i class="far fa-calendar-alt ms-1"></i>الثلاثاء, 2021-11-23</h6>--}}
                            <h3 class="widget__item-title font-medium"><a href="{{return_post_link($statment)}}"> {{$statment->title}}</a></h3>
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
                        <a class="btn-more" href="/categories/معرض-الوسائط?type=photo">المزيد </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-container slider-images wow fadeInUp" data-wow-delay="0.2s">
            <div class="swiper-wrapper">
                @foreach($photo as $image)
                <div class="swiper-slide">
                    <a class="widget__item-5" href="{{route('alboms.images',$image->id)}}" >
                    {{--<a class="widget__item-5" href="{{route('alboms.images',$image->id)}}" data-rel="lightcase:image">--}}
                        <div class="widget__item-image"><img src="{{$image->image_url}}" alt="" /></div>
                        <div class="overlay"><i class="icon-image"></i></div>
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
                        <a class="btn-more" href="{{route('category_show','التقارير')}}">المزيد </a>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="0.2s">
                @foreach($repotes as $repote)
                <div class="col-lg-4 col-sm-6">
                    <div class="widget__item-6">
                        <div class="widget__item-image">
                            <a href="{{return_post_link($repote)}}"> <img src="{{$repote->image_url}}" alt="" /></a>
                        </div>
                        <div class="widget__item-content">
                            <h3 class="widget__item-title font-medium"><a href="{{return_post_link($repote)}}"> {{str_limit($repote->title,90)}}</a></h3>
                        </div>
                    </div>
                </div>
                    @endforeach

            </div>
        </div>
    </div>
    <!-- end:: section -->
    <!-- start:: footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <p class="text-white text-center text-lg-end mb-3 mb-lg-0">الكتلة الإسلامية جميع حقوق النشر محفوظة © 2021</p>
                </div>
                <div class="col-lg-4">
                    <ul class="social-media d-flex align-items-center justify-content-center mb-4 mb-lg-0">
                        <li>
                            <a href="{{$setting->facebook}}" target="_blank"> <i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="{{$setting->twitter}}" target="_blank"> <i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{$setting->instagram}}" target="_blank"> <i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="{{$setting->youtube}}" target="_blank"> <i class="fab fa-youtube"></i></a>
                        </li>
                        {{--<li>--}}
                            {{--<a href=""> <i class="fab fa-google"></i></a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
                <div class="col-lg-4">
                    <div class="logo justify-content-center justify-content-lg-end mt-3 mt-lg-0"><img src="{{asset('new_front_kotla/assets/images/logo-footer.png')}}" alt="" /></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end:: footer -->
</div>
<!-- end:: Page -->
<script src="{{asset('new_front_kotla/assets/js/script.min.js')}}"></script>
<script src="{{asset('new_front_kotla/assets/js/function.js')}}"></script>
</body>
</html>
