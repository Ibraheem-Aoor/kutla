@extends('layouts.app')
@section('content')
    <videos-index :categories='{!! $categories->toJson() !!}' :cases='{!! isset($cases) ? $cases : 'null' !!}'    inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">الفيديوهات</span>
                        </div>
                        <div class="actions">
                            @if(in_array('add_video',$actions))
                            <a href="{{  route('videos.create') }}" class="btn btn-primary">إضافة فيديو</a>
                        </div>
                        @endif
                    </div>
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-search"></i>بحث </div>
                            <div class="tools">

                                <a href="" class="expand" data-original-title="" title="" aria-describedby="tooltip959187"> </a>
                            </div>
                        </div>
                        <div class="portlet-body form" style="display: none;">
                            <br/>
                            <div class="row" style="padding: 5px;">
                                <div class="col-sm-3">
                                    <input type="text" placeholder="العنوان " v-model="title" class="form-control">
                                </div>


                                {{--<div class="form-group col-sm-3" >--}}
                                    {{--<v-select v-model="category_id" track-by="id" label="name" placeholder="اختر التصنيف" :options="categories" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>--}}
                                {{--</div>--}}


                                <div class="col-sm-6">

                                    <div class="form-group" >

                                        <div class="block">
                                            <el-date-picker
                                                    v-model="value6"
                                                    type="daterange"
                                                    range-separator="إلى"
                                                    start-placeholder="تاريخ البداية"
                                                    end-placeholder="تاريخ النهاية">
                                            </el-date-picker>
                                        </div>
                                    </div>
                                </div>

                                {{--Actions--}}
                                <div class="col-sm-2">
                                    <button @click="searchResult" class="btn btn-primary">  بحث</button>
                                    <button @click="cancelSearch" class="btn btn-danger">  الغاء</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table-component ref="table" :data="fetchData" :table-class="'table table-striped table-bordered table-hover'"
                            :filter-input-class="'form-control'"
                            :filter-placeholder="'بحث'"
                            :show-filter="false"
                            :show-caption="false"
                            sort-by="created_at"
                            sort-order="desc"
                                             filter-no-results="عذرا, لقد تعذر وجود بيانات!"
                            >

                            <table-column label="العنوان" show="name" >
                                <template scope="album"><div class="edit_case":style="[album.main ? {'background-color': '#c0a41b75'} : '']" >@{{ album.name }}</div></template>
                            </table-column>
                                {{--<table-column label="التصنيف" :sortable="false" :filterable="false">--}}
                                    {{--<template scope="category">--}}
                                        {{--@{{ category.category.name }}--}}
                                    {{--</template>--}}
                                {{--</table-column>--}}
                            <table-column label="تاريخ النشر" show="published_at"></table-column>
                            {{--<table-column label="الملف الخاص" show="case_id">--}}
                                {{--<template scope="video"><div class="edit_case">@{{ video.cases? video.cases.name:''}}</div></template>--}}
                            {{--</table-column>--}}
                                <table-column label="عرض الفيديو" :sortable="false" :filterable="false">
                                    <template scope="category">
                                        <button  class=" btn purple btn-outline sbold" @click="openVideo(category)">
                                            <i class="fa fa-play"></i>
                                            مشاهدة الفيديو</button>

                                    </template>
                                </table-column>
                                <table-column label="عدد المشاهدات" show="watchNo"></table-column>
                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="category">
                                        @if(in_array('edit_video',$actions))
                                        <a :href="'{{asset('/')}}dashboard/videos/'+category.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_video',$actions))
                                        <a @click="deleteCategory(category.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                                @endif
                                    </template>
                                </table-column>
                            </table-component>
                        </div>
                    </div>
                </div>
            </div>


            {{--Start Modal --}}
            <div id="static" class="modal bs-modal-lg fade" tabindex="-1" data-backdrop="static" data-keyboard="false" >
                <div class="modal-dialog  modal-lg"  style="height: 410px">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" @click="closeVideo()" class="close"  aria-hidden="true"></button>
                            <h4 class="modal-title">مشاهدة الفيديو</h4>
                        </div>
                        <div class="modal-body">
                            <div class="portlet-body">
                                <ul class="nav nav-tabs">

                                    <li v-if="video_select && video_select.youtube_link" :class="returnClassY(video_select)">
                                        <a  href="#tab_1_2" data-toggle="tab" aria-expanded="true"> يويتيوب </a>
                                    </li>
                                    <li v-if="video_select && video_select.file_name" :class="returnClassF(video_select)">
                                        <a  href="#tab_1_3" data-toggle="tab" aria-expanded="true"> فيديو </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in" :class="returnClassY(video_select)" id="tab_1_2">
                                        <iframe v-if="video_select && video_select.youtube_link" width="800" height="400" :src="'https://www.youtube.com/embed/'+getName(video_select.youtube_link)" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <div class="tab-pane fade in" :class="returnClassF(video_select)" id="tab_1_3">



                                    </div>
                            </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{--Start Modal --}}


                            {{--<video--}}
                                    {{--id="vid1"--}}
                                    {{--class="video-js vjs-default-skin"--}}
                                    {{--controls--}}
                                    {{--autoplay--}}
                                    {{--width="640" height="264"--}}
                                    {{--data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v=xjS6SftYQaQ"}] }'--}}
                            {{-->--}}
                            {{--</video>--}}


            {{--//Test--}}

        </div>
    </videos-index>
@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/dist/theme-chalk.css') }}">

    <style>
        .edit_case{
            width: 172px;
            font-size: 13px;
        }
        .el-picker-panel__content.el-date-range-picker__content.is-left{
            float: right;
        }
        .el-date-editor.el-input, .el-date-editor.el-input__inner{
            width: 472px !important;
        }
    </style>
@endpush