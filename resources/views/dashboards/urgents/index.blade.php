@extends('layouts.app')
@section('content')
    <urgents-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">الأخبار العاجلة</span>
                        </div>
                        <div class="actions">
                            @if(in_array('add_urgent',$actions))
                            <a href="{{  route('urgents.create') }}" class="btn btn-primary">إضافة خبر عاجل</a>
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

                            <table-column label="الخبر" show="title"></table-column>
                                
                             <table-column label="مدة الظهور" show="duration"></table-column>
                             <table-column label="الرابط" show="url"></table-column>

                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="urgent">
                                        @if(in_array('edit_urgent',$actions))
                                        <a :href="'{{asset('/')}}dashboard/urgents/'+urgent.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_urgent',$actions))
                                        <a @click="deleteUrgent(urgent.id)" href="javascript:;">
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
    </urgents-index>
@endsection