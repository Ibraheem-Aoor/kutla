@extends('katlo_front.katlo_fron_layout.master')
@section('title',$name)
<style>
    .blog-box-pic:after {
        position: absolute;
        content: "";
        width: 92%;
        height: 50%;
        bottom: 30px;
        left: -14px;
        right: 15px;
        transition: all 0.5s ease;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(4, 4, 4, 1) 100%);
    }
    .media_post{
        display: block;

    }
</style>
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
            <div class="row align-items-center">
                <div class="col-lg-4 col-12 custom-form">
                    <div class="input-group">
                        <input type="text"  name ='search' id="search" class="form-control bg-light" placeholder="اكتب ما تريد البحث عنه هنا" required>
                        <div class="input-group-btn">
                            <button type="button"  onclick="searchFunction(this)" data-type="search" class="btn btn-primary"> بحث</button>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-4 col-12 custom-form">--}}
                    {{--<div class="input-group">--}}
                        {{--<div class="input-group-prepend">--}}
                            {{--<label class="input-group-text" >عرض حسب</label>--}}
                        {{--</div>--}}
                        {{--<select  name='showUsing' id="showUsing"  class="custom-select">--}}
                            {{--<option value="date">التاريخ</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2 col-12 custom-form">--}}
                    {{--<a href="javascript: void(0)" onclick="searchFunction(this)" id="asc" data-val="asc" data-type="sort" class="btn btn-primary"><i class="fas fa-angle-up"></i></a>--}}
                    {{--<a href="javascript: void(0)" onclick="searchFunction(this)" id="desc" data-val="desc" data-type="sort" class="btn btn-primary"><i class="fas fa-angle-down"></i></a>--}}
                {{--</div>--}}
            </div>

            <div class="row">
                @foreach($alboms as $image)
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-box">
                            <a href="{{route('alboms.images',$image->id)}}" ><div  class='media_post' style="position: absolute;  right: 23px;  bottom: 35px;z-index: 1111;">
                                <h4 class="title" title="{{$image->title}}"  style="color: #f7f7f7;">{{$image->name}}</h4>
                                <small style="color: #f7f7f7;">{{count($image->photos)}}</small>
                                </div></a>
                            <div class="blog-box-pic">
                                <div class="shadow"></div>
                                <a href="{{route('alboms.images',$image->id)}}" >
                                    <img src="{{asset($image->cover)}}" class=" img-fluid"  alt="blog-post">
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
                    {{ $alboms->appends(request()->query())->links() }}
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