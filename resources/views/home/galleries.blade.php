@extends('home.main')

@section('content')
    <section class="section inner-page">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">ألبومات الصور</h3>
            </div>
            <div class="row">
                @foreach($albums as $album)
                <div class="col-xs-12 col-sm-6">
                    <article class="main-news-item cat-item album-item">
                        @if($album->photoscover)<img  src="{{asset($album->photoscover->thump770)}}" title="{{$album->name}}" alt="{{$album->name}}" />
                        @else
                            <a href="{{ url('galleries/'.$album->id.'/'.(implode('-',explode(' ',$album->name)))) }}">
                            <img  src="{{asset($album->cover)}}" title="{{$album->name}}" alt="{{$album->name}}" />
                            </a>
                        @endif                        <div class="main-news-item-content">
                            <a href="{{ url('galleries/'.$album->id.'/'.(implode('-',explode(' ',$album->name)))) }}" class="main-news-item-title"><i class="fa fa-picture-o"></i> <span>{{$album->name}}</span></a>
                        </div>
                    </article>
                </div>
                    @endforeach
            </div>
            <div class="site-pagination text-center">

                    {{ $albums->links() }}

            </div>
        </div>
    </section>



@endsection