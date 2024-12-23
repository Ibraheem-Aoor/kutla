@extends('layouts.app')
@section('content')
    <cases-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fas fa-pencil-alt"></i>
                            <span class="caption-subject font-green bold uppercase">الملفات الخاصة</span>
                        </div>
                        <div class="actions">
                            <a href="{{  route('cases.create') }}" class="btn btn-primary">إضافة ملف خاص</a>
                        </div>
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

                            <table-column label="الاسم" show="name"></table-column>
                                  <table-column label="الحالة"  show="active">
                                    <template scope="post">
                                        @{{ post.active==1?'منشور' :'غير منشور' }}
                                    </template>
                                </table-column>
								 <table-column label="المنشورات"  show="posts">
                                    <template scope="post">
                                        <a :href="'{{asset('/')}}dashboard/posts/'+post.id+'/cases'">
                                            <button type="button" class="btn green-haze btn-outline sbold uppercase"> @{{ post.posts.length }}</button>
                                        </a>
                                    </template>
                                </table-column>
                                <table-column label="الفيديوهات"  show="videos">
                                    <template scope="post">
                                        <a :href="'{{asset('/')}}dashboard/videos/'+post.id+'/cases'">
                                            <button type="button" class="btn green-haze btn-outline sbold uppercase"> @{{ post.videos.length }}</button>
                                        </a>
                                    </template>
                                </table-column>
                                <table-column label="البومات الصور"  show="albums">
                                    <template scope="post">
                                        <a :href="'{{asset('/')}}dashboard/albums/'+post.id+'/cases'">
                                            <button type="button" class="btn green-haze btn-outline sbold uppercase"> @{{ post.albums.length }}</button>
                                        </a>
                                    </template>
                                </table-column>
                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="post">
                                        @if(in_array('edit_case',$actions))
                                        <a :href="'{{asset('/')}}dashboard/cases/'+post.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_case',$actions))
                                        <a @click="deleteCase(post.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>@endif
                                    </template>
                                </table-column>
                            </table-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </cases-index>
@endsection