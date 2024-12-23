@extends('layouts.app')
@section('content')
    <posts-people   inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">أخبار المتابعين</span>
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
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" placeholder="العنوان " v-model="title" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="المرسل " v-model="user" class="form-control">
                                </div>


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

                        <div class="row">
                        <div class="table-scrollable">
                            <table-component ref="table" :data="fetchData" :table-class="'table table-striped table-bordered table-hover'"
                            :filter-input-class="'form-control'"
                            :show-filter="false"
                            :show-caption="false"
                            sort-by="created_at"
                            sort-order="desc"
                            filter-no-results="عذرا, لقد تعذر وجود بيانات!"
                            >

                                <table-column label="عنوان الخبر" show="title"> </table-column>


                                <table-column label="المحرر" show="name"></table-column>
                                <table-column label="تاريخ الإضافة" show="created_at_days"></table-column>
                                <table-column label="" :sortable="false" :filterable="false">

                                    <template scope="post">

                                        <a @click="DetailsPost(post)" href="javascript:;" data-toggle="modal" data-target="#show_reserv">
                                            التفاصيل
                                        </a>

                                    </template>
                                </table-column>
                            </table-component>
                        </div>
                        </div>

                </div>

                <div class="modal" id="show_reserv" tabindex="-1" role="basic" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style=" width: 514px;right: 23%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" >تفاصيل الخبر </h4>
                            </div>
                            <div class="modal-body">

                                <div class="table-scrollable"  v-if="post">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr >
                                            <th class="text-center">المحرر </th>
                                            <th class="text-center">@{{ post.name }} </th>
                                        </tr>
                                        <tr >
                                            <th class="text-center"> عنوان الخبر </th>
                                            <th class="text-center">@{{ post.title }} </th>
                                        </tr>
                                        <tr >
                                            <th class="text-center"> تاريخ الارسال </th>
                                            <th class="text-center">@{{ post.created_at }} </th>
                                        </tr>
                                        <tr >
                                            <th class="text-center"> التفاصيل </th>
                                            <th class="text-center">@{{ post.details }} </th>
                                        </tr>

                                        </thead>
                                    </table>
                                </div><div v-else>عذرا حدثت مشكلة</div>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn dark btn-outline" data-dismiss="modal" >الغاء الأمر</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

            </div>
        </div>
    </posts-people>
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
@endpush