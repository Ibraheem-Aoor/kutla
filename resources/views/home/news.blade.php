@extends('home.main')

@section('content')


    <section class="section inner-page">
        <div class="container">
            <div class="news-slider inner-slider-item">
                <div class="section-header">
                    <h3 class="section-title">آخر الأخبار</h3>
                    <div class="slider-indicators inner-news-slider-indicators">
                        <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                        <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
                <div class="inner-news-slider">
                    <div class="owl-carousel owl-theme">
                        <?php $x=0;?>
                        @foreach($last_news_main as $post)
                            @if($x==0 || $x==5)
                        <div class="item">
                            <div class="row inner-slider">
@endif
                                    @if($x!=2 && $x!=7)
                                    @if($x==0 || $x==3 || $x==5 ||$x==8)
                                <div class="col-xs-12 col-sm-3 col-md-3">
                                    @endif
                                    <article class="main-news-item cat-item">
                                        <a href="{{ return_post_link($post) }}" class="main-news-item-title"> <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" ></a>
                                        <div class="main-news-item-content">
                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                        </div>
                                    </article>
                                    @if($x==1 || $x==4 || $x==6 ||$x==9)
                                </div>
                                        @endif
                                        @endif
                                        @if($x==2 || $x==7)
                                            @if($x==2 || $x==7)
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    @endif
                                    <article class="main-news-item cat-item">
                                        <a href="{{ return_post_link($post) }}"><img src="{{asset($post->photo->thump770)}}" title="{{$post->title}}" alt="{{$post->title}}" ></a>
                                        <div class="main-news-item-content">
                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                        </div>
                                    </article>
                                    @endif
                                    @if($x==2 || $x==7)
                                </div>
                                            @endif


