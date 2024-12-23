@extends('layouts.app')
@section('content')
    <writers-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fas fa-pencil-alt"></i>
                            <span class="caption-subject font-green bold uppercase">الكتاب</span>
                        </div>
                        <div class="actions">
                            <a href="{{  route('writers.create') }}" class="btn btn-primary">إضافة كاتب</a>
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
                                {{--<table-column label="التصنيف"  show="category.name"></table-column>--}}
                                <table-column label="الوصف" show="description"></table-column>
                                <table-column label="عدد المقالات"  >
                                    <template scope="writer">
                                        @{{ writer.posts?writer.posts.length:0 }}
                                    </template>
                                </table-column>
                                <table-column label="تاريخ الإضافة" show="created_at_days"></table-column>

                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="writer">
                                        @if(in_array('edit_writer',$actions))
                                        <a :href="'{{asset('/')}}dashboard/writers/'+writer.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_writer',$actions))
                                        <a @click="deleteWriter(writer.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>@endif
                                    </template>
                                </table-column>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </writers-index>
@endsection