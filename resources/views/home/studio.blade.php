@extends('home.main')

@section('content')
    <section class="section inner-page">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">معرض الصور</h3>
            </div>
            <div class="row studio">
                @foreach($images as $image)
                <div class="col-xs-12 col-sm-4">
                    <article class="main-news-item cat-item album-item">
                        <a href="{{asset($image->thump770)}}" data-fancybox="gallery" data-caption="{{ $image->album?$image->album->name:'' }}">
                        <img  src="{{asset($image->thump370)}}" title="{{ $image->album?$image->album->name:'' }}" alt="{{ $image->album?$image->album->name:'' }}" />
                        </a>
                            <div class="main-news-item-content">
                            <a href="{{asset($image->thump770)}}" data-fancybox="gallery" data-caption="{{ $image->album?$image->album->name:'' }}"><span>{{ $image->album?$image->album->name:'' }}</span></a>
                        </div>
                    </article>
                </div>
              @endforeach
            </div>
            <div class="site-pagination text-center">

                {{ $images->links() }}

            </div>
        </div>
    </section>


@endsection