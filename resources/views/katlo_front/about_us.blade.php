@extends('katlo_front.katlo_fron_layout.master')
@section('title','من نحن')
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
                <div class="col-lg-8">
                    <div class="blogger-box">
                        {{--<div class="media">--}}
                            {{--<div class="media-pic">--}}
                                {{--<img src="{{asset('front_kotli/assets/img/logo.png')}}" class="img-fluid" alt="blogger-pic">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="blog-title">
                        <h3 class="text-primary">من نحن</h3>
                    </div>
                    <div class="blog-details">
                        {!! $setting->details !!}
                    </div>
                </div>
                <div class="col-lg-4 blogs">


                </div>
            </div>
        </div>
    </section>
@stop

