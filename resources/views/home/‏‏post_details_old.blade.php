@extends('home.main')

@section('content')
    <section class="section inner-page">
        <div class="container">
            <div class="news-single">
                <div class="section-header">
                    <h3 class="section-title"><a href="{{asset('news')}}">الأخبار</a><span class="sp">/</span><a href="{{url('categories/'.$post_details->Category->id)}}">{{$post_details->Category->name}}</a></h3>
                </div>
                <h1 class="inner-news-title">{{$post_details->title}}</h1>
                <section class="section main-ads-section">
                        @if($adv_setting[1]->adv_part_4==1)
                            <div class="row main-ads one-ads" data-layout="1">
                                <div class="col-xs-12">
                                    @if($adv_part_4 && $adv_part_4->iframe1)
                                        {!! $adv_part_4->iframe1 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv1)
                                        <a target="blank" href="{{asset($adv_part_4->url1)}}">
                                            <img src="{{asset($adv_part_4->image_adv1)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($adv_setting[1]->adv_part_4==2)
                            <div class="row main-ads two-ads" data-layout="2">
                                <div class="col-xs-12 col-sm-6">
                                    @if($adv_part_4 && $adv_part_4->iframe1)
                                        {!! $adv_part_4->iframe1 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv1)
                                        <a target="blank" href="{{asset($adv_part_4->url1)}}">
                                            <img src="{{asset($adv_part_4->image_adv1)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    @if($adv_part_4 && $adv_part_4->iframe2)
                                        {!! $adv_part_4->iframe2 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv2)
                                        <a target="blank" href="{{asset($adv_part_4->url2)}}">
                                            <img src="{{asset($adv_part_4->image_adv2)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($adv_setting[1]->adv_part_4==3)
                            <div class="row main-ads three-ads"  data-layout="3">
                                <div class="col-xs-12 col-sm-4">
                                    @if($adv_part_4 && $adv_part_4->iframe1)
                                        {!! $adv_part_4->iframe1 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv1)
                                        <a target="blank" href="{{asset($adv_part_4->url1)}}">
                                            <img src="{{asset($adv_part_4->image_adv1)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    @if($adv_part_4 && $adv_part_4->iframe2)
                                        {!! $adv_part_4->iframe2 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv2)
                                        <a target="blank" href="{{asset($adv_part_4->url2)}}">
                                            <img src="{{asset($adv_part_4->image_adv2)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    @if($adv_part_4 && $adv_part_4->iframe3)
                                        {!! $adv_part_4->iframe3 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv3)
                                        <a target="blank" href="{{asset($adv_part_4->url3)}}">
                                            <img src="{{asset($adv_part_4->image_adv3)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($adv_setting[1]->adv_part_4==4)
                            <div class="row main-ads four-ads"  data-layout="4">
                                <div class="col-xs-12 col-sm-3">
                                    @if($adv_part_4 && $adv_part_4->iframe1)
                                        {!! $adv_part_4->iframe1 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv1)
                                        <a target="blank" href="{{asset($adv_part_4->url1)}}">
                                            <img src="{{asset($adv_part_4->image_adv1)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    @if($adv_part_4 && $adv_part_4->iframe2)
                                        {!! $adv_part_4->iframe2 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv2)
                                        <a target="blank" href="{{asset($adv_part_4->url2)}}">
                                            <img src="{{asset($adv_part_4->image_adv2)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    @if($adv_part_4 && $adv_part_4->iframe3)
                                        {!! $adv_part_4->iframe3 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv3)
                                        <a target="blank" href="{{asset($adv_part_4->url3)}}">
                                            <img src="{{asset($adv_part_4->image_adv3)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    @if($adv_part_4 && $adv_part_4->iframe4)
                                        {!! $adv_part_4->iframe4 !!}
                                    @elseif($adv_part_4 && $adv_part_4->image_adv4)
                                        <a target="blank" href="{{asset($adv_part_4->url4)}}">
                                            <img src="{{asset($adv_part_4->image_adv4)}}" /></a>
                                    @else
                                        <a href="#">
                                            <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                    @endif
                                </div>
                            </div>
                        @endif

                </section>

                <div class="row inner-news-row">
                    <div class="col-xs-12 col-md-8">
                        @if($html_face)
                            {!! $html_face !!}
                        @else
                            @if($post_details->youtube)
                                <?php
                                $you_tube=explode('v=',$post_details->youtube);
                                ?>
                                <iframe class="embed-responsive-item" width="770" height="460" autop src="http://www.youtube.com/embed/{{$you_tube[1]}}?autoplay=1&rel=0&#038;showinfo=0" frameborder="0" allowfullscreen></iframe>
                            @else
                                @if($post_details->Video)
                                    <div class="post-thumb-block">
                                        @if($post_details->Video->file_name)
                                            <video width="770" height="460" autoplay controls>
                                                <source src="{{asset($post_details->Video->file_name)}}" type="video/mp4">
                                                Your browser does not support HTML5 video.
                                            </video>
                                        @else
                                            @if($post_details->Video->youtube_link || $post_details->youtube)
                                                <?php
                                                if($post_details->youtube){
                                                    $yy=$post_details->youtube;
                                                }else{
                                                    $yy=$post_details->Video->youtube_link;
                                                }
                                                $you_tube=explode('v=',$yy);
                                                ?>
                                                <iframe class="embed-responsive-item" width="770" height="460" autop src="http://www.youtube.com/embed/{{$you_tube[1]}}?autoplay=1&rel=0&#038;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                            @endif
                                        @endif
                                    </div>
                                @else
                                    @if($post_details->PostPhoto->count()>0)
                                        <div class="owl-carousel post-thumb-block" id="post-image-slider">

                                            @foreach($post_details->PostPhoto as $photo)
                                                @if($photo->photo)  <div class="item">
                                                    <img  src="{{asset($photo->photo->file_name)}}" alt="" class="img-responsive inner-news-img">
                                                </div>@endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="post-thumb-block">
                                            <img src="{{asset($post_details->photo->thump770)}}" alt="" class="img-responsive inner-news-img">
                                        </div>
                                    @endif
                                @endif
                            @endif
                        @endif
                        <div class="inner-news-time">
                            <span><i class="fa fa-calendar-o"></i>{{returnDateFormay($post_details->published_at)}}</span>
                            <span><i class="fa fa-clock-o"></i> {{returnTimeFormay($post_details->published_at)}} بتوقيت القدس المحتلة </span>
                        </div>
                        <div class="row source-share">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                {{--<div class="source-item">--}}
                                    {{--<span class="source-title">مصدر الصورة</span>--}}
                                    {{--<span class="source-content">وكالة الأنباء الأمريكية</span>--}}
                                {{--</div>--}}
                                @if($post_details->source)
                                <div class="source-item">
                                    <span class="source-title">مصدر الخبر</span>
                                    <span class="source-content">{{$post_details->source}}</span>
                                </div>
                                    @endif
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="news-share text-left">
                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                    <a class="bookmark" href="#"><i class="fa fa-bookmark"></i></a>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                    <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                                    <a class="google" href="#"><i class="fa fa-google-plus"></i></a>
                                    <a class="print" href="#"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="inner-news-content" style="color: black;">
                            @if($adv_part_7 && $adv_part_7->iframe4)
                                {!! $adv_part_7->iframe4 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv4)
                                <a target="blank" href="{{asset($adv_part_7->url4)}}" class="inner-content-ads">
                                    <img src="{{asset($adv_part_7->image_adv4)}}" /></a>
                            @else
                                <a href="#" class="inner-content-ads">
                                    <img src="{{asset('homeStyle/')}}/images/inner-content-ads.png" /></a>
                            @endif
                            {!! $news_details_line !!}
                        </div>
                            <section class="section main-ads-section" style="margin-top: 20px;">
                                @if($adv_setting[1]->adv_part_6==1)
                                    <div class="row main-ads one-ads" data-layout="1">
                                        <div class="col-xs-12">
                                            @if($adv_part_6 && $adv_part_6->iframe1)
                                                {!! $adv_part_6->iframe1 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv1)
                                                <a target="blank" href="{{asset($adv_part_6->url1)}}">
                                                    <img src="{{asset($adv_part_6->image_adv1)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_6==2)
                                    <div class="row main-ads two-ads" data-layout="2">
                                        <div class="col-xs-12 col-sm-6">
                                            @if($adv_part_6 && $adv_part_6->iframe1)
                                                {!! $adv_part_6->iframe1 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv1)
                                                <a target="blank" href="{{asset($adv_part_6->url1)}}">
                                                    <img src="{{asset($adv_part_6->image_adv1)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            @if($adv_part_6 && $adv_part_6->iframe2)
                                                {!! $adv_part_6->iframe2 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv2)
                                                <a target="blank" href="{{asset($adv_part_6->url2)}}">
                                                    <img src="{{asset($adv_part_6->image_adv2)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_6==3)
                                    <div class="row main-ads three-ads"  data-layout="3">
                                        <div class="col-xs-12 col-sm-4">
                                            @if($adv_part_6 && $adv_part_6->iframe1)
                                                {!! $adv_part_6->iframe1 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv1)
                                                <a target="blank" href="{{asset($adv_part_6->url1)}}">
                                                    <img src="{{asset($adv_part_6->image_adv1)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            @if($adv_part_6 && $adv_part_6->iframe2)
                                                {!! $adv_part_6->iframe2 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv2)
                                                <a target="blank" href="{{asset($adv_part_6->url2)}}">
                                                    <img src="{{asset($adv_part_6->image_adv2)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            @if($adv_part_6 && $adv_part_6->iframe3)
                                                {!! $adv_part_6->iframe3 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv3)
                                                <a target="blank" href="{{asset($adv_part_6->url3)}}">
                                                    <img src="{{asset($adv_part_6->image_adv3)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if($adv_setting[1]->adv_part_6==4)
                                    <div class="row main-ads four-ads"  data-layout="4">
                                        <div class="col-xs-12 col-sm-3">
                                            @if($adv_part_6 && $adv_part_6->iframe1)
                                                {!! $adv_part_6->iframe1 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv1)
                                                <a target="blank" href="{{asset($adv_part_6->url1)}}">
                                                    <img src="{{asset($adv_part_6->image_adv1)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            @if($adv_part_6 && $adv_part_6->iframe2)
                                                {!! $adv_part_6->iframe2 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv2)
                                                <a target="blank" href="{{asset($adv_part_6->url2)}}">
                                                    <img src="{{asset($adv_part_6->image_adv2)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            @if($adv_part_6 && $adv_part_6->iframe3)
                                                {!! $adv_part_6->iframe3 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv3)
                                                <a target="blank" href="{{asset($adv_part_6->url3)}}">
                                                    <img src="{{asset($adv_part_6->image_adv3)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            @if($adv_part_6 && $adv_part_6->iframe4)
                                                {!! $adv_part_6->iframe4 !!}
                                            @elseif($adv_part_6 && $adv_part_6->image_adv4)
                                                <a target="blank" href="{{asset($adv_part_6->url4)}}">
                                                    <img src="{{asset($adv_part_6->image_adv4)}}" /></a>
                                            @else
                                                <a href="#">
                                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </section>
                        <div class="news-reaction">
                            <h3 class="reaction-title">ضع شعورك بهذا الخبر</h3>
                            <div class="reaction-items">
                                <div class="reaction-item"><a href="#"><img src="{{asset('homeStyle/')}}/images/like.png" /></a></div>
                                <div class="reaction-item"><a href="#"><img src="{{asset('homeStyle/')}}/images/haha.png" /><span>88</span></a></div>
                                <div class="reaction-item"><a href="#"><img src="{{asset('homeStyle/')}}/images/wow.png" /></a></div>
                                <div class="reaction-item"><a href="#"><img src="{{asset('homeStyle/')}}/images/sad.png" /></a></div>
                                <div class="reaction-item"><a href="#"><img src="{{asset('homeStyle/')}}/images/angry.png" /></a></div>
                            </div>
                        </div>
                        <div class="news-tags">
                            @foreach($post_tags as $tag)
                            <a href="{{asset('tags/'.$tag->tag_id.'/'.(implode('-',explode(' ',$tag->tag->name))))}}">{{$tag->tag->name}}"></a>
                            @endforeach
                        </div>
                            <div class="content">
                                <span style="position: absolute; margin: 0.7% 0.7%;">رابط مختصر</span>
                                <input type="text" style="text-align: left" class="disabled form-control not-empty" readonly="" onclick="this.select();" value="{{ url('post/'.$post_details->id) }}">
                            </div>
                        <div class="related-news">
                            <div class="section-header">
                                <h3 class="section-title">مواضيع ذات صلة</h3>
                            </div>
                            <div class="row">
                                @foreach($relatedPosts_query as $post)
                                <div class="col-xs-12 col-sm-4">
                                    <article class="article-slider-item">
                                        <div class="article-img">
                                            <img src="{{asset($post->photo->thump)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                        </div>
                                        <a href="{{ url('post/'.$post->id.'/'.(implode('-',explode(' ',$post->title)))) }}" >@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>

                                    </article>
                                </div>
                               @endforeach
                            </div>
                        </div>
                        <div class="comments">
                            <div class="section-header">
                                <h3 class="section-title">التعليقات</h3>
                            </div>

                            <div class="comments-items">
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=320179224996912&autoLogAppEvents=1';
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-comments" data-href="{{asset('post/'.$post_details->id)}}" data-width="749" data-numposts="10"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
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
                        <div class="side-item">
                            <div class="section-header">
                                <h3 class="section-title"><a href="{{asset('news/chosen')}}">إخترنا لكم</a></h3>
                            </div>
                            @foreach($chosen as $post)
                            <article class="main-cat-news-item">
                                <img  src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />

                                <div class="main-cat-news-content">
                                    <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                    <a  href="{{ url('post/'.$post->id.'/'.(implode('-',explode(' ',$post->title)))) }}">
                                        @if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif {{$post->title}}
                                    </a>
                                </div>
                            </article>
                                @endforeach

                        </div>
                        <div class="side-item">
                            <div class="section-header">
                                <h3 class="section-title">إقرأ أيضاً</h3>
                            </div>
                            @foreach($relatedPosts_cat as $post)
                            <article class="article-slider-item">
                                <div class="article-img">
                                    <img  src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                </div>
                                <a  href="{{ url('post/'.$post->id.'/'.(implode('-',explode(' ',$post->title)))) }}">
                                    @if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif {{$post->title}}
                                </a>
                            </article>
                                @endforeach

                        </div>
                        <div class="side-item">
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
                        </div>
                        <div class="side-item">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection