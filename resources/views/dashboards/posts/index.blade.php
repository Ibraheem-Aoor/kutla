@extends('layouts.app')
@section('content')
    <posts-index :posts='{{$posts->toJson()}}' :post_more='{{json_encode($post_more)}}' :users='{!! $users->toJson() !!}'
                 :categories='{!! $categories->toJson() !!}' :view_types='{!! $view_types->toJson() !!}' :tag='{!! isset($tag) ? $tag : 'null' !!}' :cases='{!! isset($cases) ? $cases : 'null' !!}' inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-newspaper-o font-green"></i>
                            <span class="caption-subject font-green bold uppercase">المنشورات</span>
                        </div>
                        <div class="actions">
                            @if(in_array('add_post',$actions))
                            <a href="{{  route('posts.create') }}" class="btn btn-primary">إضافة منشور</a>
                                @endif
                        </div>
                    </div>

                  {{--  <div class="portlet box blue">
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

                                <div class="form-group col-sm-4" >
                                    <v-select v-model="view_type_id" track-by="id" label="name" placeholder="اختر الصنف" :options="view_types" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                </div>
                                <div class="form-group col-sm-4" >
                                    <v-select v-model="category_id" track-by="id" label="name" placeholder="اختر التصنيف" :options="categories" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                </div>
                                <div class="form-group col-sm-4" >
                                    <v-select v-model="active_post" track-by="id" label="name" placeholder="اختر نوع الحفظ" :options="actives" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                </div>

                                <div class="col-sm-6">


                                </div>

                                --}}{{--Actions--}}{{--
                                <div class="col-sm-2">
                                    <button @click="searchResult" class="btn btn-primary">  بحث</button>
                                    <button @click="cancelSearch" class="btn btn-danger">  الغاء</button>
                                </div>

                            </div>
                        </div>
                    </div>--}}

                        <div class="row">
                            <div class="col-sm-2">
                                <input type="text" placeholder="العنوان " v-model="title" class="form-control">
                            </div>
                            <div class=" col-sm-2">
                                <v-select v-model="category_id" track-by="id" label="name" placeholder="اختر التصنيف" :options="categories" :searchable="true" :allow-empty="true" select-label="" deselect-label=""></v-select>

                            </div>
                            <div class=" col-sm-2">
                                <v-select v-model="c_type" track-by="id" label="name" placeholder="اختر نوع المنشور" :options="c_types" :searchable="true" :allow-empty="true" select-label="" deselect-label=""></v-select>

                            </div>
                            <div class=" col-sm-2">
                                <v-select v-model="user" track-by="id" label="name" placeholder="اختر المستخدم" :options="users" :searchable="true" :allow-empty="true" select-label="" deselect-label=""></v-select>

                            </div>



                            <div class="col-sm-4">
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

                            {{--Actions--}}
                            <div class="col-sm-2">
                                <button @click="searchResult" class="btn green-meadow"> تصفية</button>
                                <button @click="cancelSearch" class="btn grey-cascade"> إلغاء</button>
                            </div>

                            <div class="col-md-12" >
                                <div v-if="result_count!='' " style="color: chocolate;">إجمالي عدد النتائج : @{{ result_count }}</div>
                        <div class="table-scrollable">
                            {{--<table-component ref="table" :data="fetchData" :table-class="'table table-striped table-bordered table-hover'"--}}
                            {{--:filter-input-class="'form-control'"--}}
                            {{--:show-filter="false"--}}
                            {{--:show-caption="false"--}}
                            {{--sort-by="created_at"--}}
                            {{--sort-order="desc"--}}
                            {{--filter-no-results="عذرا, لقد تعذر وجود بيانات!"--}}
                            {{-->--}}

                                {{--<table-column label="عنوان المنشور" show="title">--}}
                                    {{--<template scope="post" >--}}
                                        {{--<span v-if="post.position"><i class="fa fa-map-pin"></i></span>--}}
                                        {{--<span style="color:red" v-if="post.view_type_id && post.view_type_id!=1">@{{ post.view_type.name }} : </span>--}}
                                        {{--<span>@{{  post.title }}</span>--}}

                                    {{--</template>--}}
                                {{--</table-column>--}}
                                {{--<table-column label="التصنيف" show="category_id">--}}
                                    {{--<template scope="post">--}}
                                        {{--<span>@{{ post.category ? post.category.name : '' }}</span>--}}
                                    {{--</template>--}}
                                {{--</table-column>--}}
                        {{--        <table-column label="نوع المنشور" show="type">--}}
                                    {{--<template scope="post">--}}
                                        {{--<span v-if="post.type">@{{ getPostType(post.type) }}</span>--}}
                                    {{--</template>--}}
                                {{--</table-column>--}}
                                {{--<table-column label="الحالة" show="active">--}}
                                    {{--<template scope="post">--}}
                                        {{--<span class="badge badge-info badge-roundless" v-if="post.active==1">@{{ getPostActive(post.active) }}</span>--}}
                                        {{--<span class="badge badge-default badge-roundless" v-else>@{{ getPostActive(post.active) }}</span>--}}
                                    {{--</template>--}}
                                {{--</table-column>--}}
                                {{--<table-column label="تاريخ النشر" show="published_at_days"></table-column>--}}
                                {{--<table-column label="تاريخ الإضافة" show="created_at_days"></table-column>--}}
                                {{--<table-column label="المحرر" show="user_id">--}}
                                    {{--<template scope="post">--}}
                                        {{--<span>@{{ post.user ? post.user.name : '' }}</span>--}}
                                    {{--</template>--}}
                                {{--</table-column>--}}
                                {{--<table-column label="عدد القراءات" show="read_number"></table-column>--}}
                                {{--<table-column label="" :sortable="false" :filterable="false">--}}

                                    {{--<template scope="post">--}}
                                        {{--@if(in_array('edit_post',$actions))--}}
                                        {{--<a :href="'{{asset('/')}}dashboard/posts/'+returnID(post)+'/edit'"  class="btn btn-xs blue">--}}
                                            {{--<i aria-hidden="true" class="fa fa-pencil"></i>--}}
                                        {{--</a> @endif--}}
                                            {{--@if(in_array('delete_post',$actions))--}}
                                        {{--<a @click="deletePost(returnID(post))" href="javascript:;" class="btn btn-xs red filter-cancel">--}}
                                            {{--<i aria-hidden="true" class="fa fa-times"></i>--}}
                                        {{--</a>--}}
                                                {{--@endif--}}
                                    {{--</template>--}}
                                {{--</table-column>--}}
                            {{--</table-component>--}}


                            <table class="table-component__table table table-striped table-bordered table-hover" id="table1">
                                <thead class="table-component__table__head">
                                <tr>
                                    <th role="columnheader" aria-sort="none" class="table-component__th">عنوان المنشور</th>
                                    <th role="columnheader" aria-sort="none" class="table-component__th" width="10%">الموقع</th>
                                    <th role="columnheader" aria-sort="none" class="table-component__th">التصنيف</th>
                                    <th role="columnheader" aria-sort="none" class="table-component__th">الحالة</th>
                                    <th role="columnheader" aria-sort="none" class="table-component__th">تاريخ النشر</th>
                                    <th role="columnheader" aria-sort="none" class="table-component__th">المحرر</th>
                                    <th role="columnheader" aria-sort="none" class="table-component__th">عدد القراءات</th>

                                </tr>
                                <tbody class="table-component__table__body">

                                <tr v-for="(post,index) in all_posts" style="cursor: all-scroll;" :style="[post.main||post.main2 ? {'background-color': '#c0a41b75'} : '']" >
                                <td class="title_post">

                                    <a  target="_blank" :href="'{{asset('/')}}post/'+returnID(post)+'/'+getUrl(post)">
                                <span style="color:red" v-if="post.view_type_id && post.view_type_id!=1">@{{ post.view_type.name }} : </span>
                                <span>@{{  post.title }}</span>
                                    </a>
                                    <div  class="editor">
                                    @if(in_array('edit_post',$actions))
                                        <a  :href="'{{asset('/')}}dashboard/posts/'+returnID(post)+'/edit'"  class="btn btn-xs blue">
                                            <i aria-hidden="true" class="fa fa-pencil"></i>
                                        </a> @endif
                                    @if(in_array('delete_post',$actions))
                                        <a @click="deletePost(returnID(post),index)" href="javascript:;" class="btn btn-xs red filter-cancel">
                                            <i aria-hidden="true" class="fa fa-times"></i>
                                        </a>
                                    @endif
                                        @if(in_array('add_post',$actions) || in_array('edit_post',$actions))
                                            <button @click="UnPublishPost(returnID(post),index)" type="button" class="btn btn-warning" style="font-size: 10px" v-if="post.active==1">
                                               الغاء نشر
                                            </button>
                                            <button @click="publishPost(returnID(post),index)" type="button" class="btn btn-success"  style="font-size: 10px" v-if="post.active==0">
                                              نشر
                                            </button>
                                        @endif

                                    </div>
                                </td>
                                    <td>
                                        <span class="badge badge-info badge-roundless" v-if="post.slider">سلايدر</span>
                                        <span class="badge badge-info badge-roundless" v-if="post.main_news">أخبار</span>
                                        <span class="badge badge-info badge-roundless" v-if="post.chosen">بيان</span>
                                        <span class="badge badge-info badge-roundless" v-if="post.private_file">ملف خاص</span>
                                    </td>
                                <td>@{{ post.category ? post.category.name : '' }}</td>
                                {{--<td><span v-if="post.type">@{{ getPostType(post.type) }}</span></td>--}}
                                <td>
                                <span class="badge badge-info badge-roundless" v-if="post.active==1">@{{ getPostActive(post.active) }}</span>
                                <span class="badge badge-default badge-roundless" v-else>@{{ getPostActive(post.active) }}</span>
                                </td>
                                <td>@{{ post.published_at }}</td>
                                <td>@{{ post.user ? post.user.name : '' }}</td>
                                <td>@{{ post.read_number }}</td>

                                </tr>
                                <tr v-if="all_posts.length==0">  <td colspan="6">عذرا! . لا يوجد نتائج</td></tr>

                            </table>


                            <table style="display: none;">

                                <tfoot>
                                <tr>
                                    <td colspan="3" id="logarea">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><button type="button" onclick="$.rowSorter.destroy('#table1', true);">Destroy way 1</button> <button type="button" onclick="destroyRowSorter();">Destroy way 2</button></td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                                <div class="actions">
                                    <center><button type="button" class="btn green-meadow" v-if="has_more" @click="loadMore()">تحميل المزيد <i  v-if="load_news" id="loader" class="fa fa-spinner fa-spin"></i></button></center>
                                </div>
                        </div>
                        </div>
                </div>
                <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 335px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" v-if="show_post">@{{show_post.title}}</h4>
                            </div>
                            <div class="modal-body"><table class="table-component__table table table-striped table-bordered table-hover" id="table1">
                                    <thead class="table-component__table__head">
                                    <tr>
                                        <th role="columnheader" aria-sort="none" class="table-component__th"><img src="{{asset('homeStyle/')}}/images/like.png" /></th>
                                        <th role="columnheader" aria-sort="none" class="table-component__th" >@{{ count_like }}</th>
                                        </tr>
                                    <tr>
                                        <th role="columnheader" aria-sort="none" class="table-component__th"><img src="{{asset('homeStyle/')}}/images/haha.png" /></th>
                                        <th role="columnheader" aria-sort="none" class="table-component__th" >@{{ count_haha }}</th>
                                    </tr>
                                    <tr>
                                        <th role="columnheader" aria-sort="none" class="table-component__th"><img src="{{asset('homeStyle/')}}/images/wow.png" /></th>
                                        <th role="columnheader" aria-sort="none" class="table-component__th" >@{{ count_wow }}</th>
                                    </tr>
                                    <tr>
                                        <th role="columnheader" aria-sort="none" class="table-component__th"><img src="{{asset('homeStyle/')}}/images/sad.png" /></th>
                                        <th role="columnheader" aria-sort="none" class="table-component__th" >@{{ count_sad }}</th>
                                    </tr>
                                    <tr>
                                        <th role="columnheader" aria-sort="none" class="table-component__th"><img src="{{asset('homeStyle/')}}/images/angry.png" /></th>
                                        <th role="columnheader" aria-sort="none" class="table-component__th" >@{{ count_angry }}</th>

                                    </tr>


                                </table> </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
    </posts-index>
