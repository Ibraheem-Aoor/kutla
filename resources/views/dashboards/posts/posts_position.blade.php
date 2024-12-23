@extends('layouts.app')
@section('content')
    <posts-position  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">المنشورات المثبتة</span>
                        </div>
                        <div class="actions">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table-component ref="table" :data="fetchData" :table-class="'table table-hover'"
                            :filter-input-class="'form-control'"
                            :filter-placeholder="'بحث'"
                            :show-caption="false"
                            sort-by="created_at"
                            sort-order="desc"
                                             filter-no-results="عذرا, لقد تعذر وجود بيانات!"
                            >

                                <table-column label="عنوان المنشور" show="title">
                                    <template scope="post">
                                        <span style="color:red" v-if="post.view_type_id!=1">@{{ post.view_type.name }} : </span>
                                        <span>@{{  post.title }}</span>
                                    </template>
                                </table-column>
                                <table-column label="التصنيف" show="category_id">
                                    <template scope="post">
                                        <span>@{{ post.category ? post.category.name : '' }}</span>
                                    </template>
                                </table-column>
                                <table-column label="نوع المنشور" show="type">
                                    <template scope="post">
                                        <span>@{{ getPostType(post.type) }}</span>
                                    </template>
                                </table-column>
                                <table-column label="الحالة" show="active">
                                    <template scope="post">
                                        <span>@{{ getPostActive(post.active) }}</span>
                                    </template>
                                </table-column>
                                <table-column label="تاريخ النشر" show="published_at_days"></table-column>
                                <table-column label="تاريخ الإضافة" show="created_at_days"></table-column>
                                <table-column label="المحرر" show="user_id">
                                    <template scope="post">
                                        <span>@{{ post.user ? post.user.name : '' }}</span>
                                    </template>
                                </table-column>
                                <table-column label="التثبيت" show="position">
                                    <template scope="post">
                                        <span>@{{ post.position ? post.position.name : '' }}</span>
                                    </template>
                                </table-column>
                                <table-column label="" :sortable="false" :filterable="false">

                                    <template scope="post">

                                        @if(in_array('edit_album',$actions))
                                        <a @click="deletePost(post.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="إزالة التثبيت"></i>
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
    </posts-position>
@endsection
