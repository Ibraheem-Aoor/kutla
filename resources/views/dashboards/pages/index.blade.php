@extends('layouts.app')
@section('content')
    <pages-index   inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">الصفحات</span>
                        </div>
                        {{--<div class="actions">--}}
                            {{--@if(in_array('add_page',$actions))--}}
                            {{--<a href="{{  route('pages.create') }}" class="btn btn-primary">إضافة صفحة</a>--}}
                                {{--@endif--}}
                        {{--</div>--}}
                    </div>

                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table-component ref="table" :data="fetchData" :table-class="'table table-striped table-bordered table-hover'"
                            :filter-input-class="'form-control'"
                            :filter-placeholder="'بحث'"
                            :show-caption="false"
                            sort-by="created_at"
                            sort-order="desc"
                             filter-no-results="عذرا, لقد تعذر وجود بيانات!"
                            >

                                <table-column label="عنوان الصفحة" show="name"></table-column>
                                <table-column label="الحالة" show="active">
                                    <template scope="post">
                                        <span>@{{ getPostActive(post.active) }}</span>
                                    </template>
                                </table-column>

                                <table-column label="عدد القراءات" show="read_number"></table-column>
                                <table-column label="" :sortable="false" :filterable="false">

                                    <template scope="post">
                                        @if(in_array('edit_page',$actions))
                                        <a :href="'{{asset('/')}}dashboard/pages/'+post.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_page',$actions))
                                        <a @click="deletePage(post.id)" href="javascript:;" v-if="post.id<5">
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
        </div>
    </pages-index>
@endsection
