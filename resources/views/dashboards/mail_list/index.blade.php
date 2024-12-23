@extends('layouts.app')
@section('content')
    <mail_list-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">القائمة البريدية</span>
                        </div>
                        <div class="actions">

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

                            <table-column label="العنوان" show="email"></table-column>
                                <table-column label="عنوان Ip المشترك من خلاله" show="email_ip"></table-column>
                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="mail">



                                        <a @click="deleteMail(mail.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>

                                    </template>
                                </table-column>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </mail_list-index>
@endsection