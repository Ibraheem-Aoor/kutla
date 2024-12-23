@extends('layouts.app')
@section('content')
    <advs-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">الإعلانات</span>
                        </div>
                        <div class="actions">
                            @if(in_array('add_adv',$actions))
                            <a href="{{  route('advs.create') }}" class="btn btn-primary">إضافة إعلان</a>
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

                            <table-column label="العنوان" show="title"></table-column>
                                <table-column label="الصفحة" show="page">
                                    <template scope="adv">
                                        @{{ getPage(adv.page)}}
                                    </template>
                                </table-column>
                                <table-column label="مكان الظهور" show="position">
                                    <template scope="adv">
                                        <span>@{{ getPosition(adv)}}</span>
                                    </template>
                                </table-column>
                                <table-column label="الظهور على مستوى الدول" show="location">
                                    <template scope="adv">
                                        <span>@{{ getLocation(adv.location)}}</span>
                                    </template>
                                </table-column>
                                <table-column label="الحالة" show="active">
                                    <template scope="adv">
                                        @{{ adv.active==1? 'منشور' : 'غير منشور' }}</span>
                                    </template>
                                </table-column>

                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="adv">
                                        @if(in_array('edit_adv',$actions))
                                        <a :href="'{{asset('/')}}dashboard/advs/'+adv.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_adv',$actions))
                                        <a @click="deleteAdv(adv.id)" href="javascript:;">
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
    </advs-index>
@endsection