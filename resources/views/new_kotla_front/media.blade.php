@extends('new_kotla_front.new_kotla_front_layout.master')
@section('title',$name)
@section('content')
    <div class="section section" >
        <div class="container">

            <div class="row wow fadeInUp" data-wow-delay="0.2s">
                @foreach($alboms as $image)
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget__item-6">
                            <div class="widget__item-image">
                                <a href="{{route('new.alboms.images',$image->id)}}"> <img src="{{asset($image->cover)}}" alt="" /></a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{ $alboms->links('pagination.custom') }}
            </div>
        </div>
    </div>

@stop
