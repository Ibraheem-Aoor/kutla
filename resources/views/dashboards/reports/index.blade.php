@extends('layouts.app')
@section('content')
    <reports-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fas fa-pencil-alt"></i>
                            <span class="caption-subject font-green bold uppercase">التقارير</span>
                        </div>
                        <div class="actions">
                            <a href="{{  route('reports.create') }}" class="btn btn-primary">إنشاء تقرير جديد</a>
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
                                <div class="col-sm-3">
                                    <select class="form-control" v-model="type" placeholder="نوع التقرير" >
                                        <option ></option>
                                        <option value="user">أداء المستخدمين</option>
                                        <option value="site">تقرير عام</option>

                                    </select>    </div>


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

                                  <table-column label="نوع التقرير"  show="type">
                                    <template scope="post">
                                        @{{ post.type=='site'?'تقرير احصائيات عامة' :'تقرير أداء الموظفين' }}
                                    </template>
                                </table-column>
                                <table-column label="الفترة من"  show="date_from"></table-column>
                                <table-column label="الفترة إلى"  show="date_to"></table-column>

                                <table-column label="الملف"  show="file">
                                    <template scope="post">
                                        <a :href="'{{asset('/')}}'+post.file">
                                            <button type="button" class="btn green-haze btn-outline sbold uppercase"> تحميل الملف</button>
                                        </a>
                                    </template>
                                </table-column>
                                <table-column label="" :sortable="false" :filterable="false">

                                <template scope="post">

                                        <a @click="deleteReport(post.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </template>
                                </table-column>
                            </table-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </reports-index>
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