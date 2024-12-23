@extends('layouts.app')

@section('content')
    <roles-index inline-template>
        <div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">مجموعات المستخدمين</span>
                        </div>
                        <div class="actions">
                            @if(in_array('add_user',$actions))
                            <a data-toggle="modal" href="#static" @click="openModalAdd()" class="btn btn-primary">إضافة مجموعة</a>
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
                                @if(in_array('edit_user',$actions))
                                <table-column label="الصلاحيات" >
                                    <template scope="role">
                                        <a :href="'{{asset('/')}}dashboard/users/roles/privilege/'+role.id"  class="btn yellow mt-ladda-btn ladda-button">الصلاحيات</a>

                                    </template>

                                </table-column>
@endif
                                <table-column label="">
                                    <template scope="role">
                                        @if(in_array('edit_user',$actions))
                                        <a href="javascript:;" @click="openModalEdit(role)"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        |@endif
                                            @if(in_array('delete_user',$actions))
                                        <a @click="deleteRole(role.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                                @endif
                                    </template>
                                </table-column>
                            </table-component>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="static"  class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  @click="closeModal()"  aria-hidden="true"></button>
                        <h4 class="modal-title">إضافة مجموعة</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" :class="{ 'has-error': form.error && form.validations.name }">
                            <label>اسم المجموعة</label>
                            <input type="text" v-model="name"  class="form-control" placeholder="">
                            <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="save()"  class="btn green">حفظ</button>

                        <button type="button"  @click="closeModal()"  class="btn dark btn-outline">الغاء</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </roles-index>
@endsection