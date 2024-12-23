@extends('home.main')

@section('content')
    <section class="section inner-page">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">{{$page->name}}</h3>
            </div>
            <div class="row">
               {!! $page->details !!}
            </div>

        </div>
    </section>



@endsection