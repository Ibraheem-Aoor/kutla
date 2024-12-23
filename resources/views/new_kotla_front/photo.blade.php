@extends('new_kotla_front.new_kotla_front_layout.master')
@section('title',$name)
@section('content')
    <div class="section section" >
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="0.2s">
                @foreach($images as $image)
                    <div class="col-lg-4 col-sm-6 mb-3 mt-2" >
                        <a class="widget__item-3 widget--1" href="{{asset($image->thump770)}}" data-rel="lightcase:image">
                            <div class="widget__item-image"><img src="{{asset($image->thump370)}}" alt=""></div>
                            {{--<div class="widget__item-icon"><i class="fas fa-play"></i></div>--}}
                        </a>
                    </div>

                @endforeach

            </div>

            {{--<div class="row wow fadeInUp" data-wow-delay="0.2s">--}}
                {{--@foreach($images as $image)--}}
                    {{--<div class="col-lg-4 col-sm-6">--}}
                        {{--<div class="widget__item-6" >--}}
                            {{--<div class="widget__item-image">--}}
                                {{--<a href="{{asset($image->thump770)}}"> <img src="{{asset($image->thump370)}}" alt="" /></a>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}

            {{--</div>--}}
        </div>
        <div class="row">
            <div class="col-12">
                {{ $images->links('pagination.custom') }}
            </div>
        </div>
    </div>

@stop
