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
    <title> @yield('title')</title>
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
    @stack('meta')
    <link rel="stylesheet" href="{{asset('new_front_kotla/assets/css/plugin.min.css')}}" />
    <link rel="stylesheet" href="{{asset('new_front_kotla/assets/css/main.css')}}" />
    <link rel="shortcut icon" href="{{asset('new_front_kotla/assets/images/logo.png')}}" type="image/x-icon" >
    @stack('css')
</head>
<body>
<!-- begin:: Page -->
<div class="main-wrapper">
    <div class="overlay-site"></div>
    <div class="loader-page"><span></span><span></span></div>
    <div class="search-box">
        <div class="container">
            <div class="search-container">
                <form class="search-form" >
                    <label class="d-flex align-items-center h-100 w-100 m-0" for="searchInput">
                        <input id="search" name ='search' type="text" placeholder="ابحث هنا"  />
                    </label>
                </form>
                <div class="search-toggle" onclick="searchFunction(this)"  data-type="search"><i class="fas fa-arrow-left"></i></div>
            </div>
        </div>
    </div>
    <!-- begin:: Header -->
    <header class="main-header">
        @include('new_kotla_front.new_kotla_front_layout.header')
    </header>
@yield('content')
    <!-- start:: footer -->
    <footer class="main-footer">
        @include('new_kotla_front.new_kotla_front_layout.footer')
    </footer>
    <!-- end:: footer -->
</div>
<!-- end:: Page -->

<script src="{{asset('new_front_kotla/assets/js/script.min.js')}}"></script>
<script src="{{asset('new_front_kotla/assets/js/function.js')}}"></script>
<script>
    function searchFunction(e) {

        let field_name= $(e).data('type');
        let field_value;

        if(field_name =='sort'){
            field_value= $(e).data('val');
        }else{
            field_value= $('#'+field_name).val();
        }

        let url = 'https://kutla.ps/new/allNews';
        let url_fileter = new URL(url);
        let c = url_fileter.searchParams.get(field_name);

        var queryParameters = {}, queryString = location.search.substring(1),
            re = /([^&=]+)=([^&]*)/g, m;


        while (m = re.exec(queryString)) {
            queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
        }

        queryParameters[field_name] = field_value;

        if(!field_value){
            delete queryParameters[field_name];
            //let index = queryParameters.indexOf();
            //console.log(index);
        }
        location.search = $.param(queryParameters);
    }
</script>
@stack('js')
</body>
</html>
