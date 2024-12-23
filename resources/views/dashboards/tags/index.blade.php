@extends('layouts.app')
@section('content')
    <tags-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">الوسوم</span>
                        </div>
                        {{--<div class="actions">--}}
                            {{--<a href="{{  route('categories.create') }}" class="btn btn-primary">إضافة تصنيف</a>--}}
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


                                <table-column label="العنوان">

                                    <template scope="tag">

                                        <a :href="'{{asset('dashboard/posts/')}}/'+tag.name">
                                            @{{ tag.name }}
                                        </a>
                                    </template>
                                </table-column>
                                <table-column label="عدد الأخبار" show="post_count"></table-column>
                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="tag">
                                        @if(in_array('edit_tag',$actions))
                                        <a @click="deleteTag(tag.id)" href="javascript:;">
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
    </tags-index>
@endsection