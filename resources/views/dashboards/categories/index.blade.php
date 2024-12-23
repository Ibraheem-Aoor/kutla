@extends('layouts.app')
@section('content')
    <categories-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">التصنيفات</span>
                        </div>
                        <div class="actions">
                            @if(in_array('add_cat',$actions))
                            <a href="{{  route('categories.create') }}" class="btn btn-primary">إضافة تصنيف</a>
                        @endif
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

                            <table-column label="العنوان" show="name"></table-column>
                            {{--<table-column label="النوع" show="type">--}}
                                {{--<template scope="category">--}}
                                    {{--<span>@{{ getTypeName(category.type) }}</span>--}}
                                {{--</template>--}}
                            {{--</table-column>--}}

                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="category">
                                        @if(in_array('edit_cat',$actions))
                                        <a :href="'{{asset('/')}}dashboard/categories/'+category.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_cat',$actions))
                                        <a @click="deleteCategory(category.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                                @endif
                                    </template>
                                </table-column>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </categories-index>
@endsection