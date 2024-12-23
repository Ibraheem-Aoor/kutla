@extends('layouts.app')

@section('content')
    <users-index inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">المستخدمين</span>
                        </div>
                        <div class="actions">
                            @if(in_array('add_user',$actions))
                            <a href="{{ route('users.create') }}" class="btn btn-primary">إضافة مستخدم</a>
                                @endif
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table-component ref="table" :data="fetchData"
                                             :table-class="'table table-hover'"
                                             :filter-input-class="'form-control'"
                                             :filter-placeholder="'بحث'"
                                             :show-caption="false"
                                             sort-by="created_at"
                                             sort-order="desc"
                                             filter-no-results="عذرا, لقد تعذر وجود بيانات!"
                            >

                                <table-column label="الاسم" show="name"></table-column>
                                <table-column label="الموبايل" show="mobile"></table-column>
                                <table-column label="الايميل" show="email"></table-column>
                                <table-column label="مجموعة الصلاحيات" show="role_id">
                                    <template scope="user">
                                        <span v-if="user.role">@{{ user.role.name }}</span>
                                    </template>
                                </table-column>
                                @if(in_array('edit_user',$actions))
                                <table-column label="الصلاحيات" >
                                    <template scope="user">
                                        <a :href="'{{asset('/')}}dashboard/users/privilege/'+user.id"  class="btn yellow mt-ladda-btn ladda-button">الصلاحيات</a>

                                    </template>

                                </table-column>
                                @endif
                                <table-column label="">
                                    <template scope="user">
                                        @if(in_array('edit_user',$actions))
                                        <a :href="'{{asset('/')}}dashboard/users/' + user.id + '/edit'"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            @endif
                                    </template>
                                </table-column>
                            </table-component>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </users-index>
@endsection