@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/dist/theme-chalk.css') }}">

    <style>
        .editor {
            display: none;
        }
        .title_post:hover .editor{
            display: block;
        }
        .el-picker-panel__content.el-date-range-picker__content.is-left{
            float: right;
        }
        .multiselect {
            box-sizing: content-box;
            display: block;
            position: relative;
            width: 100%;
            min-height: 40px;
            text-align: right;
            color: #35495e;
        }
      /*  .el-date-editor.el-input, .el-date-editor.el-input__inner{
            width: 472px !important;
        }*/
    </style>

@endpush
@push('scripts')

    <script type="text/javascript" src="{{asset('assets/table/RowSorter.js')}}"></script>

    <script type="text/javascript">
        // var logarea = document.getElementById("logarea");
        // function log(text)
        // {
        //     logarea.innerHTML = text;
        // }
        //
        // var sorter = $('#table1').rowSorter({
        //     onDragStart: function(tbody, row, index)
        //     {
        //         //log('index: ' + index);
        //         log('onDragStart: active row\'s index is ' + index);
        //     },
        //     onDrop: function(tbody, row, new_index, old_index)
        //     {
        //         //log('old_index: ' + old_index + ', new_index: ' + new_index);
        //         console.log('onDrop: row moved from ' + old_index + ' to ' + new_index);
        //         app.$children[0].colFunction();
        //     }
        // });
        //
        // function destroyRowSorter()
        // {
        //     sorter.destroy();
        // }

    </script>

@endpush