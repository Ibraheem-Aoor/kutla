@extends('layouts.app')
@section('content')
    <hotels-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-building"></i>
                            <span class="caption-subject font-green bold uppercase">الفنادق</span>
                        </div>
                        <div class="actions">
                            <a href="{{  route('hotels.create') }}" class="btn btn-primary">إضافة فندق</a>
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
                                <table-column label="العنوان" show="address"></table-column>
                                <table-column label="الموبايل" show="mobile"></table-column>
                                <table-column label="الهاتف" show="phone"></table-column>


                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="hotel">
                                        @if(in_array('edit_hotel',$actions))
                                        <a :href="'{{asset('/')}}dashboard/hotels/'+hotel.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_hotel',$actions))
                                        <a @click="deleteHotel(hotel.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>@endif
                                    </template>
                                </table-column>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </hotels-index>
@endsection