@extends('home.main')

@section('content')

    <section class="section inner-page">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">نتائج البحث عن : {{$key}}</h3>
            </div>
            <div class="row mix-section">
                @if(count($posts)>0)
                @foreach($posts as $post)
                <div class="col-xs-6 col-md-3">
                    <article class="article-slider-item">
                        <div class="article-img">
                            <img src="{{asset($post->photo->thump)}}" title="{{$post->title}}" alt="{{$post->title}}"  />
                        </div>
                        <a href="{{ return_post_link($post) }}">
                            <span class="article-date"><i class="fa fa-clock-o"></i>  {{returnDateFormay($post->published_at)}}</span>
                            <span style=" height: 45px;  overflow: hidden;">@if($post->view_type_id_new!=1)<lable style="color:red;font-size: unset;font-weight: unset;"> {{$post->view_type->name}}: </lable>@endif{{$post->title}}</span>
                        </a>
                    </article>
                </div>
               @endforeach
                    @else
                    <div class="col-xs-12 col-md-12">
                        <h2>عذا !. لا يوجد نتائج</h2>
                    </div>
                @endif
            </div>
            <div class="site-pagination text-center">
                {{ $posts->appends(['key' => $key])->links() }}

            </div>
</div>
</section>



@endsection