@extends('new_kotla_front.new_kotla_front_layout.master')
@section('title','من نحن')
@section('content')
<style>
    .blog-details p {
        margin-bottom: 15px;
        font-size: 16px;
        text-align: justify;
        line-height: 1.6;
    }
</style>
    <div class="section section" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <div class="blog-title">
                        <h3 class="text-primary">من نحن</h3>
                    </div>
                    <div class="blog-details">
                        {!! $setting->details !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop

