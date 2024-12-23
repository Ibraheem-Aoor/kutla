@php
    $setting = \App\Models\Setting::first();
    $linkes  =  \App\Link::orderBy('created_at','desc')->get();
    //$weather=yahoo_weather();
    $w_static = yahoo_weather()->high;

@endphp

<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{asset('front_kotli/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front_kotli/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('front_kotli/assets/css/custom.css')}}">
    <meta name="rights" content="موقع الكتلة الاسلامية -الضفة الغربية"/>
    <meta name="author" content="الكتلة الاسلامية -الضفة الغربية"/>
    <meta name="keywords" content="{{$setting->main_tags}}"/>
    <meta name="description" content="{{$setting->description}}" />
    <meta content="website" property="og:type">
    <meta property="og:title" content="الكتلة الاسلامية -الضفة الغربية">
    {{--<meta property="og:image" content="{{asset('front_kotli/assets/img/logo.png')}}">--}}

    @stack('meta')
    <link rel="shortcut icon" href="{{asset('front_kotli/assets/img/logo.png')}}" type="image/x-icon" >
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <title> @yield('title')</title>
    @stack('css')
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
        .box{
            box-shadow: 5px 9px 28px 0 rgba(212,212,212,1);
        }
        .blog-box{
            box-shadow: 5px 9px 28px 0 rgba(212,212,212,1) !important;
        }
    </style>
    <style>
        .pagination {
            justify-content: center!important;
        }

        .pagination li:first-child .page-link {
            margin-right: 0;
            border-top-right-radius: .25rem;
            border-bottom-right-radius: .25rem;
        }
        .pagination li:not(:disabled):not(.disabled) {
            cursor: pointer;
        }
        .pagination li {
            color: #03BAAD;
        }

        .pagination .active {
            background-color: #03BAAD;
        }
        .pagination li {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-right: -1px;
            line-height: 1.25;
            color: #000000;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        .main-navbar .nav-link {
            color: black;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-right: .255em;
            vertical-align: .255em;
            content: none;
            border-top: .3em solid;
            border-left: .3em solid transparent;
            border-bottom: 0;
            border-right: .3em solid transparent;
        }
        .post-banner:before {
            /* background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgb(77, 151, 31) 100%); */
        }
        .big-banner:before {
            position: absolute;
            content: '';
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            /* background: #1d98b4; */
            opacity: 0.75;
        }


    </style>

    <style>
        .dropbtn {
            background-color: #fff;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 125px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 5;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1;}

        .dropdown:hover .dropdown-content {display: block;}







    </style>
    <style>
        .footer-box .footer-box-social-media .nav-link{
            padding: 15px;
            padding-bottom: 20px;
        }
        .footer-box .footer-box-social-media ul li:first-child .nav-link{
            padding-right: 0px;
        }
        .footer-box .footer-box-social-media ul li:last-child .nav-link{
            padding-left: 0px;
        }
    </style>
    <style>
        .blog-box .icon {
            position: absolute;
            top: 30px;
            left: 20px;
        }
        .blog-box .icon a {
            display: block;
            text-align: center;
            border-radius: 4px;
            background: #dc241e;
            color: #fff;
            padding: 0.3rem 1rem;
        }
        .whatsapp_fixed {
            border-radius: 50%;
            bottom: 35pt;
            display: inline;
            height: 50pt;
            position: fixed;
            right: 50pt;
            top: auto;
            width: 50pt;
            z-index: 2147483646;
            font-size: 50px;
            background: white;
            text-align: center;
            padding: 0px;
            color: #3cb371;
            webkit-box-shadow: 0 0 15px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 0 15px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 0 15px rgba(0,0,0,0.2);
            -o-box-shadow: 0 0 15px rgba(0,0,0,0.2);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        @media (max-width: 767.98px) {
            .banner .row .img-banner{
                display: none;
            }
        }
        .navbar-box{
            border-color: #03BAAD;
        }
        .main-navbar .nav-link:hover{
            background-color: #03BAAD;
        }
        .box:hover {
            box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.15);
        }
        .box:hover:after {
            background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgb(3, 186, 173) 100%);
        }
        .blog-page .blog-box-content .title {
            color: #000;
        }
        .box-report:hover {
            background: #03BAAD;
        }
        .box-report .box-report-content .title{
            color: #000;
        }
        .top-nav .nav .nav-link:hover, .top-nav .nav .nav-link:focus {
            background-color: #03BAAD;
        }
        .social-media .social-icon a:hover {
            color: #03BAAD;
        }
        .whatsapp_fixed{
            color: #03BAAD;
        }
        .title-section .title {
            color: #03BAAD;
        }
        .gallarys.videos {
            background: #03BAAD;
        }
        .nav-gallary .nav-item.show .nav-link, .nav-gallary .nav-link.active {
            color: #03BAAD;
        }
        .get-more:hover {
            color: #03BAAD;
        }
        .most-read .media-body .title {
            color: #03BAAD;
        }
        .blogs .bg-light h4 {
            color: #03BAAD;
        }
        .blogs .bg-light a {
            color: #03BAAD;
        }
        .blog-tags {
            border: 2px solid #03BAAD;
        }
        .text-primary {
            color: #03BAAD !important;
        }
        .blogs .bg-light.inverse {
            background: #03BAAD !important;
        }
        .most-read .media-body .title {
            color: #03BAAD;
        }
        .custom-form .btn, .custom-form .input-group-btn .btn {
            background: #03BAAD;
            border-color: #03BAAD;
        }
        .most-read .media-body .title {
            color: #000;
        }
        .most-read .media:hover .title {
            color: #03BAAD;
        }
        .shorturl {
            margin-top: 1rem;
            padding-right: 5px;
            direction: rtl;
            text-align: right;
            font-size: .7em;
            }
      .shorturl input {
          width: 183px;
          direction: ltr;
          padding: 5px 5px;
          margin-right: 5px;
          border: 1px solid #f3f3f3;
          text-align: left;
        }
        .logos .circle .stop img {
            width: 92px;
            height: 96px;
        }
        .logos {
            padding: .5rem 0;
        }
        .main-navbar .nav-link {
            padding: 1rem 5px;
        }
        @media (max-width: 767.98px) {
            .banner .row h1{
                padding-right: 0px;
                font-size: 20px;
            }
            .banner .row .head-banner{
                align-items: flex-end;
            }
            .banner .row .head-banner:after{
                background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(4,4,4,1) 100%);
            }
        }
        #_hj_feedback_container{
            display: none;
        }
    </style>

    <!-- Global site tag (gtag.js) - Google Analytics -->
        {!! $setting->google_analytics !!}