@if($x==4 || $x==9)
                            </div>
                        </div>
                                @endif
                                    <?php $x++;?>
                                    @endforeach
                    </div>
                </div>
            </div>
            <div class="news-slider inner-slider-item">
                <div class="section-header">
                    <h3 class="section-title">{{$category_position_1->name}}</h3>
                    <div class="slider-indicators inner-news-slider-indicators">
                        <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                        <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
                <div class="inner-news-slider">
                    <div class="owl-carousel owl-theme">
                        <?php $x=0;?>
                        @foreach($posts_category_1 as $post)
                            @if($x==0 || $x==5)
                                <div class="item">
                                    <div class="row inner-slider">
                                        @endif
                                        @if($x!=2 && $x!=7)
                                            @if($x==0 || $x==3 || $x==5 ||$x==8)
                                                <div class="col-xs-12 col-sm-3 col-md-3">
                                                    @endif
                                                    <article class="main-news-item cat-item">
                                                        <a href="{{ return_post_link($post) }}" ><img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" ></a>
                                                        <div class="main-news-item-content">
                                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                                        </div>
                                                    </article>
                                                    @if($x==1 || $x==4 || $x==6 ||$x==9)
                                                </div>
                                            @endif
                                        @endif
                                        @if($x==2 || $x==7)
                                            @if($x==2 || $x==7)
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    @endif
                                                    <article class="main-news-item cat-item">
                                                        <a href="{{ return_post_link($post) }}" >
                                                            <img src="{{asset($post->photo->thump770)}}" title="{{$post->title}}" alt="{{$post->title}}" >
                                                        </a>
                                                            <div class="main-news-item-content">
                                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                                        </div>
                                                    </article>
                                                    @endif
                                                    @if($x==2 || $x==7)
                                                </div>
                                            @endif


                                            @if($x==4 || $x==9)
                                    </div>
                                </div>
                            @endif
                            <?php $x++;?>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="news-slider inner-slider-item">
                <div class="section-header">
                    <h3 class="section-title">{{$category_position_2->name}}</h3>
                    <div class="slider-indicators inner-news-slider-indicators">
                        <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                        <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
                <div class="inner-news-slider">
                    <div class="owl-carousel owl-theme">
                        <?php $x=0;?>
                        @foreach($posts_category_2 as $post)
                            @if($x==0 || $x==5)
                                <div class="item">
                                    <div class="row inner-slider">
                                        @endif
                                        @if($x!=2 && $x!=7)
                                            @if($x==0 || $x==3 || $x==5 ||$x==8)
                                                <div class="col-xs-12 col-sm-3 col-md-3">
                                                    @endif
                                                    <article class="main-news-item cat-item">
                                                        <a href="{{ return_post_link($post) }}" >
                                                            <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" >
                                                        </a>
                                                            <div class="main-news-item-content">
                                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                                        </div>
                                                    </article>
                                                    @if($x==1 || $x==4 || $x==6 ||$x==9)
                                                </div>
                                            @endif
                                        @endif
                                        @if($x==2 || $x==7)
                                            @if($x==2 || $x==7)
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    @endif
                                                    <article class="main-news-item cat-item">
                                                        <a href="{{ return_post_link($post) }}" >
                                                            <img src="{{asset($post->photo->thump770)}}" title="{{$post->title}}" alt="{{$post->title}}" >
                                                        </a>
                                                            <div class="main-news-item-content">
                                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                                        </div>
                                                    </article>
                                                    @endif
                                                    @if($x==2 || $x==7)
                                                </div>
                                            @endif


                                            @if($x==4 || $x==9)
                                    </div>
                                </div>
                            @endif
                            <?php $x++;?>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="news-slider inner-slider-item">
                <div class="section-header">
                    <h3 class="section-title">{{$category_position_3->name}}</h3>
                    <div class="slider-indicators inner-news-slider-indicators">
                        <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                        <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
                <div class="inner-news-slider">
                    <div class="owl-carousel owl-theme">
                        <?php $x=0;?>
                        @foreach($posts_category_3 as $post)
                            @if($x==0 || $x==5)
                                <div class="item">
                                    <div class="row inner-slider">
                                        @endif
                                        @if($x!=2 && $x!=7)
                                            @if($x==0 || $x==3 || $x==5 ||$x==8)
                                                <div class="col-xs-12 col-sm-3 col-md-3">
                                                    @endif
                                                    <article class="main-news-item cat-item">
                                                        <a href="{{ return_post_link($post) }}" >
                                                            <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" >
                                                        </a>
                                                            <div class="main-news-item-content">
                                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                                        </div>
                                                    </article>
                                                    @if($x==1 || $x==4 || $x==6 ||$x==9)
                                                </div>
                                            @endif
                                        @endif
                                        @if($x==2 || $x==7)
                                            @if($x==2 || $x==7)
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    @endif
                                                    <article class="main-news-item cat-item">
                                                        <a href="{{ return_post_link($post) }}" >
                                                            <img src="{{asset($post->photo->thump770)}}" title="{{$post->title}}" alt="{{$post->title}}" >
                                                        </a>
                                                            <div class="main-news-item-content">
                                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                                        </div>
                                                    </article>
                                                    @endif
                                                    @if($x==2 || $x==7)
                                                </div>
                                            @endif


                                            @if($x==4 || $x==9)
                                    </div>
                                </div>
                            @endif
                            <?php $x++;?>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="news-slider inner-slider-item">
                <div class="section-header">
                    <h3 class="section-title">{{$category_position_4->name}}</h3>
                    <div class="slider-indicators inner-news-slider-indicators">
                        <a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
                        <a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
                <div class="inner-news-slider">
                    <div class="owl-carousel owl-theme">
                        <?php $x=0;?>
                        @foreach($posts_category_4 as $post)
                            @if($x==0 || $x==5)
                                <div class="item">
                                    <div class="row inner-slider">
                                        @endif
                                        @if($x!=2 && $x!=7)
                                            @if($x==0 || $x==3 || $x==5 ||$x==8)
                                                <div class="col-xs-12 col-sm-3 col-md-3">
                                                    @endif
                                                    <article class="main-news-item cat-item">
                                                        <a href="{{ return_post_link($post) }}" >
                                                            <img src="{{asset($post->photo->thump370)}}" title="{{$post->title}}" alt="{{$post->title}}" >
                                                        </a>
                                                            <div class="main-news-item-content">
                                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                                        </div>
                                                    </article>
                                                    @if($x==1 || $x==4 || $x==6 ||$x==9)
                                                </div>
                                            @endif
                                        @endif
                                        @if($x==2 || $x==7)
                                            @if($x==2 || $x==7)
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    @endif
                                                    <article class="main-news-item cat-item">
                                                        <a href="{{ return_post_link($post) }}" >
                                                            <img src="{{asset($post->photo->thump770)}}" title="{{$post->title}}" alt="{{$post->title}}" >
                                                        </a>
                                                            <div class="main-news-item-content">
                                                            <a href="{{ return_post_link($post) }}" class="main-news-item-title">{{$post->title}}</a>
                                                        </div>
                                                    </article>
                                                    @endif
                                                    @if($x==2 || $x==7)
                                                </div>
                                            @endif


                                            @if($x==4 || $x==9)
                                    </div>
                                </div>
                            @endif
                            <?php $x++;?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection