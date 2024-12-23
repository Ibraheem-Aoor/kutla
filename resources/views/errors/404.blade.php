@extends('new_kotla_front.new_kotla_front_layout.master')

@section('title','الصفحه غير موجودة ')
@section('content')
    {{--<section class="big-banner post-banner mb-0" style="background-image: url({{asset($setting->photo->thump770)}})">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-lg-12">--}}
    {{--<h1 class="title">من نحن</h1>--}}
    {{--<nav aria-label="breadcrumb">--}}
    {{--<ol class="breadcrumb">--}}
    {{--<li class="breadcrumb-item"><a href="/">الرئيسية</a></li>--}}
    {{--<li class="breadcrumb-item active" aria-current="page">من نحن</li>--}}
    {{--</ol>--}}
    {{--</nav>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}

    <section class="blog-page">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="content-rightPage">
                            <div>
                                <img src="{{asset('img/404.jpg')}}" style="margin-top: 3%;
                margin-right: 35%;">
                            </div>
                            <div class="about-pageontent" style="text-align: center;
                font-size: 17px;
                font-weight: 700;
                margin-top: 26px;">
                                عذرا الصفحة المطلوبة غير موجودة !
                            </div>
                        </div>
                    </div>


                </div>
            </div>
    </section>
@stop

