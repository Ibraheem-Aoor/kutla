@extends('layouts.app')
@section('content')
    <user_logs-index  :users='{!! $users->toJson() !!}'  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">سجل حركات المستخدمين</span>
                        </div>
                        <div class="actions">

                        </div>
                    </div>

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-search"></i>بحث </div>
                            <div class="tools">

                                <a href="" class="collapse" data-original-title="" title="" aria-describedby="tooltip959187"> </a>
                            </div>
                        </div>
                        <div class="portlet-body form" >
                            <br/>
                            <div class="row" style="    padding-right: 10px;    padding-left: 10px;">
                                <div class="form-group col-sm-4" >
                                    <v-select v-model="user_id" track-by="id" label="name" placeholder="اختر المستخدم" :options="users" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                </div>

                                <div class="col-sm-4">
                                    <v-select v-model="event" track-by="id" label="name" placeholder="اختر نوع الحركة" :options="events" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                </div>

                                <div class="col-sm-4">
                                    <v-select v-model="table" track-by="id" label="name" placeholder="اختر السجل" :options="tables" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                </div>
                            </div>
                            <div class="row" style="    padding-right: 10px;">

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
                            <div>إجمالي عدد الحركات : @{{ logs_count }}</div>
                        <div class="table-scrollable">
                            <table-component ref="table" :data="fetchData" :table-class="'table table-striped table-bordered table-hover'"
                            :filter-input-class="'form-control'"
                            :show-filter="false"
                            :show-caption="false"
                            sort-by="created_at"
                            sort-order="desc"
                            filter-no-results="عذرا, لقد تعذر وجود بيانات!"
                            >

                                <table-column label="العنوان" show="title">
                                    <template scope="post">
                                        <span>@{{getTitle(post.record_new) }}</span>
                                    </template>
                                </table-column>
                                <table-column label="السجل" show="logable_type">
                                    <template scope="post">
                                        <span v-if="post.logable_type">@{{ getPostTable(post.logable_type) }}</span>
                                    </template>
                                </table-column>

                                <table-column label="نوع الحركة" show="event">
                                    <template scope="post">
                                        <span v-if="post.event">@{{ getPostType(post.event) }}</span>
                                    </template>
                                </table-column>
                                <table-column label="المستخدم" show="user_id">
                                    <template scope="post">
                                        <span>@{{ post.user ? post.user.name : '' }}</span>
                                    </template>
                                </table-column>
                                <table-column label="تاريخ الحركة" show="time"></table-column>

                            </table-component>
                        </div>
                        </div>

                </div>
            </div>
        </div>
    </user_logs-index>
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