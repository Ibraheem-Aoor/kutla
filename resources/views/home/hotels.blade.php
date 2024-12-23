@extends('home.main')

@section('content')

    <section class="section inner-page">
        <div class="container">
            <div class="news-single">
                <div class="row ramallah-hotels">
                    <div class="col-xs-12 col-md-8">
                        <div class="section-header">
                            <h3 class="section-title">فنادق رام الله</h3>
                        </div>
                        <article class="main-cat-news-item hotel-main-item">
                            <img src="{{asset('homeStyle/images/hotel.png')}}">
                            <div class="main-cat-news-content">
                                <a href="#">ارقام الفنادق في رام الله و البيرة</a>
                                <div class="hotel-time">
                                    {{--<span><i class="fa fa-calendar-o"></i> الإثنين, 16 أكتوبر 2018</span>--}}
                                    {{--<span><i class="fa fa-clock-o"></i> 04:25 م</span>--}}
                                </div>
                            </div>
                        </article>


                        <div class="row hotel-items">
                            <?php $x=0;?>
                            @foreach($hotels as $hotel)
                            <div class="col-xs-12 col-sm-6">
                                <div class="hotel-item">
                                    <div class="hotel-name">{{$hotel->name}}</div>
                                    <div class="hotel-details">
                                        <i class="fa fa-map-marker"></i>
                                        <span>{{$hotel->address}}</span>
                                    </div>
                                    <img src="{{asset($hotel->photo->thump)}}" class="hotel-code" style="width: 63px;height: 63px;" />
                                    <div class="hotel-details">
                                        <i class="fa fa-mobile"></i>
                                        <span>{{$hotel->mobile}}</span>
                                    </div>

                                    <div class="hotel-details">
                                        <i class="fa fa-phone"></i>
                                        <span>{{$hotel->phone}}</span>
                                    </div>
                                    <div class="hotel-details">
                                        <i class="fa fa-facebook"></i>
                                        <a target="_blank" href="{{$hotel->facebook}}"><span>Facebook</span></a>
                                    </div>
                                    <div class="hotel-details">
                                        <i class="fa fa-globe"></i>
                                        <a target="_blank" href="{{$hotel->site}}"><span>{{$hotel->site}}</span></a>
                                    </div>
                                    {{--<div class="hotel-details">--}}
                                        {{--<i class="fa fa-whatsapp"></i>--}}
                                        {{--<a href="{{$hotel->whatsapp}}" target="_blank" data-toggle="tooltip" data-placement="right" title="{{$hotel->whatsapp}}"><span>{{$hotel->whatsapp}}</span></a>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                                @if($x==0)
                                        @if($adv_setting[2]->adv_part_4!=5)
                            <div class="col-xs-12 col-sm-6">
                                @if($adv_part_4 && $adv_part_4->iframe1)
                                    {!! $adv_part_4->iframe1 !!}
                                @elseif($adv_part_4 && $adv_part_4->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_4->url1)}}" class="hotel-ads">
                                        <img src="{{asset($adv_part_4->image_adv1)}}" /></a>
                                @else
                                    <a class="hotel-ads" href="#"><img src="{{asset('homeStyle')}}/images/hotel-ads.png" class="img-responsive" /></a>
                                @endif
                            </div>
                                    @endif
                                    @endif
                                <?php $x++;?>
                            @endforeach
                        </div>

                        {{--<div class="related-news">--}}
                            {{--<div class="section-header">--}}
                                {{--<h3 class="section-title">مواضيع ذات صلة</h3>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-xs-12 col-sm-4">--}}
                                    {{--<article class="article-slider-item">--}}
                                        {{--<div class="article-img">--}}
                                            {{--<img src="images/news10.png">--}}
                                        {{--</div>--}}
                                        {{--<a href="#">دراسة حديثة: الشوكلاتة تحمي جسم الإنسان من الإصابة الجلطات</a>--}}
                                    {{--</article>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-12 col-sm-4">--}}
                                    {{--<article class="article-slider-item">--}}
                                        {{--<div class="article-img">--}}
                                            {{--<img src="images/news10.png">--}}
                                        {{--</div>--}}
                                        {{--<a href="#">دراسة حديثة: الشوكلاتة تحمي جسم الإنسان من الإصابة الجلطات</a>--}}
                                    {{--</article>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-12 col-sm-4">--}}
                                    {{--<article class="article-slider-item">--}}
                                        {{--<div class="article-img">--}}
                                            {{--<img src="images/news10.png">--}}
                                        {{--</div>--}}
                                        {{--<a href="#">دراسة حديثة: الشوكلاتة تحمي جسم الإنسان من الإصابة الجلطات</a>--}}
                                    {{--</article>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="comments">--}}
                            {{--<div class="section-header">--}}
                                {{--<h3 class="section-title">أضف تعليقاً</h3>--}}
                                {{--<span class="table-item-header comments-count">(69)</span>--}}
                            {{--</div>--}}
                            {{--<form class="comment-form">--}}
                                {{--<input type="text" placeholder="أكتب تعليق الخاص بك" />--}}
                                {{--<button type="submit" disabled>نشر</button>--}}
                            {{--</form>--}}
                            {{--<div class="comments-items">--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="comment-item">--}}
                                    {{--<img src="images/user.png" />--}}
                                    {{--<div class="comment-content">--}}
                                        {{--<span class="comment-time">منذ ساعتين</span>--}}
                                        {{--<div class="comment-username">عبد الرحمن ظاهر</div>--}}
                                        {{--<div class="comment-text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-xs-12 col-md-4">
                        @if($adv_setting[2]->adv_part_1!=5)
                        @if($adv_setting[1]->adv_part_1==1)
                            <div class="main-news-ads main-ads one-ads" data-layout="1">

                                @if($adv_part_1_1 && $adv_part_1_1->iframe1)
                                    {!! $adv_part_1_1->iframe1 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_1_1->url1)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv1)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                                @endif
                            </div>
                        @endif
                        @if($adv_setting[1]->adv_part_1==2)
                            <div class="main-news-ads main-ads two-ads"  data-layout="2">
                                @if($adv_part_1_1 && $adv_part_1_1->iframe1)
                                    {!! $adv_part_1_1->iframe1 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_1_1->url1)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv1)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                @endif
                                @if($adv_part_1_1 && $adv_part_1_1->iframe2)
                                    {!! $adv_part_1_1->iframe2 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv2)
                                    <a target="blank" href="{{asset($adv_part_1_1->url2)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv2)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                @endif
                            </div>
                        @endif
                        @if($adv_setting[1]->adv_part_1==3)
                            <div class="main-news-ads main-ads three-ads"  data-layout="3">
                                @if($adv_part_1_1 && $adv_part_1_1->iframe1)
                                    {!! $adv_part_1_1->iframe1 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_1_1->url1)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv1)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                @endif
                                @if($adv_part_1_1 && $adv_part_1_1->iframe2)
                                    {!! $adv_part_1_1->iframe2 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv2)
                                    <a target="blank" href="{{asset($adv_part_1_1->url2)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv2)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                @endif
                                @if($adv_part_1_1 && $adv_part_1_1->iframe3)
                                    {!! $adv_part_1_1->iframe3 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv3)
                                    <a target="blank" href="{{asset($adv_part_1_1->url3)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv3)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                @endif
                            </div>
                        @endif
                        @if($adv_setting[1]->adv_part_1==4)
                            <div class="main-news-ads main-ads four-ads"  data-layout="4">
                                @if($adv_part_1_1 && $adv_part_1_1->iframe1)
                                    {!! $adv_part_1_1->iframe1 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_1_1->url1)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv1)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                @endif
                                @if($adv_part_1_1 && $adv_part_1_1->iframe2)
                                    {!! $adv_part_1_1->iframe1 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv2)
                                    <a target="blank" href="{{asset($adv_part_1_1->url2)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv2)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                @endif
                                @if($adv_part_1_1 && $adv_part_1_1->iframe3)
                                    {!! $adv_part_1_1->iframe3 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv3)
                                    <a target="blank" href="{{asset($adv_part_1_1->url3)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv3)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                @endif
                                @if($adv_part_1_1 && $adv_part_1_1->iframe4)
                                    {!! $adv_part_1_1->iframe4 !!}
                                @elseif($adv_part_1_1 && $adv_part_1_1->image_adv4)
                                    <a target="blank" href="{{asset($adv_part_1_1->url4)}}">
                                        <img src="{{asset($adv_part_1_1->image_adv4)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                @endif
                            </div>
                        @endif
                        @endif
                        <div class="side-item">
                            <div class="section-header">
                                <h3 class="section-title"><a href="{{asset('news/chosen')}}">إخترنا لكم</a></h3>
                            </div>
                            @foreach($chosen as $post)
                                <article class="main-cat-news-item">
                                    <a href="{{ return_post_link($post) }}"  >
                                    <img  src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                    </a>
                                    <div class="main-cat-news-content">
                                        <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                        <a  href="{{ url('post/'.$post->id.'/'.(implode('-',explode(' ',$post->title)))) }}">
                                            @if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif {{$post->title}}
                                        </a>
                                    </div>
                                </article>
                            @endforeach

                        </div>
                            @if($adv_setting[2]->adv_part_2!=5)<div class="side-item">
                                @if($adv_setting[1]->adv_part_2==1)
                                    <div class="main-news-ads main-ads one-ads" data-layout="1">

                                        @if($adv_part_2 && $adv_part_2->iframe1)
                                            {!! $adv_part_2->iframe1 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv1)
                                            <a target="blank" href="{{asset($adv_part_2->url1)}}">
                                                <img src="{{asset($adv_part_2->image_adv1)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                                        @endif
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_2==2)
                                    <div class="main-news-ads main-ads two-ads"  data-layout="2">
                                        @if($adv_part_2 && $adv_part_2->iframe1)
                                            {!! $adv_part_2->iframe1 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv1)
                                            <a target="blank" href="{{asset($adv_part_2->url1)}}">
                                                <img src="{{asset($adv_part_2->image_adv1)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                        @endif
                                        @if($adv_part_2 && $adv_part_2->iframe2)
                                            {!! $adv_part_2->iframe2 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv2)
                                            <a target="blank" href="{{asset($adv_part_2->url2)}}">
                                                <img src="{{asset($adv_part_2->image_adv2)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                        @endif
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_2==3)
                                    <div class="main-news-ads main-ads three-ads"  data-layout="3">
                                        @if($adv_part_2 && $adv_part_2->iframe1)
                                            {!! $adv_part_2->iframe1 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv1)
                                            <a target="blank" href="{{asset($adv_part_2->url1)}}">
                                                <img src="{{asset($adv_part_2->image_adv1)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                        @endif
                                        @if($adv_part_2 && $adv_part_2->iframe2)
                                            {!! $adv_part_2->iframe2 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv2)
                                            <a target="blank" href="{{asset($adv_part_2->url2)}}">
                                                <img src="{{asset($adv_part_2->image_adv2)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                        @endif
                                        @if($adv_part_2 && $adv_part_2->iframe3)
                                            {!! $adv_part_2->iframe3 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv3)
                                            <a target="blank" href="{{asset($adv_part_2->url3)}}">
                                                <img src="{{asset($adv_part_2->image_adv3)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                        @endif
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_2==4)
                                    <div class="main-news-ads main-ads four-ads"  data-layout="4">
                                        @if($adv_part_2 && $adv_part_2->iframe1)
                                            {!! $adv_part_2->iframe1 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv1)
                                            <a target="blank" href="{{asset($adv_part_2->url1)}}">
                                                <img src="{{asset($adv_part_2->image_adv1)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                        @endif
                                        @if($adv_part_2 && $adv_part_2->iframe2)
                                            {!! $adv_part_2->iframe1 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv2)
                                            <a target="blank" href="{{asset($adv_part_2->url2)}}">
                                                <img src="{{asset($adv_part_2->image_adv2)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                        @endif
                                        @if($adv_part_2 && $adv_part_2->iframe3)
                                            {!! $adv_part_2->iframe3 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv3)
                                            <a target="blank" href="{{asset($adv_part_2->url3)}}">
                                                <img src="{{asset($adv_part_2->image_adv3)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                        @endif
                                        @if($adv_part_2 && $adv_part_2->iframe4)
                                            {!! $adv_part_2->iframe4 !!}
                                        @elseif($adv_part_2 && $adv_part_2->image_adv4)
                                            <a target="blank" href="{{asset($adv_part_2->url4)}}">
                                                <img src="{{asset($adv_part_2->image_adv4)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                        @endif
                                    </div>
                                @endif
                            </div>@endif
                            @if($adv_setting[2]->adv_part_3!=5) <div class="side-item">
                                @if($adv_setting[1]->adv_part_3==1)
                                    <div class="main-news-ads main-ads one-ads" data-layout="1">

                                        @if($adv_part_3 && $adv_part_3->iframe1)
                                            {!! $adv_part_3->iframe1 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv1)
                                            <a target="blank" href="{{asset($adv_part_3->url1)}}">
                                                <img src="{{asset($adv_part_3->image_adv1)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                                        @endif
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_3==2)
                                    <div class="main-news-ads main-ads two-ads"  data-layout="2">
                                        @if($adv_part_3 && $adv_part_3->iframe1)
                                            {!! $adv_part_3->iframe1 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv1)
                                            <a target="blank" href="{{asset($adv_part_3->url1)}}">
                                                <img src="{{asset($adv_part_3->image_adv1)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                        @endif
                                        @if($adv_part_3 && $adv_part_3->iframe2)
                                            {!! $adv_part_3->iframe2 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv2)
                                            <a target="blank" href="{{asset($adv_part_3->url2)}}">
                                                <img src="{{asset($adv_part_3->image_adv2)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                        @endif
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_3==3)
                                    <div class="main-news-ads main-ads three-ads"  data-layout="3">
                                        @if($adv_part_3 && $adv_part_3->iframe1)
                                            {!! $adv_part_3->iframe1 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv1)
                                            <a target="blank" href="{{asset($adv_part_3->url1)}}">
                                                <img src="{{asset($adv_part_3->image_adv1)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                        @endif
                                        @if($adv_part_3 && $adv_part_3->iframe2)
                                            {!! $adv_part_3->iframe2 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv2)
                                            <a target="blank" href="{{asset($adv_part_3->url2)}}">
                                                <img src="{{asset($adv_part_3->image_adv2)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                        @endif
                                        @if($adv_part_3 && $adv_part_3->iframe3)
                                            {!! $adv_part_3->iframe3 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv3)
                                            <a target="blank" href="{{asset($adv_part_3->url3)}}">
                                                <img src="{{asset($adv_part_3->image_adv3)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                        @endif
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_3==4)
                                    <div class="main-news-ads main-ads four-ads"  data-layout="4">
                                        @if($adv_part_3 && $adv_part_3->iframe1)
                                            {!! $adv_part_3->iframe1 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv1)
                                            <a target="blank" href="{{asset($adv_part_3->url1)}}">
                                                <img src="{{asset($adv_part_3->image_adv1)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                        @endif
                                        @if($adv_part_3 && $adv_part_3->iframe2)
                                            {!! $adv_part_3->iframe1 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv2)
                                            <a target="blank" href="{{asset($adv_part_3->url2)}}">
                                                <img src="{{asset($adv_part_3->image_adv2)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                        @endif
                                        @if($adv_part_3 && $adv_part_3->iframe3)
                                            {!! $adv_part_3->iframe3 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv3)
                                            <a target="blank" href="{{asset($adv_part_3->url3)}}">
                                                <img src="{{asset($adv_part_3->image_adv3)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                        @endif
                                        @if($adv_part_3 && $adv_part_3->iframe4)
                                            {!! $adv_part_3->iframe4 !!}
                                        @elseif($adv_part_3 && $adv_part_3->image_adv4)
                                            <a target="blank" href="{{asset($adv_part_3->url4)}}">
                                                <img src="{{asset($adv_part_3->image_adv4)}}" /></a>
                                        @else
                                            <a href="#">
                                                <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                        @endif
                                    </div>
                                @endif
                            </div>@endif
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection