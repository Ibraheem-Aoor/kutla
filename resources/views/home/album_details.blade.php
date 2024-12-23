@extends('home.main')

@section('content')
    <section class="section inner-page">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">{{$album->name}}</h3>
            </div>
            <div class="row album-inside-wrap">
                <div class="inner-news-title"><h3>{{$album->details}}</h3></div>
                @foreach($images as $image)
                    <?php
                    if($image->photo_caption && $image->photo_caption!='undefined'){
                        $title=$image->photo_caption;
                    }else{
                        $title=$image->album->name;
                    }
                    ?>

                <div class="col-xs-12 col-sm-4">
                    <article class="main-news-item cat-item album-item">
                        <a href="{{asset($image->thump770)}}" data-fancybox="gallery" data-caption="{{ $title }}">
                            <img  src="{{asset($image->thump370)}}" title="{{ $title }}" alt="{{ $image->album?$image->album->name:'' }}" />
                        </a>
                        <div class="main-news-item-content">
                            <a href="{{asset($image->thump770)}}" data-fancybox="gallery" data-caption="{{ $title }}"><span>{{ $title}}</span></a>
                        </div>
                    </article>
                </div>
                    @endforeach

            </div>
        </div>
    </section>


@endsection