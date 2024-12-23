@extends('home.main')

@section('content')

    <section class="section inner-page">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">{{$category->name}}</h3>
            </div>
            <div class="row mix-section">
                @foreach($posts as $post)
                    <div class="col-xs-6 col-md-3">
                        <article class="article-slider-item">
                            <div class="article-img">
                                <a href="{{ return_post_link($post) }}" class="img-anchor">
                                    <img src="{{asset($post->photo->thump)}}" title="{{$post->title}}" alt="{{$post->title}}" style="width: 100%"  />
                                </a>
                            </div>
                            <a href="{{ return_post_link($post) }}">
                                <span class="article-date"><i class="fa fa-clock-o"></i>  {{returnDateFormay($post->published_at)}}</span>
                                <span style=" height: 45px;  overflow: hidden;">@if($post->view_type_id_new!=1)<lable style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </lable>@endif{{$post->title}}</span>
                            </a>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="site-pagination text-center">

                {{ $posts->links() }}

            </div>
        </div>
    </section>



@endsection