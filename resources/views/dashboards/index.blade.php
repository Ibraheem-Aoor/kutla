@extends('layouts.app')

@section('content')

    <?php
    $actions = \App\Models\ActionRole::where('role_id', auth()->user()->role_id)->pluck('name')->toArray();

    ?>

    @if(in_array('add_post',$actions))
        {{--<div class="row">--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a class="dashboard-stat dashboard-stat-v2 blue" href="#">--}}
                    {{--<div class="visual">--}}
                        {{--<i class="fa fa-clock-o"></i>--}}
                    {{--</div>--}}
                    {{--<div class="details">--}}
                        {{--<div class="number">--}}
                            {{--<span data-counter="counterup" data-value="{{$all_visitor}}">{{$all_visitor}}</span>--}}
                        {{--</div>--}}
                        {{--<div class="desc">  زوار الشهر </div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a class="dashboard-stat dashboard-stat-v2 green" href="#">--}}
                    {{--<div class="visual">--}}
                        {{--<i class="fa fa-bar-chart-o"></i>--}}
                    {{--</div>--}}
                    {{--<div class="details">--}}
                        {{--<div class="number">--}}
                            {{--<span data-counter="counterup" data-value="{{$visitor_from_gaza}}">{{$visitor_from_gaza}}</span> </div>--}}
                        {{--<div class="desc">  زيارات الشهر </div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a class="dashboard-stat dashboard-stat-v2 red" href="#">--}}
                    {{--<div class="visual">--}}
                        {{--<i class="fa fa-times-circle"></i>--}}
                    {{--</div>--}}
                    {{--<div class="details">--}}
                        {{--<div class="number">--}}
                            {{--<span data-counter="counterup" data-value="{{$vistor_from_palestine}}">{{$vistor_from_palestine}}</span>--}}
                        {{--</div>--}}
                        {{--<div class="desc">منشورات اليوم </div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a class="dashboard-stat dashboard-stat-v2 purple" href="#">--}}
                    {{--<div class="visual">--}}
                        {{--<i class="fa fa-newspaper-o"></i>--}}
                    {{--</div>--}}
                    {{--<div class="details">--}}
                        {{--<div class="number">--}}
                            {{--<span data-counter="counterup" data-value="{{$vistor_form_out}}">{{$vistor_form_out}}</span> </div>--}}
                        {{--<div class="desc">  زيارات اليوم </div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a class="dashboard-stat dashboard-stat-v2 green-soft" href="#">--}}
                    {{--<div class="visual">--}}
                        {{--<i class="fa fa-user"></i>--}}
                    {{--</div>--}}
                    {{--<div class="details">--}}
                        {{--<div class="number">--}}
                            {{--<span data-counter="counterup" data-value="{{$all_artical}}">{{$all_artical}}</span> </div>--}}
                        {{--<div class="desc"> زوار فلسطين </div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a class="dashboard-stat dashboard-stat-v2 yellow" href="#">--}}
                    {{--<div class="visual">--}}
                        {{--<i class="fa fa-check-circle"></i>--}}
                    {{--</div>--}}
                    {{--<div class="details">--}}
                        {{--<div class="number">--}}
                            {{--<span data-counter="counterup" data-value="{{$all_post}}">{{$all_post}}</span> </div>--}}
                        {{--<div class="desc"> زوار خارج فلسطين </div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}

       {{-- <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$all_post}}">{{$all_post}}</span>
                        </div>
                        <div class="desc"> إجمالي عدد المنشورات </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$all_post_not_active}}">{{$all_post_not_active}}</span> </div>
                        <div class="desc"> إجمالي عدد المنشورات المسودة </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-navicon"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$all_artical}}">{{$all_artical}}</span>
                        </div>
                        <div class="desc"> إجمالي عدد المقالات </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-suitcase"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$all_cases_post}}">{{$all_cases_post}}</span> </div>
                        <div class="desc"> إجمالي عدد منشورات الملفات الخاصة </div>
                    </div>
                </a>
            </div>
        </div>--}}
{{--        <div class="row widget-row">
            <div class="col-md-2">
                <div class="dashboard-stat2 bordered">
                    <div class="display" >
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup"
                                      data-value="{{$monthly_views}}">{{$monthly_views}}</span>
                            </h3>
                            <small> إجمالي القراءات</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="status">
                            <div class="status-number font-red-haze"> آخر شهر</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup"
                                      data-value="{{$daily_views}}">{{$daily_views}}</span>
                            </h3>
                            <small>إجمالي القراءات</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="status">
                            <div class="status-number font-red-haze"> هذا اليوم</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup" data-value="{{$monthly_posts}}">{{$monthly_posts}}</span>
                            </h3>
                            <small> عدد الأخبار</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="status">
                            <div class="status-number font-red-haze">آخر شهر</div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-2">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup" data-value="{{$daily_posts}}">{{$daily_posts}}</span>
                            </h3>
                            <small> عدد الأخبار</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="status">
                            <div class="status-number font-red-haze">هذا اليوم</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup"
                                      data-value="{{$monthly_photo_galleries}}">{{$monthly_photo_galleries}}</span>
                            </h3>
                            <small> عدد الألبومات</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-camera"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="status">
                            <div class="status-number font-red-haze"> آخر شهر</div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup"
                                      data-value="{{$monthly_Videos}}">{{$monthly_Videos}}</span>
                            </h3>
                            <small> عدد الفيديو</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-film"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="status">
                            <div class="status-number font-red-haze"> آخر شهر</div>
                        </div>

                    </div>
                </div>
            </div>


        </div>--}}
        <div class="col-md-12">
            <div class=" row dashboard-stat2 bordered">
                <div class="col-md-12">
                    <div class="clearfix">

                        <a href="{{ route('posts.create') }}" class="btn grey-mint"
                           data-style="expand-right">
                            <span class="ladda-label">إضافة منشور</span>
                            <span class="ladda-spinner"></span></a>
                        <a href="{{ route('albums.create') }}" class="btn blue-dark"
                           data-style="expand-up">
                            <span class="ladda-label">إضافة ألبوم صور</span>
                            <span class="ladda-spinner"></span></a>
                        <a href="{{ route('videos.create') }}" class="btn grey-mint"
                           data-style="expand-down">
                            <span class="ladda-label">إضافة مقطع فيديو</span>
                            <span class="ladda-spinner"></span></a>



                    </div>
                </div>

            </div>
        </div>


    @endif
    <div >


        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university1}}">{{$university1}}</span>
                        </div>
                        <div class="desc">  منشورات  جامعة بيرزيت</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university2}}">{{$university2}}</span> </div>
                        <div class="desc"> منشورات  جامعة النجاح </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-navicon"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university3}}">{{$university3}}</span>
                        </div>
                        <div class="desc"> منشورات  جامعة البوليتكنك </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-suitcase"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university4}}">{{$university4}}</span> </div>
                        <div class="desc">  منشورات  جامعة الخليل </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university5}}">{{$university5}}</span>
                        </div>
                        <div class="desc">  منشورات  الكلية العصرية</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university6}}">{{$university6}}</span> </div>
                        <div class="desc"> منشورات  جامعة القدس/أبو ديس </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-navicon"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university7}}">{{$university7}}</span>
                        </div>
                        <div class="desc"> منشورات  دار المعلمين </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-suitcase"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university8}}">{{$university8}}</span> </div>
                        <div class="desc">  منشورات  جامعة فلسطين الأهلية </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university9}}">{{$university9}}</span>
                        </div>
                        <div class="desc"> منشورات جامعة الخضوري</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$university10}}">{{$university10}}</span> </div>
                        <div class="desc"> منشورات  جامعة الأمريكية </div>
                    </div>
                </a>
            </div>
        </div>
    {{--<div class="row">--}}
        {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
        {{--<a href="{{route('posts.create')}}" class="btn btn-lg green" style="width: 110%"> إضافة منشور--}}
            {{--<i class="fa fa-plus"></i>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
            {{--<a href="{{route('writers.create')}}" class="btn btn-lg green" style="width: 110%"> إضافة كاتب--}}
                {{--<i class="fa fa-plus"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
            {{--<a href="{{route('urgents.create')}}" class="btn btn-lg green" style="width: 110%"> إضافة خبر عاجل--}}
                {{--<i class="fa fa-plus"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
            {{--<a href="{{route('videos.create')}}" class="btn btn-lg green" style="width: 110%"> إضافة فيديو--}}
                {{--<i class="fa fa-plus"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
            {{--<a href="{{route('albums.create')}}" class="btn btn-lg green" style="width: 110%"> إضافة ألبوم صور--}}
                {{--<i class="fa fa-plus"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
            {{--<a href="{{route('events.create')}}" class="btn btn-lg green" style="width: 110%"> إضافة أجندة--}}
                {{--<i class="fa fa-plus"></i>--}}
            {{--</a>--}}
        {{--</div>--}}

    {{--</div>--}}
        {{--<br/>--}}
    {{--<div class="row">--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a href="{{route('posts.index')}}" class="btn btn-lg blue" style="width: 110%"> المنشورات--}}
                    {{--<i class="fa fa-newspaper-o"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a href="{{route('writers.index')}}" class="btn btn-lg blue" style="width: 110%">الكتاب--}}
                    {{--<i class="fa fa-group"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a href="{{route('urgents.index')}}" class="btn btn-lg blue" style="width: 110%"> الأخبار العاجلة--}}
                    {{--<i class="fa fa-fast-forward"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a href="{{route('videos.index')}}" class="btn btn-lg blue" style="width: 110%"> الفيديوهات--}}
                    {{--<i class="icon-film"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a href="{{route('albums.index')}}" class="btn btn-lg blue" style="width: 110%"> ألبومات الصور--}}
                    {{--<i class="icon-picture"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">--}}
                {{--<a href="{{route('events.index')}}" class="btn btn-lg blue" style="width: 110%"> الأحداث--}}
                    {{--<i class="fa fa-calendar"></i>--}}
                {{--</a>--}}
            {{--</div>--}}

        {{--</div>--}}
    </div>



@endsection
