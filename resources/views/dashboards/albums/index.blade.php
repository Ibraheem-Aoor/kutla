@extends('layouts.app')
@section('content')

    <alboms-index :categories='{!! $categories->toJson() !!}' :cases='{!! isset($cases) ? $cases : 'null' !!}'   inline-template>

        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">الألبومات</span>
                </div>
                <div class="actions">
                    @if(in_array('add_album',$actions))
                    <a href="{{  route('albums.create') }}" class="btn btn-primary">إضافة ألبوم</a>
               @endif
                </div>
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

                <div class="row" v-if="alboms_arr.length">

                    {{--albom Box--}}
                    <div  v-for="albom in alboms_arr" class=" col-sm-3 ">
                        <div class="portlet light portlet-fit bordered">
                            <div class="portlet-title" style="height: 100px; overflow: hidden;">
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green bold uppercase">@{{ albom.name }} </span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="mt-element-overlay">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mt-overlay-4 mt-overlay-4-icons" style="height: 117px;">
                                                <img  :src="'{{asset('/')}}'+getCover(albom)">
                                                <div class="mt-overlay">
                                                    {{--<h2>@{{albom.name}}</h2>--}}
                                                    <ul class="mt-info">
                                                        <li>
                                                            <a class="btn default btn-outline" data-toggle="tooltip" title="عرض الألبوم" :href="'{{asset('/')}}dashboard/albums/'+albom.id">
                                                                <i class="icon-magnifier"></i>
                                                            </a>
                                                        </li>
                                                            @if(in_array('edit_album',$actions))
                                                        <li>
                                                            <a class="btn default btn-outline" data-toggle="tooltip" title="تعديل الألبوم" :href="'{{asset('/')}}dashboard/albums/'+albom.id+'/edit'">
                                                                <i class="icon-pencil"></i>
                                                            </a>
                                                        </li>
                                                        @endif
                                                            @if(in_array('delete_album',$actions))
                                                        <li>
                                                            <button @click="delAlbom(albom.id)" class="btn default btn-outline" data-toggle="tooltip" title="حذف الألبوم" >
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </li>
                                                                @endif
                                                        <li style="margin-top: 5px; color: white;">
                                                            <span>المشاهدات (@{{ albom.read_no }})</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--albom Box--}}

                </div>
                <div v-else class="note note-info">
                    <h4 class="block">عذرا لم يتم ايجاد نتائج لعملية البحث !</h4>
                </div>
                {{--<nav aria-label="Page navigation">--}}
        {{--<ul class="pagination">--}}
            {{--<li v-bind:class="{ 'disabled': !pagination.prev_page_url }">--}}
                {{--<a href="#" aria-label="First" @click.prevent="switchPage(1)">--}}
                    {{--<span aria-hidden="true" v-html="first"></span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li v-bind:class="{ 'disabled': !pagination.prev_page_url }">--}}
                {{--<a href="#" aria-label="Previous" @click.prevent="switchPage(pagination.current_page - 1)">--}}
                    {{--<span aria-hidden="true" v-html="previous"></span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li--}}
                    {{--v-for="page in pagesLeft"--}}
                    {{--class="page-item"--}}
                    {{--v-bind:class="{ 'active': pagination.current_page === page }"--}}
            {{-->--}}
                {{--<a href="#" @click.prevent="switchPage(page)">@{{ page }}</a>--}}
            {{--</li>--}}

            {{--<li--}}
                    {{--v-if="pagination.last_page > 10 && pagesMiddle && pagesMiddle.length"--}}
                    {{--class="page-item"--}}
            {{-->--}}
                {{--<a href="javascript:;">...</a>--}}
            {{--</li>--}}
            {{--<li--}}
                    {{--v-if="pagination.last_page > 10 && pagesMiddle && pagesMiddle.length"--}}
                    {{--v-for="page in pagesMiddle"--}}
                    {{--class="page-item"--}}
                    {{--v-bind:class="{ 'active': pagination.current_page === page }"--}}
            {{-->--}}
                {{--<a href="#" @click.prevent="switchPage(page)">@{{ page }}</a>--}}
            {{--</li>--}}
            {{--<li--}}
                    {{--v-if="pagination.last_page > 10 && pagesMiddle && pagesMiddle.length"--}}
                    {{--class="page-item"--}}
            {{-->--}}
                {{--<a href="javascript:;">...</a>--}}
            {{--</li>--}}

            {{--<li--}}
                    {{--v-if="pagination.last_page > 10 && !pagesMiddle"--}}
                    {{--class="page-item"--}}
            {{-->--}}
                {{--<a href="javascript:;">...</a>--}}
            {{--</li>--}}

            {{--<li--}}
                    {{--v-if="pagesRight.length"--}}
                    {{--v-for="page in pagesRight"--}}
                    {{--class="page-item"--}}
                    {{--v-bind:class="{ 'active': pagination.current_page === page }"--}}
            {{-->--}}
                {{--<a href="#" @click.prevent="switchPage(page)">@{{ page }}</a>--}}
            {{--</li>--}}
            {{--<li v-bind:class="{ 'disabled': !pagination.next_page_url }">--}}
                {{--<a href="#" aria-label="Next" @click.prevent="switchPage(pagination.current_page + 1)">--}}
                    {{--<span aria-hidden="true" v-html="next"></span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li v-bind:class="{ 'disabled': !pagination.next_page_url }">--}}
                {{--<a href="#" aria-label="Last" @click.prevent="switchPage(pagination.last_page)">--}}
                    {{--<span aria-hidden="true" v-html="last"></span>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</nav>--}}

            </div>
        </div>
    </alboms-index>

@endsection

@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/dist/theme-chalk.css') }}">

    <style>
        .el-picker-panel__content.el-date-range-picker__content.is-left{
            float: right;
        }
        .el-date-editor.el-input, .el-date-editor.el-input__inner{
            width: 472px !important;
        }
    </style>