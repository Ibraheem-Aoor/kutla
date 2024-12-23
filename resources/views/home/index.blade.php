@extends('home.main')

@section('content')
    @if($adv_setting[0]->adv_part_14!=5)
        @if($adv_part_14 && $adv_part_14->iframe1)
          <div> {!! $adv_part_14->iframe1 !!}</div>
        @elseif($adv_part_14 && $adv_part_14->image_adv1)
            <a target="_blank" href="{{asset($adv_part_14->url1)}}">
                <img src="{{asset($adv_part_14->image_adv1)}}" style="width :100%" /></a>
        @else
            <div class="bluepages-ads">
                <a href="#" class="close-ad"><i class="fa fa-times"></i></a>
                <div class="container">

                    <div class="bluepages">
                        <div class="row">
                            <div class="col-xs-12 col-sm-9">
                                <img src="{{asset('homeStyle')}}/images/bluepages.png" />
                                <span>إشترك في خدمة يلو بيجز واستكشف أفضل العروض المتاحة</span>
                            </div>
                            <div class="col-xs-12 col-sm-3 text-left">
                                <a href="#">إشتراك</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        @endif
    @endif
    <section class="section main-news-section">
        <div class="container">
            <div class="main-news row">
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <article class="main-news-item">
                        <a href="{{ return_post_link($post_position_1) }}"  >
                            <img src="{{asset($post_position_1->photo->thump770)}}" alt="{{$post_position_1->title}}"  title="{{$post_position_1->title}}" />
                        </a>
                        <div class="main-news-item-content">
                            <a href="{{url('categories/'.$post_position_1->Category->id)}}" class="main-news-item-cat">{{$post_position_1->Category->name}}</a>
                            <a href="{{ return_post_link($post_position_1) }}"  class="main-news-item-title">@if($post_position_1->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post_position_1->view_type->name}}: </span>@endif{{$post_position_1->title}}</a>
                            <a href="{{ return_post_link($post_position_1) }}" class="main-news-item-readMore">إقرأ أكثر <i class="fa fa-long-arrow-left"></i></a>
                        </div>
                    </article>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <article class="main-news-item">
                        <a href="{{ return_post_link($post_position_2) }}"  >
                            <img src="{{asset($post_position_2->photo->thump770)}}" alt="{{$post_position_2->title}}"  title="{{$post_position_2->title}}" />
                        </a>
                        <div class="main-news-item-content">
                            <a href="{{url('categories/'.$post_position_2->Category->id)}}" class="main-news-item-cat">{{$post_position_2->Category->name}}</a>
                            <a href="{{ return_post_link($post_position_2) }}"   class="main-news-item-title">@if($post_position_2->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post_position_2->view_type->name}}: </span>@endif{{$post_position_2->title}}</a>
                            <a href="{{ return_post_link($post_position_2) }}" class="main-news-item-readMore">إقرأ أكثر <i class="fa fa-long-arrow-left"></i></a>
                        </div>
                    </article>
                </div>
                @if($adv_setting[0]->adv_part_2!=5)
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        @if($adv_setting[0]->adv_part_2==1)
                            <div class="main-news-ads main-ads one-ads" data-layout="1">

                                @if($adv_part_2 && $adv_part_2->iframe1)
                                  <div>{!! $adv_part_2->iframe1 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_2->url1)}}">
                                        <img src="{{asset($adv_part_2->image_adv1)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                                @endif
                            </div>
                        @endif
                        @if($adv_setting[0]->adv_part_2==2)
                            <div class="main-news-ads main-ads two-ads"  data-layout="2">
                                @if($adv_part_2 && $adv_part_2->iframe1)
                                    <div>{!! $adv_part_2->iframe1 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_2->url1)}}">
                                        <img src="{{asset($adv_part_2->image_adv1)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                @endif
                                @if($adv_part_2 && $adv_part_2->iframe2)
                                    <div>{!! $adv_part_2->iframe2 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv2)
                                    <a target="blank" href="{{asset($adv_part_2->url2)}}">
                                        <img src="{{asset($adv_part_2->image_adv2)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                                @endif
                            </div>
                        @endif
                        @if($adv_setting[0]->adv_part_2==3)
                            <div class="main-news-ads main-ads three-ads"  data-layout="3">
                                @if($adv_part_2 && $adv_part_2->iframe1)
                                    <div>{!! $adv_part_2->iframe1 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_2->url1)}}">
                                        <img src="{{asset($adv_part_2->image_adv1)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                @endif
                                @if($adv_part_2 && $adv_part_2->iframe2)
                                    <div>{!! $adv_part_2->iframe2 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv2)
                                    <a target="blank" href="{{asset($adv_part_2->url2)}}">
                                        <img src="{{asset($adv_part_2->image_adv2)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                @endif
                                @if($adv_part_2 && $adv_part_2->iframe3)
                                    <div>{!! $adv_part_2->iframe3 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv3)
                                    <a target="blank" href="{{asset($adv_part_2->url3)}}">
                                        <img src="{{asset($adv_part_2->image_adv3)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                                @endif
                            </div>
                        @endif
                        @if($adv_setting[0]->adv_part_2==4)
                            <div class="main-news-ads main-ads four-ads"  data-layout="4">
                                @if($adv_part_2 && $adv_part_2->iframe1)
                                    <div>{!! $adv_part_2->iframe1 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv1)
                                    <a target="blank" href="{{asset($adv_part_2->url1)}}">
                                        <img src="{{asset($adv_part_2->image_adv1)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                @endif
                                @if($adv_part_2 && $adv_part_2->iframe2)
                                   <div> {!! $adv_part_2->iframe1 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv2)
                                    <a target="blank" href="{{asset($adv_part_2->url2)}}">
                                        <img src="{{asset($adv_part_2->image_adv2)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                @endif
                                @if($adv_part_2 && $adv_part_2->iframe3)
                                   <div> {!! $adv_part_2->iframe3 !!}</div>
                                @elseif($adv_part_2 && $adv_part_2->image_adv3)
                                    <a target="blank" href="{{asset($adv_part_2->url3)}}">
                                        <img src="{{asset($adv_part_2->image_adv3)}}" /></a>
                                @else
                                    <a href="#">
                                        <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                                @endif
                                @if($adv_part_2 && $adv_part_2->iframe4)
                                    <div>{!! $adv_part_2->iframe4 !!}</div>
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
            </div>
            @endif
        </div>
    </section>
    @if($adv_setting[0]->adv_part_3!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_3==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_3 && $adv_part_3->iframe1)
                                <div>{!! $adv_part_3->iframe1 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv1)
                                <a target="blank" href="{{asset($adv_part_3->url1)}}">
                                    <img src="{{asset($adv_part_3->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_3==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_3 && $adv_part_3->iframe1)
                               <div> {!! $adv_part_3->iframe1 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv1)
                                <a target="blank" href="{{asset($adv_part_3->url1)}}">
                                    <img src="{{asset($adv_part_3->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_3 && $adv_part_3->iframe2)
                               <div> {!! $adv_part_3->iframe2 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv2)
                                <a target="blank" href="{{asset($adv_part_3->url2)}}">
                                    <img src="{{asset($adv_part_3->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_3==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_3 && $adv_part_3->iframe1)
                               <div> {!! $adv_part_3->iframe1 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv1)
                                <a target="blank" href="{{asset($adv_part_3->url1)}}">
                                    <img src="{{asset($adv_part_3->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_3 && $adv_part_3->iframe2)
                                <div>{!! $adv_part_3->iframe2 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv2)
                                <a target="blank" href="{{asset($adv_part_3->url2)}}">
                                    <img src="{{asset($adv_part_3->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_3 && $adv_part_3->iframe3)
                                <div>{!! $adv_part_3->iframe3 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv3)
                                <a target="blank" href="{{asset($adv_part_3->url3)}}">
                                    <img src="{{asset($adv_part_3->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_3==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_3 && $adv_part_3->iframe1)
                                <div>{!! $adv_part_3->iframe1 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv1)
                                <a target="blank" href="{{asset($adv_part_3->url1)}}">
                                    <img src="{{asset($adv_part_3->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_3 && $adv_part_3->iframe2)
                               <div> {!! $adv_part_3->iframe2 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv2)
                                <a target="blank" href="{{asset($adv_part_3->url2)}}">
                                    <img src="{{asset($adv_part_3->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_3 && $adv_part_3->iframe3)
                               <div> {!! $adv_part_3->iframe3 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv3)
                                <a target="blank" href="{{asset($adv_part_3->url3)}}">
                                    <img src="{{asset($adv_part_3->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_3 && $adv_part_3->iframe4)
                               <div> {!! $adv_part_3->iframe4 !!}</div>
                            @elseif($adv_part_3 && $adv_part_3->image_adv4)
                                <a target="blank" href="{{asset($adv_part_3->url4)}}">
                                    <img src="{{asset($adv_part_3->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
    <section class="section latest-news-section">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title"><a href="{{asset('news')}}">آخر الأخبار</a></h3>
                <div class="slider-indicators latest-news-slider-indicators">
                    <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                    <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                </div>
            </div>
            <div class="news-slider latest-news-slider">
                <div class="owl-carousel owl-theme">
                    <?php $x=0;?>
                    @foreach($last_news_main as $post)
                        @if($x==0 || $x%3==0)
                            <div class="item">
                                <div class="row">
                                    @endif
                                    <div class="col-xs-12 col-sm-4">
                                        <article class="slider-news-item">
                                            <div class="slider-news-item-img">
                                                <a href="{{ return_post_link($post) }}"  >
                                                    <img  src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                                </a>
                                                <a href="{{url('categories/'.$post->Category->id)}}" class="news-cat">{{$post->Category->name}}</a>
                                            </div>
                                            <div class="slider-news-item-content" style=" height: 100px;  overflow-y: hidden;">
                                                <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                                                <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                            </div>
                                        </article>
                                    </div>
                                    @if( $x==2 || $x==5 || $x==8)
                                </div>
                            </div>
                        @endif
                        <?php $x++;?>
                    @endforeach

                </div>
                <div class="owl-carousel owl-theme">
                    <?php $x=0;?>
                    @foreach($last_news_main2 as $post)
                        @if($x==0 || $x%3==0)
                            <div class="item">
                                <div class="row">
                                    @endif
                                    <div class="col-xs-12 col-sm-4">
                                        <article class="slider-news-item">
                                            <div class="slider-news-item-img">
                                                <a href="{{ return_post_link($post) }}"  >
                                                    <img  src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                                </a>
                                                <a href="{{url('categories/'.$post->Category->id)}}" class="news-cat">{{$post->Category->name}}</a>
                                            </div>
                                            <div class="slider-news-item-content" style=" height: 100px;  overflow-y: hidden;">
                                                <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                                                <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                            </div>
                                        </article>
                                    </div>
                                    @if( $x==2 || $x==5 || $x==8)
                                </div>
                            </div>
                        @endif
                        <?php $x++;?>
                    @endforeach

                </div>

            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_4!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_4==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_4 && $adv_part_4->iframe1)
                               <div> {!! $adv_part_4->iframe1 !!}</div>
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
                @if($adv_setting[0]->adv_part_4==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_4 && $adv_part_4->iframe1)
                                <div>{!! $adv_part_4->iframe1 !!}</div>
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
                               <div> {!! $adv_part_4->iframe2 !!}</div>
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
                @if($adv_setting[0]->adv_part_4==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_4 && $adv_part_4->iframe1)
                                <div>{!! $adv_part_4->iframe1 !!}</div>
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
                               <div> {!! $adv_part_4->iframe2 !!}</div>
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
                               <div> {!! $adv_part_4->iframe3 !!}</div>
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
                @if($adv_setting[0]->adv_part_4==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_4 && $adv_part_4->iframe1)
                                <div>{!! $adv_part_4->iframe1 !!}</div>
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
                                <div>{!! $adv_part_4->iframe2 !!}</div>
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
                               <div> {!! $adv_part_4->iframe3 !!}</div>
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
                                <div>{!! $adv_part_4->iframe4 !!}</div>
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

            </div>
        </section>
    @endif
    <section class="section three-cats-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="main-cat-news-block">
                        <div class="section-header">
                            @if($category_position_1)
                                <h3 class="section-title"><a href="{{asset('categories/'.$category_position_1->id)}}">{{$category_position_1?$category_position_1->name:''}}</a></h3>
                            @endif
                        </div>
                        <?php $x=1?>
                        @foreach($posts_category_1 as $post)
                            <textarea @if($x==1) class="first_postcat1"@endif id="post_{{$post->id}}" style="display: none;"><article class="main-cat-news-item">
                                    <a href="{{ return_post_link($post) }}"  >
                            <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                    </a>
                            <div class="main-cat-news-content">
                                <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                            </div>
                        </article></textarea>

                            @if($x==1)
                                <div class="postcat1">
                                    <article class="main-cat-news-item base_post_cat1" id="lastnews_{{$post->id}}">
                                        <a href="{{ return_post_link($post) }}"  >
                                            <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                        </a>
                                        <div class="main-cat-news-content">
                                            <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                            <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                                        </div>
                                    </article></div>
                            @elseif($x==2)
                                <article class="section-min-news-item show_post_box" id="postcat1_{{$post->id}}">
                                    <a href="{{ return_post_link($post) }}"  >
                                        <img src="{{asset($post->photo->thump)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                    </a>
                                    <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                                </article>
                            @else
                                <article class="text-news-item show_post_box" style="height: 55px;" id="postcat1_{{$post->id}}">
                                    <a href="{{ return_post_link($post) }}">
                                        @if(strlen($post->title)>160){{mb_substr($post->title ,0,160, "utf-8")}}...@else
                                            @if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}
                                        @endif
                                    </a>
                                </article>
                            @endif
                            <?php $x++;?>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="main-cat-news-block">
                        <div class="section-header">
                            @if($category_position_2)
                                <h3 class="section-title"><a href="{{asset('categories/'.$category_position_2->id)}}">{{$category_position_2?$category_position_2->name:''}}</a></h3>
                            @endif
                        </div>
                        <?php $x=1?>
                        @foreach($posts_category_2 as $post)
                            <textarea @if($x==1) class="first_postcat2"@endif id="post_{{$post->id}}" style="display: none;"><article class="main-cat-news-item">
                                    <a href="{{ return_post_link($post) }}"  >
                            <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                    </a>
                            <div class="main-cat-news-content">
                                <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                            </div>
                        </article></textarea>
                            @if($x==1)
                                <div class="postcat2">
                                    <article class="main-cat-news-item">
                                        <a href="{{ return_post_link($post) }}"  >
                                            <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                        </a>
                                        <div class="main-cat-news-content">
                                            <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                            <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                                        </div>
                                    </article>
                                </div>
                            @elseif($x==2)
                                <article class="section-min-news-item show_post_box" id="postcat2_{{$post->id}}">
                                    <a href="{{ return_post_link($post) }}"  >
                                        <img src="{{asset($post->photo->thump)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                    </a>
                                    <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                                </article>
                            @else
                                <article class="text-news-item show_post_box" id="postcat2_{{$post->id}}" style="height: 55px;">
                                    <a href="{{ return_post_link($post) }}">
                                        @if(strlen($post->title)>160){{mb_substr($post->title ,0,160, "utf-8")}}...@else
                                            @if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}
                                        @endif
                                    </a>
                                </article>
                            @endif
                            <?php $x++;?>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="main-cat-news-block">
                        <div class="section-header">
                            @if($category_position_3)
                                <h3 class="section-title"><a href="{{asset('categories/'.$category_position_3->id)}}">{{$category_position_3?$category_position_3->name:''}}</a></h3>
                            @endif
                        </div>
                        <?php $x=1?>
                        @foreach($posts_category_3 as $post)
                            <textarea @if($x==1) class="first_postcat3"@endif id="post_{{$post->id}}" style="display: none;"><article class="main-cat-news-item">
                           <a href="{{ return_post_link($post) }}"  >
                               <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                           </a>
                            <div class="main-cat-news-content">
                                <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                <a href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                            </div>
                        </article></textarea>
                            @if($x==1)
                                <div class="postcat3">
                                    <article class="main-cat-news-item">
                                        <a href="{{ return_post_link($post) }}"  >
                                            <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                        </a>
                                        <div class="main-cat-news-content">
                                            <span class="news-item-time"><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                            <a href="{{ return_post_link($post) }}">{{$post->title}}</a>
                                        </div>
                                    </article>
                                </div>
                            @elseif($x==2)
                                <article class="section-min-news-item show_post_box" id="postcat3_{{$post->id}}">
                                    <a href="{{ return_post_link($post) }}"  >
                                    <img src="{{asset($post->photo->thump)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                    </a>
                                    <a href="{{ return_post_link($post) }}">{{$post->title}}</a>
                                </article>
                            @else
                                <article class="text-news-item show_post_box" id="postcat3_{{$post->id}}" style="height: 55px;">
                                    <a href="{{ return_post_link($post) }}">
                                        @if(strlen($post->title)>160){{mb_substr($post->title ,0,160, "utf-8")}}...@else
                                            @if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}
                                        @endif
                                    </a>
                                </article>
                            @endif
                            <?php $x++;?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_5!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_5==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_5 && $adv_part_5->iframe1)
                                <div>{!! $adv_part_5->iframe1 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv1)
                                <a target="blank" href="{{asset($adv_part_5->url1)}}">
                                    <img src="{{asset($adv_part_5->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_5==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_5 && $adv_part_5->iframe1)
                                <div>{!! $adv_part_5->iframe1 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv1)
                                <a target="blank" href="{{asset($adv_part_5->url1)}}">
                                    <img src="{{asset($adv_part_5->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_5 && $adv_part_5->iframe2)
                                <div>{!! $adv_part_5->iframe2 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv2)
                                <a target="blank" href="{{asset($adv_part_5->url2)}}">
                                    <img src="{{asset($adv_part_5->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_5==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_5 && $adv_part_5->iframe1)
                                <div>{!! $adv_part_5->iframe1 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv1)
                                <a target="blank" href="{{asset($adv_part_5->url1)}}">
                                    <img src="{{asset($adv_part_5->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_5 && $adv_part_5->iframe2)
                                <div>{!! $adv_part_5->iframe2 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv2)
                                <a target="blank" href="{{asset($adv_part_5->url2)}}">
                                    <img src="{{asset($adv_part_5->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_5 && $adv_part_5->iframe3)
                                <div>{!! $adv_part_5->iframe3 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv3)
                                <a target="blank" href="{{asset($adv_part_5->url3)}}">
                                    <img src="{{asset($adv_part_5->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_5==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_5 && $adv_part_5->iframe1)
                                <div>{!! $adv_part_5->iframe1 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv1)
                                <a target="blank" href="{{asset($adv_part_5->url1)}}">
                                    <img src="{{asset($adv_part_5->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_5 && $adv_part_5->iframe2)
                                <div>{!! $adv_part_5->iframe2 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv2)
                                <a target="blank" href="{{asset($adv_part_5->url2)}}">
                                    <img src="{{asset($adv_part_5->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_5 && $adv_part_5->iframe3)
                                <div>{!! $adv_part_5->iframe3 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv3)
                                <a target="blank" href="{{asset($adv_part_5->url3)}}">
                                    <img src="{{asset($adv_part_5->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_5 && $adv_part_5->iframe4)
                                <div>{!! $adv_part_5->iframe4 !!}</div>
                            @elseif($adv_part_5 && $adv_part_5->image_adv4)
                                <a target="blank" href="{{asset($adv_part_5->url4)}}">
                                    <img src="{{asset($adv_part_5->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
    <section class="section bg-section-news">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="news-slider bg-news-slider">
                        <div class="bg-slider-indicators">
                            <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                            <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach($posts_category_4 as $post)
                                <div class="item">
                                    <article class="bg-news-item">
                                        <a href="{{ return_post_link($post) }}"  >
                                            <img src="{{asset($post->photo->thump770)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                        </a>
                                        <div class="bg-news-item-content">
                                            <a href="{{url('categories/'.$post->Category->id)}}" class="bg-news-item-cat">{{$post->Category->name}}</a>
                                            <a class="bg-news-item-title" href="{{ return_post_link($post) }}">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a></a>
                                            <a href="{{ return_post_link($post) }}" class="bg-news-item-readMore">إقرأ أكثر <i class="fa fa-long-arrow-left"></i></a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="bg-news-items">
                        <div class="section-header bg">
                            <h3 class="section-title">الأكثر قراءة هذا الأسبوع</h3>
                        </div>
                        @foreach($most_read_week as $post)
                            @if($post->main_post)
                                <article class="bg-small-news-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            @if($post->main_post->photo)
                                                <a href="{{ return_post_link($post->main_post) }}"  >
                                                    <img src="{{asset($post->main_post->photo->thump370)}}" title="{{$post->main_post->title}}" alt="{{$post->main_post->title}}" class="img-responsive" />
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-6 no-right-padding">
                                            <a href="{{ return_post_link($post->main_post)}}">@if($post->main_post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->main_post->view_type->name}}: </span>@endif{{$post->main_post->title}}</a>

                                        </div>
                                    </div>
                                </article>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_6!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_6==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_6 && $adv_part_6->iframe1)
                                <div>{!! $adv_part_6->iframe1 !!}</div>
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
                @if($adv_setting[0]->adv_part_6==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_6 && $adv_part_6->iframe1)
                                <div>{!! $adv_part_6->iframe1 !!}</div>
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
                                <div>{!! $adv_part_6->iframe2 !!}</div>
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
                @if($adv_setting[0]->adv_part_6==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_6 && $adv_part_6->iframe1)
                                <div>{!! $adv_part_6->iframe1 !!}</div>
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
                                <div>{!! $adv_part_6->iframe1 !!}</div>
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
                                <div>{!! $adv_part_6->iframe1 !!}</div>
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
                @if($adv_setting[0]->adv_part_6==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_6 && $adv_part_6->iframe1)
                                <div>{!! $adv_part_6->iframe1 !!}</div>
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
                                <div>{!! $adv_part_6->iframe2 !!}</div>
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
                               <div> {!! $adv_part_6->iframe3 !!}</div>
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
                                <div>{!! $adv_part_6->iframe4 !!}</div>
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

            </div>
        </section>
    @endif
    <section class="section sliders-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="news-slider sliders-section-item" >
                        <div class="section-header">
                            <h3 class="section-title"><a href="{{asset('news/chosen')}}">إخترنا لكم</a></h3>
                            <div class="slider-indicators sliders-section-item-indicators">
                                <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                                <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme">
                            <?php $x=0;?>
                            @foreach($chosen as $post)

                                @if($x==0 || $x==4)
                                    <div class="item">
                                        <div class="row">
                                            @endif
                                            <div class="col-xs-6">
                                                <article class="article-slider-item">
                                                    <div class="article-img">
                                                        <a href="{{ return_post_link($post) }}"  >
                                                            <img  src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" />
                                                        </a>
                                                    </div>
                                                    <p style="height: 40px;">
                                                        <a  href="{{ return_post_link($post) }}" style="height: 20px;">
                                                            @if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif {{substring($post->title,100)}}
                                                        </a>
                                                    </p>
                                                </article>
                                            </div>

                                            @if( $x==3 || $x==7)
                                        </div>
                                    </div>
                                @endif
                                <?php $x++;?>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="news-slider sliders-section-item" >
                        <div class="section-header">
                            <h3 class="section-title"><a href="{{asset('videos')}}">مكتبة الفيديو</a></h3>
                            <div class="slider-indicators sliders-section-item-indicators">
                                <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                                <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme">
                            <?php $x=0;?>
                            @foreach($videos as $video)

                                @if($x==0 || $x==4)
                                    <div class="item">
                                        <div class="row">
                                            @endif
                                            <div class="col-xs-6">
                                                <article class="article-slider-item">
                                                    <div class="article-img">
                                                        <a data-fancybox="video_group" data-src='{{asset("home/getVideoMedia/".$video->id)}}' data-type="ajax"  title="{{$video->name}}" >
                                                            <img src="{{asset($video->photo->thump370)}}" alt="{{$video->name}}" title="{{$video->title}}" >
                                                            <i class="video-icon" style="cursor: pointer;"></i>
                                                        </a>
                                                    </div>
                                                    <p style="height: 40px;">
                                                        <a data-fancybox="video_group" style="cursor: pointer;" data-src='{{asset("home/getVideoMedia/".$video->id)}}' data-type="ajax"  title="{{$video->name}}" >
                                                            {{substring($video->name,100)}}</a>
                                                    </p>

                                                </article>
                                            </div>

                                            @if( $x==3 || $x==7)
                                        </div>
                                    </div>
                                @endif
                                <?php $x++;?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_7!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_7==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_7 && $adv_part_7->iframe1)
                                {!! $adv_part_7->iframe1 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv1)
                                <a target="blank" href="{{asset($adv_part_7->url1)}}">
                                    <img src="{{asset($adv_part_7->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_7==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_7 && $adv_part_7->iframe1)
                                {!! $adv_part_7->iframe1 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv1)
                                <a target="blank" href="{{asset($adv_part_7->url1)}}">
                                    <img src="{{asset($adv_part_7->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_7 && $adv_part_7->iframe2)
                                {!! $adv_part_7->iframe2 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv2)
                                <a target="blank" href="{{asset($adv_part_7->url2)}}">
                                    <img src="{{asset($adv_part_7->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_7==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_7 && $adv_part_7->iframe1)
                                {!! $adv_part_7->iframe1 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv1)
                                <a target="blank" href="{{asset($adv_part_7->url1)}}">
                                    <img src="{{asset($adv_part_7->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_7 && $adv_part_7->iframe2)
                                {!! $adv_part_7->iframe2 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv2)
                                <a target="blank" href="{{asset($adv_part_7->url2)}}">
                                    <img src="{{asset($adv_part_7->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_7 && $adv_part_7->iframe3)
                                {!! $adv_part_7->iframe3 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv3)
                                <a target="blank" href="{{asset($adv_part_7->url3)}}">
                                    <img src="{{asset($adv_part_7->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_7==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_7 && $adv_part_7->iframe1)
                                {!! $adv_part_7->iframe1 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv1)
                                <a target="blank" href="{{asset($adv_part_7->url1)}}">
                                    <img src="{{asset($adv_part_7->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_7 && $adv_part_7->iframe2)
                                {!! $adv_part_7->iframe2 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv2)
                                <a target="blank" href="{{asset($adv_part_7->url2)}}">
                                    <img src="{{asset($adv_part_7->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_7 && $adv_part_7->iframe3)
                                {!! $adv_part_7->iframe3 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv3)
                                <a target="blank" href="{{asset($adv_part_7->url3)}}">
                                    <img src="{{asset($adv_part_7->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_7 && $adv_part_7->iframe4)
                                {!! $adv_part_7->iframe4 !!}
                            @elseif($adv_part_7 && $adv_part_7->image_adv4)
                                <a target="blank" href="{{asset($adv_part_7->url4)}}">
                                    <img src="{{asset($adv_part_7->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
    <section class="section two-cat-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="main-cat-news-block">
                        <div class="section-header">
                            <h3 class="section-title"><a href="{{url('categories/'.$category_position_5->id)}}" >{{$category_position_5?$category_position_5->name:''}}</a></h3>
                            <a href="{{url('categories/'.$category_position_5->id)}}" class="header-section-more">المزيد <i class="fa fa-long-arrow-left"></i></a>
                        </div>
                        <article class="main-news-item cat-item">
                            <a href="{{ return_post_link($posts_category_5[0]) }}"  >
                                <img src="{{asset($posts_category_5[0]->photo->thump770)}}" title="{{$posts_category_5[0]->title}}" alt="{{$posts_category_5[0]->title}}" />
                            </a>
                            <div class="main-news-item-content">
                                <a   href="{{ return_post_link($posts_category_5[0]) }}" class="main-news-item-title">@if($posts_category_5[0]->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$posts_category_5[0]->view_type->name}}: </span>@endif{{$posts_category_5[0]->title}}</a></a>

                                <a href="{{ return_post_link($posts_category_5[0]) }}" class="main-news-item-readMore">إقرأ أكثر <i class="fa fa-long-arrow-left"></i></a>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="main-cat-news-block">
                        <div class="section-header">
                            <h3 class="section-title"><a href="{{url('categories/'.$category_position_6->id)}}">{{$category_position_6?$category_position_6->name:''}}</a></h3>
                            <a href="{{url('categories/'.$category_position_6->id)}}" class="header-section-more">المزيد <i class="fa fa-long-arrow-left"></i></a>

                        </div>
                        <article class="main-news-item cat-item">
                            <a href="{{ return_post_link($posts_category_6[0]) }}"  >
                                <img src="{{asset($posts_category_6[0]->photo->thump770)}}" title="{{$posts_category_6[0]->title}}" alt="{{$posts_category_5[0]->title}}" />
                            </a>
                            <div class="main-news-item-content">
                                <a   href="{{ return_post_link($posts_category_6[0]) }}" class="main-news-item-title">@if($posts_category_6[0]->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$posts_category_6[0]->view_type->name}}: </span>@endif{{$posts_category_6[0]->title}}</a></a>

                                <a href="{{ return_post_link($posts_category_6[0]) }}" class="main-news-item-readMore">إقرأ أكثر <i class="fa fa-long-arrow-left"></i></a>
                            </div>
                        </article>                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_8!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_8==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_8 && $adv_part_8->iframe1)
                                {!! $adv_part_8->iframe1 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv1)
                                <a target="blank" href="{{asset($adv_part_8->url1)}}">
                                    <img src="{{asset($adv_part_8->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_8==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_8 && $adv_part_8->iframe1)
                                {!! $adv_part_8->iframe1 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv1)
                                <a target="blank" href="{{asset($adv_part_8->url1)}}">
                                    <img src="{{asset($adv_part_8->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_8 && $adv_part_8->iframe2)
                                {!! $adv_part_8->iframe2 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv2)
                                <a target="blank" href="{{asset($adv_part_8->url2)}}">
                                    <img src="{{asset($adv_part_8->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_8==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_8 && $adv_part_8->iframe1)
                                {!! $adv_part_8->iframe1 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv1)
                                <a target="blank" href="{{asset($adv_part_8->url1)}}">
                                    <img src="{{asset($adv_part_8->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_8 && $adv_part_8->iframe2)
                                {!! $adv_part_8->iframe2 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv2)
                                <a target="blank" href="{{asset($adv_part_8->url2)}}">
                                    <img src="{{asset($adv_part_8->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_8 && $adv_part_8->iframe3)
                                {!! $adv_part_8->iframe3 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv3)
                                <a target="blank" href="{{asset($adv_part_8->url3)}}">
                                    <img src="{{asset($adv_part_8->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_8==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_8 && $adv_part_8->iframe1)
                                {!! $adv_part_8->iframe1 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv1)
                                <a target="blank" href="{{asset($adv_part_8->url1)}}">
                                    <img src="{{asset($adv_part_8->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_8 && $adv_part_8->iframe2)
                                {!! $adv_part_8->iframe2 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv2)
                                <a target="blank" href="{{asset($adv_part_8->url2)}}">
                                    <img src="{{asset($adv_part_8->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_8 && $adv_part_8->iframe3)
                                {!! $adv_part_8->iframe3 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv3)
                                <a target="blank" href="{{asset($adv_part_8->url3)}}">
                                    <img src="{{asset($adv_part_8->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_8 && $adv_part_8->iframe4)
                                {!! $adv_part_8->iframe4 !!}
                            @elseif($adv_part_8 && $adv_part_8->image_adv4)
                                <a target="blank" href="{{asset($adv_part_8->url4)}}">
                                    <img src="{{asset($adv_part_8->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
    <section class="section two-cat-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="main-cat-news-block">
                        <?php $x=0;?>
                        @foreach($posts_category_5 as $post)
                            @if($x>1)
                                <article class="cat-article">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 no-left-padding">
                                            <div class="cat-article-img">
                                                <a href="{{ return_post_link($post) }}"  >
                                                    <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" class="img-responsive" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 no-right-padding">
                                            <div class="cat-article-content">
                                                <a href="{{url('categories/'.$post->Category->id)}}" class="cat-article-cat">{{$post->Category->name}}</a>

                                                <a href="{{ return_post_link($post) }}" class="cat-article-title">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endif
                            <?php $x++?>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="main-cat-news-block">
                        <?php $x=0;?>
                        @foreach($posts_category_6 as $post)
                            @if($x>1)
                                <article class="cat-article">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 no-left-padding">
                                            <div class="cat-article-img">
                                                <a href="{{ return_post_link($post) }}"  >
                                                    <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" class="img-responsive" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 no-right-padding">
                                            <div class="cat-article-content">
                                                <a href="{{url('categories/'.$post->Category->id)}}" class="cat-article-cat">{{$post->Category->name}}</a>

                                                <a href="{{ return_post_link($post) }}" class="cat-article-title">@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endif
                            <?php $x++?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_9!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_9==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_9 && $adv_part_9->iframe1)
                                {!! $adv_part_9->iframe1 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv1)
                                <a target="blank" href="{{asset($adv_part_9->url1)}}">
                                    <img src="{{asset($adv_part_9->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_9==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_9 && $adv_part_9->iframe1)
                                {!! $adv_part_9->iframe1 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv1)
                                <a target="blank" href="{{asset($adv_part_9->url1)}}">
                                    <img src="{{asset($adv_part_9->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_9 && $adv_part_9->iframe2)
                                {!! $adv_part_9->iframe2 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv2)
                                <a target="blank" href="{{asset($adv_part_9->url2)}}">
                                    <img src="{{asset($adv_part_9->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_9==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_9 && $adv_part_9->iframe1)
                                {!! $adv_part_9->iframe1 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv1)
                                <a target="blank" href="{{asset($adv_part_9->url1)}}">
                                    <img src="{{asset($adv_part_9->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_9 && $adv_part_9->iframe2)
                                {!! $adv_part_9->iframe2 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv2)
                                <a target="blank" href="{{asset($adv_part_9->url2)}}">
                                    <img src="{{asset($adv_part_9->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_9 && $adv_part_9->iframe3)
                                {!! $adv_part_9->iframe3 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv3)
                                <a target="blank" href="{{asset($adv_part_9->url3)}}">
                                    <img src="{{asset($adv_part_9->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_9==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_9 && $adv_part_9->iframe1)
                                {!! $adv_part_9->iframe1 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv1)
                                <a target="blank" href="{{asset($adv_part_9->url1)}}">
                                    <img src="{{asset($adv_part_9->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_9 && $adv_part_9->iframe2)
                                {!! $adv_part_9->iframe2 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv2)
                                <a target="blank" href="{{asset($adv_part_9->url2)}}">
                                    <img src="{{asset($adv_part_9->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_9 && $adv_part_9->iframe3)
                                {!! $adv_part_9->iframe3 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv3)
                                <a target="blank" href="{{asset($adv_part_9->url3)}}">
                                    <img src="{{asset($adv_part_9->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_9 && $adv_part_9->iframe4)
                                {!! $adv_part_9->iframe4 !!}
                            @elseif($adv_part_9 && $adv_part_9->image_adv4)
                                <a target="blank" href="{{asset($adv_part_9->url4)}}">
                                    <img src="{{asset($adv_part_9->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
    <section class="section shadow-news-section">
        <div class="container">
            <div class="shadow-news-wrap">
                @if(count($posts_category_7))
                    <div class="shadow-news-main">
                        <div class="shadow-news-img">
                            <a href="{{ return_post_link($posts_category_7[0]) }}"  >
                                <img src="{{asset($posts_category_7[0]->photo->thump770)}}" title="{{$posts_category_7[0]->title}}" alt="{{$posts_category_7[0]->title}}" />
                            </a>
                        </div>
                        <div class="shadow-news-content">
                            @if($posts_category_7[0]->Category)<a href="{{url('categories/'.$posts_category_7[0]->Category->id)}}" class="shadow-news-cat">{{$posts_category_7[0]->Category->name}}</a>@endif
                            <a href="{{ return_post_link($posts_category_7[0]) }}" class="shadow-news-title">
                                @if($posts_category_7[0]->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$posts_category_7[0]->view_type->name}}: </span>@endif{{$posts_category_7[0]->title}}
                            </a>
                            <a href="{{ return_post_link($posts_category_7[0]) }}" class="main-news-item-readMore">إقرأ أكثر <i class="fa fa-long-arrow-left"></i></a>
                        </div>
                    </div>
                @endif
                <div class="shadow-news-more">
                    <?php $x=0;?>
                    @foreach($posts_category_7 as $post)
                        @if($x>0)
                            <div class="shadow-news-item">
                                <span><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                <a href="{{ return_post_link($post) }}" >@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                            </div>
                        @endif
                        <?php $x++?>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_10!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_10==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_10 && $adv_part_10->iframe1)
                                {!! $adv_part_10->iframe1 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv1)
                                <a target="blank" href="{{asset($adv_part_10->url1)}}">
                                    <img src="{{asset($adv_part_10->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_10==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_10 && $adv_part_10->iframe1)
                                {!! $adv_part_10->iframe1 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv1)
                                <a target="blank" href="{{asset($adv_part_10->url1)}}">
                                    <img src="{{asset($adv_part_10->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_10 && $adv_part_10->iframe2)
                                {!! $adv_part_10->iframe2 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv2)
                                <a target="blank" href="{{asset($adv_part_10->url2)}}">
                                    <img src="{{asset($adv_part_10->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_10==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_10 && $adv_part_10->iframe1)
                                {!! $adv_part_10->iframe1 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv1)
                                <a target="blank" href="{{asset($adv_part_10->url1)}}">
                                    <img src="{{asset($adv_part_10->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_10 && $adv_part_10->iframe2)
                                {!! $adv_part_10->iframe2 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv2)
                                <a target="blank" href="{{asset($adv_part_10->url2)}}">
                                    <img src="{{asset($adv_part_10->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_10 && $adv_part_10->iframe3)
                                {!! $adv_part_10->iframe3 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv3)
                                <a target="blank" href="{{asset($adv_part_10->url3)}}">
                                    <img src="{{asset($adv_part_10->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_10==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_10 && $adv_part_10->iframe1)
                                {!! $adv_part_10->iframe1 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv1)
                                <a target="blank" href="{{asset($adv_part_10->url1)}}">
                                    <img src="{{asset($adv_part_10->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_10 && $adv_part_10->iframe2)
                                {!! $adv_part_10->iframe2 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv2)
                                <a target="blank" href="{{asset($adv_part_10->url2)}}">
                                    <img src="{{asset($adv_part_10->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_10 && $adv_part_10->iframe3)
                                {!! $adv_part_10->iframe3 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv3)
                                <a target="blank" href="{{asset($adv_part_10->url3)}}">
                                    <img src="{{asset($adv_part_10->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_10 && $adv_part_10->iframe4)
                                {!! $adv_part_10->iframe4 !!}
                            @elseif($adv_part_10 && $adv_part_10->image_adv4)
                                <a target="blank" href="{{asset($adv_part_10->url4)}}">
                                    <img src="{{asset($adv_part_10->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
    <section class="section tables-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="table-item coins">
                        <div class="section-header">
                            <h3 class="section-title">أسعار العملات</h3>
                            <span class="table-item-header">
                                مقابل الدولار
                            </span>
                        </div>
                        <table class="table-responsive">
                            <thead>
                            <tr>
                                <th width="64%">العملة</th>
                                <th width="18%">سعر البيع</th>
                                <th width="18%">سعر الشراء</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>الشيكل الاسرائيلي</td>
                                <td>{{$USD_ILS-0.02}}</td>
                                <td>{{$USD_ILS}} </td>
                            </tr>
                            <tr>
                                <td>الدينار الأردني</td>
                                <td>{{$JOD_ILS-0.02}}</td>
                                <td>{{$JOD_ILS}} </td>
                            </tr>
                            <tr>
                                <td>اليورو الأوروبي</td>
                                <td>{{$EUR_ILS-0.02}}</td>
                                <td>{{$EUR_ILS}} </td>
                            </tr>
                            <tr>
                                <td>الجنيه المصري</td>
                                <td>{{$ILS_EGP-0.02}}</td>
                                <td>{{$ILS_EGP}} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="table-item praying-time">
                        <div class="section-header">
                            <h3 class="section-title">أوقات الصلاة</h3>
                            <span class="table-item-header">
                                بتوقيت القدس
                            </span>
                        </div>
                        <table class="table-responsive">
                            <thead>
                            <tr>
                                <th width="64%">الصلاة</th>
                                <th width="18%">وقت الآذان</th>
                                <th width="18%">وقت الإقامة</th>
                            </tr>
                            </thead>
                            @if($time_aladan)
                                <tbody>
                                <tr>
                                    <td>صلاة الفجر</td>
                                    <td>{{$time_aladan->daybreak}}</td>
                                    <td>{{$time_aladan->daybreak1}}</td>
                                </tr>
                                <tr>
                                    <td>صلاة الظهر</td>
                                    <td>{{$time_aladan->noon}}</td>
                                    <td>{{$time_aladan->noon1}}</td>
                                </tr>
                                <tr >
                                    <td>صلاة العصر</td>
                                    <td>{{$time_aladan->afternoon}}</td>
                                    <td>{{$time_aladan->afternoon1}}</td>
                                </tr>
                                <tr>
                                    <td>صلاة المغرب</td>
                                    <td>{{$time_aladan->sunset}}</td>
                                    <td>{{$time_aladan->sunset1}}</td>
                                </tr>
                                <tr>
                                    <td>صلاة العشاء</td>
                                    <td>{{$time_aladan->night}}</td>
                                    <td>{{$time_aladan->night1}}</td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_11!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_11==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_11 && $adv_part_11->iframe1)
                                {!! $adv_part_11->iframe1 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv1)
                                <a target="blank" href="{{asset($adv_part_11->url1)}}">
                                    <img src="{{asset($adv_part_11->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_11==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_11 && $adv_part_11->iframe1)
                                {!! $adv_part_11->iframe1 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv1)
                                <a target="blank" href="{{asset($adv_part_11->url1)}}">
                                    <img src="{{asset($adv_part_11->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_11 && $adv_part_11->iframe2)
                                {!! $adv_part_11->iframe2 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv2)
                                <a target="blank" href="{{asset($adv_part_11->url2)}}">
                                    <img src="{{asset($adv_part_11->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_11==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_11 && $adv_part_11->iframe1)
                                {!! $adv_part_11->iframe1 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv1)
                                <a target="blank" href="{{asset($adv_part_11->url1)}}">
                                    <img src="{{asset($adv_part_11->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_11 && $adv_part_11->iframe2)
                                {!! $adv_part_11->iframe2 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv2)
                                <a target="blank" href="{{asset($adv_part_11->url2)}}">
                                    <img src="{{asset($adv_part_11->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_11 && $adv_part_11->iframe3)
                                {!! $adv_part_11->iframe3 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv3)
                                <a target="blank" href="{{asset($adv_part_11->url3)}}">
                                    <img src="{{asset($adv_part_11->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_11==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_11 && $adv_part_11->iframe1)
                                {!! $adv_part_11->iframe1 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv1)
                                <a target="blank" href="{{asset($adv_part_11->url1)}}">
                                    <img src="{{asset($adv_part_11->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_11 && $adv_part_11->iframe2)
                                {!! $adv_part_11->iframe2 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv2)
                                <a target="blank" href="{{asset($adv_part_11->url2)}}">
                                    <img src="{{asset($adv_part_11->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_11 && $adv_part_11->iframe3)
                                {!! $adv_part_11->iframe3 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv3)
                                <a target="blank" href="{{asset($adv_part_11->url3)}}">
                                    <img src="{{asset($adv_part_11->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_11 && $adv_part_11->iframe4)
                                {!! $adv_part_11->iframe4 !!}
                            @elseif($adv_part_11 && $adv_part_11->image_adv4)
                                <a target="blank" href="{{asset($adv_part_11->url4)}}">
                                    <img src="{{asset($adv_part_11->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
    <section class="section albums-news-section">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title"><a href="{{asset('galleries')}}">ألبومات الصور</a></h3>
            </div>
            <div class="row">
                @foreach($albums as $album)
                    <div class="col-xs-12 col-sm-6">
                        <article class="main-news-item cat-item album-item">
                            <a href="{{ url('galleries/'.$album->id.'/'.(implode('-',explode(' ',$album->name)))) }}">
                            @if($album->photoscover)<img  src="{{asset($album->photoscover->thump770)}}" title="{{$album->name}}" alt="{{$album->name}}" />
                            @else
                                <img  src="{{asset($album->cover)}}" title="{{$album->name}}" alt="{{$album->name}}" />
                            @endif
                            </a>
                            <div class="main-news-item-content">
                                <a href="{{ url('galleries/'.$album->id.'/'.(implode('-',explode(' ',$album->name)))) }}" class="main-news-item-title" ><i class="fa fa-picture-o"></i> <span>{{$album->name}}</span></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @if($adv_setting[0]->adv_part_12!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_12==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_12 && $adv_part_12->iframe1)
                                {!! $adv_part_12->iframe1 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv1)
                                <a target="blank" href="{{asset($adv_part_12->url1)}}">
                                    <img src="{{asset($adv_part_12->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_12==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_12 && $adv_part_12->iframe1)
                                {!! $adv_part_12->iframe1 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv1)
                                <a target="blank" href="{{asset($adv_part_12->url1)}}">
                                    <img src="{{asset($adv_part_12->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_12 && $adv_part_12->iframe2)
                                {!! $adv_part_12->iframe2 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv2)
                                <a target="blank" href="{{asset($adv_part_12->url2)}}">
                                    <img src="{{asset($adv_part_12->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_12==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_12 && $adv_part_12->iframe1)
                                {!! $adv_part_12->iframe1 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv1)
                                <a target="blank" href="{{asset($adv_part_12->url1)}}">
                                    <img src="{{asset($adv_part_12->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_12 && $adv_part_12->iframe2)
                                {!! $adv_part_12->iframe2 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv2)
                                <a target="blank" href="{{asset($adv_part_12->url2)}}">
                                    <img src="{{asset($adv_part_12->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_12 && $adv_part_12->iframe3)
                                {!! $adv_part_12->iframe3 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv3)
                                <a target="blank" href="{{asset($adv_part_12->url3)}}">
                                    <img src="{{asset($adv_part_12->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_12==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_12 && $adv_part_12->iframe1)
                                {!! $adv_part_12->iframe1 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv1)
                                <a target="blank" href="{{asset($adv_part_12->url1)}}">
                                    <img src="{{asset($adv_part_12->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_12 && $adv_part_12->iframe2)
                                {!! $adv_part_12->iframe2 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv2)
                                <a target="blank" href="{{asset($adv_part_12->url2)}}">
                                    <img src="{{asset($adv_part_12->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_12 && $adv_part_12->iframe3)
                                {!! $adv_part_12->iframe3 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv3)
                                <a target="blank" href="{{asset($adv_part_12->url3)}}">
                                    <img src="{{asset($adv_part_12->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_12 && $adv_part_12->iframe4)
                                {!! $adv_part_12->iframe4 !!}
                            @elseif($adv_part_12 && $adv_part_12->image_adv4)
                                <a target="blank" href="{{asset($adv_part_12->url4)}}">
                                    <img src="{{asset($adv_part_12->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
    <section class="section shadow-news-section">
        <div class="container">
            <div class="shadow-news-wrap">
                @if($posts_category_8)
                    <div class="shadow-news-main">
                        <div class="shadow-news-img">
                            <a href="{{ return_post_link($posts_category_8[0]) }}"  >
                                <img src="{{asset($posts_category_8[0]->photo->thump770)}}" title="{{$posts_category_8[0]->title}}" alt="{{$posts_category_8[0]->title}}" />
                            </a>
                        </div>
                        <div class="shadow-news-content">
                            @if($posts_category_8[0]->Category)<a href="{{url('categories/'.$posts_category_8[0]->Category->id)}}" class="shadow-news-cat">{{$posts_category_8[0]->Category->name}}</a>@endif
                            <a href="{{ return_post_link($posts_category_8[0]) }}" class="shadow-news-title">
                                @if($posts_category_8[0]->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$posts_category_8[0]->view_type->name}}: </span>@endif{{$posts_category_8[0]->title}}
                            </a>
                            <a href="{{ return_post_link($posts_category_8[0]) }}" class="main-news-item-readMore">إقرأ أكثر <i class="fa fa-long-arrow-left"></i></a>
                        </div>
                    </div>
                @endif
                <div class="shadow-news-more">
                    <?php $x=0;?>
                    @foreach($posts_category_8 as $post)
                        @if($x>0)
                            <div class="shadow-news-item">
                                <span><i class="fa fa-clock-o"></i>{{returnDateFormay($post->published_at)}}</span>
                                <a href="{{ return_post_link($post) }}" >@if($post->view_type_id_new!=1)<span style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </span>@endif{{$post->title}}</a>
                            </div>
                        @endif
                        <?php $x++?>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if($adv_setting[0]->adv_part_13!=5)
        <section class="section main-ads-section">
            <div class="container">
                @if($adv_setting[0]->adv_part_13==1)
                    <div class="row main-ads one-ads" data-layout="1">
                        <div class="col-xs-12">
                            @if($adv_part_13 && $adv_part_13->iframe1)
                                {!! $adv_part_13->iframe1 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv1)
                                <a target="blank" href="{{asset($adv_part_13->url1)}}">
                                    <img src="{{asset($adv_part_13->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-full.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_13==2)
                    <div class="row main-ads two-ads" data-layout="2">
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_13 && $adv_part_13->iframe1)
                                {!! $adv_part_13->iframe1 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv1)
                                <a target="blank" href="{{asset($adv_part_13->url1)}}">
                                    <img src="{{asset($adv_part_13->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($adv_part_13 && $adv_part_13->iframe2)
                                {!! $adv_part_13->iframe2 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv2)
                                <a target="blank" href="{{asset($adv_part_13->url2)}}">
                                    <img src="{{asset($adv_part_13->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-half.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_13==3)
                    <div class="row main-ads three-ads"  data-layout="3">
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_13 && $adv_part_13->iframe1)
                                {!! $adv_part_13->iframe1 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv1)
                                <a target="blank" href="{{asset($adv_part_13->url1)}}">
                                    <img src="{{asset($adv_part_13->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_13 && $adv_part_13->iframe2)
                                {!! $adv_part_13->iframe2 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv2)
                                <a target="blank" href="{{asset($adv_part_13->url2)}}">
                                    <img src="{{asset($adv_part_13->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            @if($adv_part_13 && $adv_part_13->iframe3)
                                {!! $adv_part_13->iframe3 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv3)
                                <a target="blank" href="{{asset($adv_part_13->url3)}}">
                                    <img src="{{asset($adv_part_13->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-three.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif
                @if($adv_setting[0]->adv_part_13==4)
                    <div class="row main-ads four-ads"  data-layout="4">
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_13 && $adv_part_13->iframe1)
                                {!! $adv_part_13->iframe1 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv1)
                                <a target="blank" href="{{asset($adv_part_13->url1)}}">
                                    <img src="{{asset($adv_part_13->image_adv1)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_13 && $adv_part_13->iframe2)
                                {!! $adv_part_13->iframe2 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv2)
                                <a target="blank" href="{{asset($adv_part_13->url2)}}">
                                    <img src="{{asset($adv_part_13->image_adv2)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_13 && $adv_part_13->iframe3)
                                {!! $adv_part_13->iframe3 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv3)
                                <a target="blank" href="{{asset($adv_part_13->url3)}}">
                                    <img src="{{asset($adv_part_13->image_adv3)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @if($adv_part_13 && $adv_part_13->iframe4)
                                {!! $adv_part_13->iframe4 !!}
                            @elseif($adv_part_13 && $adv_part_13->image_adv4)
                                <a target="blank" href="{{asset($adv_part_13->url4)}}">
                                    <img src="{{asset($adv_part_13->image_adv4)}}" /></a>
                            @else
                                <a href="#">
                                    <img src="{{asset('homeStyle')}}/images/ads-four.png" /></a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif
@endsection
@push('scripts')
    <script>
        $(".show_post_box").mouseover(function(){
            var iid_post=$(this).attr('id');
            var idid=iid_post.split('_');
            var html_data=$("#post_"+idid[1]).val();
            $("."+idid[0]).html(html_data);
        });
        $(".show_post_box").mouseout(function(){
            var iid_post=$(this).attr('id');
            var idid=iid_post.split('_');
            var html_data=$(".first_"+idid[0]).val();
            $("."+idid[0]).html(html_data);
        });
    </script>
@endpush