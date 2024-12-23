@extends('katlo_front.katlo_fron_layout.master')
@section('title',$name)
@section('content')
    {{--<section class="big-banner post-banner mb-0" style="background-image:url({{count($posts)?$posts[0]->image_url:'front_kotli/assets/img/post-5.png'}})">--}}
    {{--<div class="container"> --}}
    {{--<div class="row"> --}}
    {{--<div class="col-lg-12">  --}}
    {{--<h1 class="title">{{$name}}</h1>--}}
    {{--<nav aria-label="breadcrumb">--}}
    {{--<ol class="breadcrumb">--}}
    {{--<li class="breadcrumb-item"><a href="/">الرئيسية</a></li>--}}
    {{--<li class="breadcrumb-item active" aria-current="page">{{$name}}</li>--}}
    {{--</ol>--}}
    {{--</nav>    --}}
    {{--</div>  --}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section> --}}

    <section class="blog-page">
        <div class="container">
            <div class="blog-title" style="margin-bottom: 30px;">
                <h3 class="text-primary">{{isset($albom)?$albom->name:''}}</h3>
            </div>

            <div class="row">
                @foreach($images as $image)
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-box">
                            <div class="blog-box-pic">
                                <div class="shadow"></div>
                                <a href="{{asset($image->thump770)}}" data-fancybox="gallery">
                                    <img src="{{asset($image->thump370)}}" class=" img-fluid"  alt="blog-post">
                                </a>

                            </div>
                            {{--<h4  style="min-height: 50px;">عنوان الالبوم</h4>--}}
                            {{--<div class="blog-box-content">--}}
                            {{--<h4 class="title" style="min-height: 50px;">عنوان الالبوم</h4>--}}
                            {{--<p class="time-ago"><i class="far fa-clock"></i> {{returnDateFormay($post->created_at,true)}}</p>--}}
                            {{--<p class="description">{{str_limit(strip_tags($post->descriptions,200)) }} <a href="{{return_post_link($post)}}">اقرأ المزيد</a></p>--}}
                            {{--<p class="count text-right mb-0">--}}
                            {{--<span><i class="fa fa-eye"></i> 5</span>--}}
                            {{--</p>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                   
                    {{ $images->appends(request()->query())->links() }}
                    {{--<nav aria-label="Page navigation example">--}}
                    {{--<ul class="pagination justify-content-center">--}}
                    {{--<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>--}}
                    {{--<li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
                    {{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                    {{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                    {{--<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>--}}
                    {{--</ul>--}}
                    {{--</nav>--}}
                </div>
            </div>
        </div>
    </section>
@stop
@push('js')
    <script>
        function searchFunction(e) {

            let field_name= $(e).data('type');
            let field_value;
            if(field_name =='sort'){
                field_value= $(e).data('val');
            }else{
                field_value= $('#'+field_name).val();
            }

            let url = window.location.href;
            let url_fileter = new URL(url);
            let c = url_fileter.searchParams.get(field_name);
            var queryParameters = {}, queryString = location.search.substring(1),
                re = /([^&=]+)=([^&]*)/g, m;


            while (m = re.exec(queryString)) {
                queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }

            queryParameters[field_name] = field_value;

            if(!field_value){
                delete queryParameters[field_name];
                //let index = queryParameters.indexOf();
                //console.log(index);
            }
            location.search = $.param(queryParameters);
        }
    </script>
@endpush