</head>
<body>
@include('katlo_front.katlo_fron_layout.header')
@yield('content')
@include('katlo_front.katlo_fron_layout.footer')

<div class="scroll-to-top"><i class="fas fa-angle-up"></i></div>
<a class="whatsapp_fixed" href="{{route('contactUs')}}" target="_blank" title="تواصل معنا"><i  style="font-size: 40px;" class="far fa-comments"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="{{asset('front_kotli/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front_kotli/assets/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
</body>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('37dd4dfea93c5fb1292c', {
        cluster: 'ap2',
        forceTLS: true
    });

    var channel = pusher.subscribe('post_publish');
    channel.bind('my-event', function(data) {
        if (window.Notification) {
            Notification.requestPermission()
                .then((permission) => {
                    if (Notification.permission === "granted") {
                       let notification =  new Notification('خبر جديد ', {
                            icon: 'https://kutla.ps/front_kotli/assets/img/logo.png',
                            body: data.message.title
                        });
                        notification.onclick = function() {
                            window.open('https://kutla.ps/post/'+data.message.id);
                        };
                    }
                });

        }
        console.log(data);
    });
    function GetClock(){
        var d=new Date();
        var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
        if(nyear<1000) nyear+=1900;
        var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

        if(nhour==0){ap=" AM";nhour=12;}
        else if(nhour<12){ap=" AM";}
        else if(nhour==12){ap=" PM";}
        else if(nhour>12){ap=" PM";nhour-=12;}

        if(nmin<=9) nmin="0"+nmin;
        if(nsec<=9) nsec="0"+nsec;

        document.getElementById('time').innerHTML=""+nhour+":"+nmin+":"+nsec+ap+"";
    }

    window.onload=function(){
        GetClock();
        setInterval(GetClock,1000);
    }

    var clipboard = new Clipboard(".input-clipboard");

</script>
@stack('js')
</html>