<!-- mobile navbar -->
<div class="collapse navbar-collapse navbar-mobile " id="navbar-menu">
    <div class="navbar-mobile-box p-2">
        <a class="border-bottom nav-link d-flex justify-content-between align-items-center collapsed" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="false">
            <img src="{{asset('front_kotli/assets/img/i/all.png')}}" width="50" alt="logo-image" >
            <div class="close"><i class="fas fa-times float-right"></i></div>
        </a>
        <div class="main-navbar">
            <ul class="nav">
                <li class="nav-item">
                    <a href="{{route('front.index')}}" class="nav-link">
                        <div class="icon">
                            <img src="{{asset('front_kotli/assets/img/home.png')}}" class="dark-icon">
                            <img src="{{asset('front_kotli/assets/img/h-icon-1.png')}}" class="light-icon">
                        </div>
                        الرئيسية
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allNews')}}" class="nav-link">
                        <div class="icon">
                            <img src="{{asset('front_kotli/assets/img/news1.png')}}" class="dark-icon">
                            <img src="{{asset('front_kotli/assets/img/h-icon-3.png')}}" class="light-icon">
                        </div>
                        الأخبار
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('category_show','التقارير')}}" class="nav-link active">
                        <div class="icon">
                            <img src="{{asset('front_kotli/assets/img/reports.png')}}" class="dark-icon">
                            <img src="{{asset('front_kotli/assets/img/reports-hover.png')}}" class="light-icon">
                        </div>
                        التقارير
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('category_show','بيانات')}}" class="nav-link">
                        <div class="icon">
                            <img src="{{asset('front_kotli/assets/img/bayanat.png')}}" class="dark-icon">
                            <img src="{{asset('front_kotli/assets/img/h-icon-4.png')}}" class="light-icon">
                        </div>
                        بيانات
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('category_show','معرض-الوسائط')}}" class="nav-link">
                        <div class="icon">
                            <img src="{{asset('front_kotli/assets/img/video.png')}}" class="dark-icon">
                            <img src="{{asset('front_kotli/assets/img/h-icon-5.png')}}" class="light-icon">
                        </div>
                        معرض الوسائط
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('aboutUs')}}" class="nav-link">
                        <div class="icon">
                            <img src="{{asset('front_kotli/assets/img/about.png')}}" class="dark-icon">
                            <img src="{{asset('front_kotli/assets/img/h-icon-2.png')}}" class="light-icon">
                        </div>
                        من نحن
                    </a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a href="{{route('contactUs')}}" class="nav-link">--}}
                        {{--<div class="icon">--}}
                            {{--<img src="{{asset('front_kotli/assets/img/about.png')}}" class="dark-icon">--}}
                            {{--<img src="{{asset('front_kotli/assets/img/h-icon-2.png')}}" class="light-icon">--}}
                        {{--</div>--}}
                        {{--تواصل معنا--}}
                    {{--</a>--}}
                {{--</li>--}}

                {{--<li class="nav-item">--}}
                    {{--<a href="#" class="nav-link">--}}
                        {{--<div class="icon">--}}
                            {{--<img src="{{asset('front_kotli/assets/img/v-icon-6.png')}}" class="dark-icon">--}}
                            {{--<img src="{{asset('front_kotli/assets/img/h-icon-6.png')}}" class="light-icon">--}}
                        {{--</div>--}}
                        {{--معرض الفيديو--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a href="{{route('category_show','الاصدارات')}}" class="nav-link">
                        <div class="icon">
                            <img src="{{asset('front_kotli/assets/img/esdarat.png')}}" class="dark-icon">
                            <img src="{{asset('front_kotli/assets/img/h-icon-7.png')}}" class="light-icon">
                        </div>
                        الإصدارات
                    </a>
                </li>
            </ul>
        </div>

        <div class="footer-box-social-media">
            <ul class="nav">
                <li class="nav-item">
                    <a href="{{$setting->facebook}}" target="_blank" class="nav-link">
                        <img src="{{asset('front_kotli/assets/img/facebook.png')}}" alt="facebook">
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{$setting->twitter}}" target="_blank" class="nav-link">
                        <img src="{{asset('front_kotli/assets/img/twitter.png')}}" alt="twitter">
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{$setting->instagram}}" target="_blank" class="nav-link">
                        <img src="{{asset('front_kotli/assets/img/instagram.png')}}" alt="instagram">
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{$setting->youtube}}" target="_blank" class="nav-link">
                        <img src="{{asset('front_kotli/assets/img/youtube.png')}}" alt="youtube">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<nav class="mobile-header py-2">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="/">
                <img src="{{asset('front_kotli/assets/img/i/all.png')}}" width="80%" alt="logo">
            </a>
            <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-ellipsis-v"></i></span>
            </button>
        </div>
    </div>
