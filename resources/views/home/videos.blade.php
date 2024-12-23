@extends('home.main')

@section('content')

    <section class="section inner-page">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">الفيديو</h3>
            </div>
            <div class="row mix-section">
                @foreach($videos as $video)
                <div class="col-xs-6 col-md-3">
                    <article class="article-slider-item">
                        <div class="article-img">
                            <a data-fancybox="video_group" data-src='{{asset("home/getVideoMedia/".$video->id)}}' data-type="ajax"  title="{{$video->name}}" >
                                <img src="{{asset($video->photo->thump)}}" alt="{{$video->name}}" title="{{$video->title}}" >
                                <i class="video-icon" style="cursor: pointer;"></i>
                            </a>
                        </div>
                        <p style="height: 40px;">
                            <a data-fancybox="video_group" style="cursor: pointer;" data-src='{{asset("home/getVideoMedia/".$video->id)}}' data-type="ajax"  title="{{$video->name}}" >
                                {{substring($video->name,100)}}</a>
                        </p>

                    </article>
                </div>
               @endforeach
            </div>
            <div class="site-pagination text-center">

                {{ $videos->links() }}

            </div>
        </div>
    </section>



@endsection