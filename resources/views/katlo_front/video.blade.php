@extends('katlo_front.katlo_fron_layout.master')
@section('title',$name)
@if(isset($video_sharing))
    @push('meta')

        <meta content="website" property="og:type">
        <meta property="og:url" content="{{route('show_video',$video_sharing->id)}}">
        <meta name="twitter:url" content="{{route('show_video',$video_sharing->id)}}">
        <meta property="og:title" content="{{$video_sharing->name}}">
        <meta name="description" property="og:description" content="{{str_limit(strip_tags($video_sharing->name,200)) }}">
        <meta property="og:image" content="{{$video_sharing->image_url}}">
    @endpush
@endif
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
    .media_post {
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
                <?php $count = 1?>
                @foreach($videos as $video)
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-box"  onclick="getVideoUrl(this)" data-video_id="{{$video->id}}">
                            <a data-fancybox="gallery" class="videos-gallery" href="{{asset($video->video_link)}}"  ><div  class='media_post' style="position: absolute;  right: 23px;  bottom: 35px;z-index: 1111;">
                                    <h4 class="title" style="color: #f7f7f7;">{{$video->name}}</h4>
                                </div></a>
                            <div class="blog-box-pic">
                                <div class="shadow"></div>
                                <a href="{{asset($video->video_link)}}"  data-fancybox="gallery" class="videos-gallery" >
                                    <img src="{{asset($video->image_url)}}" class=" img-fluid"  alt="blog-post">
                                </a>

                            </div>
                            {{--<div class="blog-box-content">--}}
                            {{--<h4 class="title" style="min-height: 50px;">{{ $image->album?$image->album->name:'' }}</h4>--}}
                            {{--<p class="time-ago"><i class="far fa-clock"></i> {{returnDateFormay($post->created_at,true)}}</p>--}}
                            {{--<p class="description">{{str_limit(strip_tags($post->descriptions,200)) }} <a href="{{return_post_link($post)}}">اقرأ المزيد</a></p>--}}
                            {{--<p class="count text-right mb-0">--}}
                            {{--<span><i class="fa fa-eye"></i> {{$post->view_count}}</span>--}}
                            {{--</p>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                        <?php $count++; ?>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    {{ $videos->appends(request()->input())->links() }}
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
    @if(isset($video_sharing))
        <script>
            $.fancybox.open({
                src  : '{{$video_sharing->video_link}}',
                type : 'video',
                opts : {
                    afterShow : function( instance, current ) {
                        console.info( 'done!' );
                    }
                }
            });
        </script>
    @endif
    <script>
        var ID ='';
        $('.videos-gallery').fancybox({
            // Options will go here
            smallBtn: "auto",

            // Should display toolbar (buttons at the top)
            // Can be true, false, "auto"
            // If "auto" - will be automatically hidden if "smallBtn" is enabled
            toolbar: "auto",
            buttons: [
                "zoom",
                "share",
                "slideShow",
                //"fullScreen",
                //"download",
                "thumbs",
                "close"
            ],
            share: {
                url: function(instance, item) {
                    console.log(instance);
                    // // let url  =(
                    // //     (!instance.currentHash && !(item.type === "inline" || item.type === "html") ? item.origSrc || item.src : false) || window.location
                    // // );
                    let url2 =(window.location.origin+'/video/'+ID);
                    //
                    // return decodeURI(url2);//decodeURI()  ;

                    return url2;
                },
                tpl:
                    '<div class="fancybox-share">' +
                    "<h1>مشاركة عبر</h1>" +
                    "<p>" +
                    '<a class="fancybox-share__button fancybox-share__button--fb" href="https://www.facebook.com/sharer/sharer.php?u=@{{url_raw}}">' +
                    '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m287 456v-299c0-21 6-35 35-35h38v-63c-7-1-29-3-55-3-54 0-91 33-91 94v306m143-254h-205v72h196" /></svg>' +
                    "<span>Facebook</span>" +
                    "</a>" +
                    '<a class="fancybox-share__button fancybox-share__button--tw" href="https://twitter.com/intent/tweet?url=@{{url_raw}}&text=@{{descr}}">' +
                    '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m456 133c-14 7-31 11-47 13 17-10 30-27 37-46-15 10-34 16-52 20-61-62-157-7-141 75-68-3-129-35-169-85-22 37-11 86 26 109-13 0-26-4-37-9 0 39 28 72 65 80-12 3-25 4-37 2 10 33 41 57 77 57-42 30-77 38-122 34 170 111 378-32 359-208 16-11 30-25 41-42z" /></svg>' +
                    "<span>Twitter</span>" +
                    "</a>" +
                    '<a class="fancybox-share__button fancybox-share__button--pt" href="https://www.pinterest.com/pin/create/button/?url=@{{url_raw}}&description=@{{descr}}&media=@{{media}}">' +
                    '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m265 56c-109 0-164 78-164 144 0 39 15 74 47 87 5 2 10 0 12-5l4-19c2-6 1-8-3-13-9-11-15-25-15-45 0-58 43-110 113-110 62 0 96 38 96 88 0 67-30 122-73 122-24 0-42-19-36-44 6-29 20-60 20-81 0-19-10-35-31-35-25 0-44 26-44 60 0 21 7 36 7 36l-30 125c-8 37-1 83 0 87 0 3 4 4 5 2 2-3 32-39 42-75l16-64c8 16 31 29 56 29 74 0 124-67 124-157 0-69-58-132-146-132z" fill="#fff"/></svg>' +
                    "<span>Pinterest</span>" +
                    "</a>" +
                    "</p>" +
                    '<p><input class="fancybox-share__input" type="text" value="@{{url_raw}}" /></p>' +
                    "</div>"}
        });


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
        function getVideoUrl(e){
             ID =   $(e).data('video_id');
             console.log(ID);
        }


    </script>
@endpush