</nav>
<!-- end mobile navbar -->


<nav class="top-nav">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="nav-menu">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('front_kotli/assets/img/icon-1.png')}}" alt="" >  <span id="time">{{time_function()}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('front_kotli/assets/img/icon-2.png')}}" alt=""> {{date_now_function()}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('front_kotli/assets/img/icon-3.png')}}" alt="">   {{$w_static}} القدس  </a>
                    </li>
                </ul>
            </div>

            <div class="social-media">
                <ul class="nav social-icon">
                    <li><a href="{{$setting->soundcloud}}" target="_blank"><i class="fab fa-soundcloud"></i></a></li>
                    <li><a href="{{$setting->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{$setting->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{$setting->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="{{$setting->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

@stack('private')
{{--<section class="private">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-12">--}}
                {{--<a href="#" class="d-block">--}}
                    {{--<div class="private-box">--}}
                        {{--<label class="private-box-keyword"> ملف خاص </label>--}}
                        {{--<h1 class="private-box-title">إعتقال ثلاثة طلبة من جامعة النجاح</h1>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}


<nav class="navbar-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-navbar-box">
                    <div class="logo">
                        <a href="{{route('front.index')}}">
                            <img src="{{asset('front_kotli/assets/img/logo.png')}}" style="
    width: 200px;
    height: 200px;
    object-fit:  contain;
    position: relative;
    right: -102px;
    bottom: 25px;
    max-width: unset;
" class="img-fluid">
                        </a>
                    </div>
                    <div class="main-navbar">
                        <ul class="nav nav-fill">
                            <li class="nav-item">
                                <a href="{{route('front.index')}}" class="nav-link active">
                                    <div class="icon">
                                        <img src="{{asset('front_kotli/assets/img/home.png')}}" class="dark-icon">
                                        <img src="{{asset('front_kotli/assets/img/h-icon-1.png')}}" class="light-icon">
                                    </div>
                                    الرئيسية
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('allNews')}}" class="nav-link active">
                                    <div class="icon">
                                        <img src="{{asset('front_kotli/assets/img/news1.png')}}" class="dark-icon">
                                        <img src="{{asset('front_kotli/assets/img/h-icon-3.png')}}" class="light-icon">
                                    </div>
                                    الأخبار
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('category_show','التقارير')}}" class="nav-link active">
                                    <div class="icon">
                                        <img src="{{asset('front_kotli/assets/img/reports.png')}}" class="dark-icon">
                                        <img src="{{asset('front_kotli/assets/img/reports-hover.png')}}" class="light-icon">
                                    </div>
                                    التقارير
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('category_show','بيانات')}}" class="nav-link active">
                                    <div class="icon">
                                        <img src="{{asset('front_kotli/assets/img/bayanat.png')}}" class="dark-icon">
                                        <img src="{{asset('front_kotli/assets/img/h-icon-4.png')}}" class="light-icon">
                                    </div>
                                    بيانات
                                </a>
                            </li>
                            {{--<li class="nav-item">--}}
                                {{--<a href="{{route('category_show','معرض-الوسائط')}}" class="nav-link active">--}}
                                    {{--<div class="icon">--}}
                                        {{--<img src="{{asset('front_kotli/assets/img/video.png')}}" class="dark-icon">--}}
                                        {{--<img src="{{asset('front_kotli/assets/img/h-icon-5.png')}}" class="light-icon">--}}
                                    {{--</div>--}}
                                    {{--معرض الوسائط--}}
                                {{--</a>--}}
                            {{--</li>--}}


                            <li class="nav-item dropdown">
                                <a href="https://kutla.ps/categories/%D9%85%D8%B9%D8%B1%D8%B6-%D8%A7%D9%84%D9%88%D8%B3%D8%A7%D8%A6%D8%B7"
                                   class="nav-link active dropbtn" role="button">
                                    <div class="icon">
                                        <img src="https://kutla.ps/front_kotli/assets/img/video.png"
                                             class="dark-icon">
                                        <img src="https://kutla.ps/front_kotli/assets/img/h-icon-5.png"
                                             class="light-icon">
                                    </div>
                                    معرض الوسائط
                                </a>
                                <div class="dropdown-content" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/categories/معرض-الوسائط?type=photo">معرض الصور</a>
                                    <a class="dropdown-item" href="/categories/معرض-الوسائط?type=video">معرض الفيديو</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('aboutUs')}}" class="nav-link active">
                                    <div class="icon">
                                        <img src="{{asset('front_kotli/assets/img/about.png')}}" class="dark-icon">
                                        <img src="{{asset('front_kotli/assets/img/h-icon-2.png')}}" class="light-icon">
                                    </div>
                                    من نحن
                                </a>
                            </li>
                            {{--<li class="nav-item">--}}
                                {{--<a href="{{route('contactUs')}}" class="nav-link">--}}
                                    {{--<div class="icon">--}}
                                        {{--<img src="{{asset('front_kotli/assets/img/about.png')}}" class="dark-icon">--}}
                                        {{--<img src="{{asset('front_kotli/assets/img/h-icon-2.png')}}" class="light-icon">--}}
                                    {{--</div>--}}
                                    {{--تواصل معنا--}}
                                {{--</a>--}}
                            {{--</li>--}}

                            {{--<li class="nav-item">--}}
                                {{--<a href="{{route('category_show','فيديو')}}" class="nav-link active">--}}
                                    {{--<div class="icon">--}}
                                        {{--<img src="{{asset('front_kotli/assets/img/v-icon-6.png')}}" class="dark-icon">--}}
                                        {{--<img src="{{asset('front_kotli/assets/img/h-icon-6.png')}}" class="light-icon">--}}
                                    {{--</div>--}}
                                    {{--معرض الفيديو--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                                {{--<a href="{{route('category_show','الاصدارات')}}" class="nav-link active">--}}
                                    {{--<div class="icon">--}}
                                        {{--<img src="{{asset('front_kotli/assets/img/esdarat.png')}}" class="dark-icon">--}}
                                        {{--<img src="{{asset('front_kotli/assets/img/h-icon-7.png')}}" class="light-icon">--}}
                                    {{--</div>--}}
                                    {{--الإصدارات--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            <li class="nav-item dropdown">

                                <a class="nav-link dropbtn" >
                                    <div class="icon">
                                        <img src="{{asset('front_kotli/assets/img/social.png')}}" class="dark-icon">
                                        <img src="{{asset('front_kotli/assets/img/social-hover.png')}}" class="light-icon">
                                    </div>
                                    منصات الجامعات
                                </a>
                                <div class="dropdown-content">
                                    @foreach($linkes as $link)
                                          <a class="dropdown-item" href="{{$link->link}}" target="_blank">{{$link->title}}</a>
                                    @endforeach
                                </div>
                                {{--<a href="{{route('category_show','الاصدارات')}}" class="nav-link">--}}
                                {{--الإصدارات--}}
                                {{--</a>--}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>