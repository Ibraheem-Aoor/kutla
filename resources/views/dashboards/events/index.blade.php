@extends('layouts.app')
@section('content')
    <events-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fas fa-pencil-alt"></i>
                            <span class="caption-subject font-green bold uppercase">الأجندة</span>
                        </div>
                        <div class="actions">
                            <a href="{{  route('events.create') }}" class="btn btn-primary">إضافة حدث</a>
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
                                <table-column label="التفاصيل" show="details"></table-column>
                                <table-column label="موعد التذكير" show="remember_date"></table-column>
                                <table-column label="المستخدمين المراد تذكيرهم">
                                    <template scope="post"><button type="button" data-toggle="modal" @click="showDetails(post)" data-target="#event_details"  class="btn green-haze btn-outline sbold uppercase"> تفاصيل المستخدمين</button></template>
                                </table-column>
                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="post">
                                        @if(in_array('edit_events',$actions))
                                        <a :href="'{{asset('/')}}dashboard/events/'+post.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_events',$actions))
                                        <a @click="deleteEvent(post.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>@endif
                                    </template>
                                </table-column>
                            </table-component>
                        </div>
                    </div>
                </div>
                <div class="modal" id="event_details" tabindex="-1" role="basic" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style=" width: 514px;right: 23%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" v-if="remember && remember.users_events">  المستخدمين المراد تذكيريهم لـ: @{{remember.name }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-scrollable"  v-if="remember && remember.users_events.length">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr >
                                            <th class="text-center">المستخدم </th>
                                            <th class="text-center">هل شاهد التذكير؟ </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="sub in remember.users_events">
                                            <td class="text-center">  @{{sub.user.name}}</td>
                                            <td class="text-center">  @{{sub.remember==1?'نعم':'لا'}} </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div><div v-else>عذرا لا يوجد بيانات</div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal" >الغاء الأمر</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

            </div>
        </div>
    </events-index>
@endsection