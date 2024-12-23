@extends('layouts.app')
@section('content')
    <votes-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fas fa-pencil-alt"></i>
                            <span class="caption-subject font-green bold uppercase">الاستفتاءات</span>
                        </div>
                        <div class="actions">
                            <a href="{{  route('votes.create') }}" class="btn btn-primary">إضافة استفتاء</a>
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
                                  <table-column label="الحالة"  show="photo_id">
                                    <template scope="vote">
                                        @{{ vote.active==1 ? 'منشور': 'غير منشور' }}
                                    </template>
                                </table-column>
                                {{--<table-column label="التصنيف"  show="category_id">--}}
                                    {{--<template scope="vote">--}}
                                        {{--@{{ vote.category ? vote.category.name:'' }}--}}
                                    {{--</template>--}}
                                {{--</table-column>--}}
                                <table-column label="تاريخ البداية" show="start_date"></table-column>
                                <table-column label="تاريخ النهاية" show="end_date"></table-column>
                                <table-column label="تاريخ النشر" show="created_at_days"></table-column>
                                <table-column label="تفاصيل" >
                                    <template scope="item">
                                        <a  class="btn btn-outline-accent vote_details" :id="item.id" href="javascript:;">
                                            تفاصيل
                                        </a>
                                    </template>

                                </table-column>
                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="vote">
                                        @if(in_array('edit_vote',$actions))
                                        <a :href="'{{asset('/')}}dashboard/votes/'+vote.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_vote',$actions))
                                        <a @click="deleteVote(vote.id)" href="javascript:;">
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
    </votes-index>
    @include('dashboards/all_modal')

@endsection
@include('dashboards/java_script_function')