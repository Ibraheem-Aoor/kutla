@php
    $w_static = yahoo_weather()->high;

$current_route=\Request::route()?->getName();



@endphp
<div class="container">
    <div class="d-flex align-items-center">
        <div class="logo ms-lg-5">
            <a href="{{route('front.new_index')}}"><img src="{{asset('new_front_kotla/assets/images/logo.png')}}" alt="" /></a>
        </div>
        <div class="menu--mobile">
            <div class="menu-container d-lg-none">
                <div class="btn-close-header-mobile justify-content-end"><i class="fas fa-times"></i></div>
            </div>
            <div class="menu-container col mx-lg-5">
                <ul class="main-menu list-main-menu d-lg-flex justify-content-between">
                    <li class="menu_item"><a  target="_blank" href="{{route('new.allNews')}}" class="menu_link {{\Route::currentRouteNamed( 'new.allNews' )? 'active': ''}}" >الأخبار</a></li>
                    <li class="menu_item"><a href="{{route('front.new_index')}}#section--5"  class="menu_link {{\Route::currentRouteNamed( 'new.new_category_show','التقارير' )? 'active': ''}}" >التقارير</a></li>
                    <li class="menu_item"><a href="{{route('front.new_index')}}#section--3" class="menu_link {{\Route::currentRouteNamed( 'new.new_category_show','بيانات' )? 'active': ''}}">بيانات</a></li>
                    <li class="menu_item"><a class="menu_link" href="{{route('front.new_index')}}#section--2" >معرض الوسائط </a></li>
                    <li class="menu_item"><a  href="{{route('new.aboutUs')}}" class="menu_link {{Route::currentRouteNamed( 'new.aboutUs' )? 'active': ''}}">من نحن </a></li>
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