@extends('katlo_front.katlo_fron_layout.master')
@section('title','اتصل بنا')
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
@push('css')
    <style>
        .contact-info {
            border-right: 1px solid #b4b4b4;
        }

        .contact-info ul {
            padding-right: 15px;
            list-style: none;
            color: #535353;
        }

        .contact-info ul li {
            margin-bottom: 10px;
        }

        .contact-info ul li a {
            overflow: hidden;
            display: block;
            color: #808080;
        }

        .contact-info ul li a i {
            color: #009241;
            margin-left: 10px;
        }
    </style>
@endpush
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12 blog-title">
                    <h3 class="text-primary">اتصل بنا</h3>
                </div>

                <div class="col-lg-6">
                    <div class="custom-form">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="post" action="{{route('contactUs')}}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group ">
                                <input type="text" required class="form-control" placeholder="الاسم بالكامل" name="name">
                                @if($errors->has('name'))
                                    <span class="help-block">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <input type="email" required class="form-control" placeholder="البريد الالكرتوني" name="email">
                                @if($errors->has('email'))
                                    <span class="help-block">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <input type="tel" required class="form-control" placeholder="الهاتف" name="news_title">
                                @if($errors->has('news_title'))
                                    <span class="help-block">{{$errors->first('news_title')}}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <textarea class="form-control" required rows="8" placeholder="نص الرسالة"
                                          name="details"></textarea>
                                @if($errors->has('details'))
                                    <span class="help-block">{{$errors->first('details')}}</span>
                                @endif
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary mt-3"> ارسال</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{--<div class="col-lg-6">--}}
                    {{--<div class="contact-info">--}}
                        {{--<ul>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fas fa-map-marker-alt"></i> عنوان السكرتارية الثقافية :فلسطين - بيرزيت--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fas fa-mobile-alt"></i> <span class="mt-2">0594461556</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fas fa-print"></i> <span class="mt-2">+2466666</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </section>

@stop

