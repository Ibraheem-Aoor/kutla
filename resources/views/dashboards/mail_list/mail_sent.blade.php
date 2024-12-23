@extends('layouts.app')
@section('content')
    <mail_list-sent  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">القائمة المرسلة</span>
                        </div>
                        <div class="actions">

                                <a href="{{ route('mail_list.send') }}" class="btn btn-primary">إرسال جديد</a>

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
                                <table-column label="وقت الارسال" show="created_at"></table-column>
                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="mail">



                                        <a @click="showPost(mail)" data-toggle="modal" data-target="#post_array" href="javascript:;">
                                            المنشورات المرسلة
                                        </a>

                                    </template>
                                </table-column>
                            </table-component>
                        </div>
                    </div>
                </div>
                <div class="modal" id="post_array" tabindex="-1" role="basic" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style=" width: 614px;right: 23%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" v-if="post_array">  المنشورات المرسلة</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-scrollable"  v-if="post_array.length">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr style="background-color: #3b3f51;color:white;">

                                            <th class="text-center"> عنوان الخبر </th>
                                            <th class="text-center"> رابط الخبر على الرئيسية </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="sub in post_array">
                                            <td class="text-center">  @{{sub.post.title}}</td>
                                            <td class="text-center">   <a :href="getUrl(sub)" target="_blank" >
                                                الرابط</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><div v-else>عذرا لا يوجد بينات</div>
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
    </mail_list-sent>
@endsection