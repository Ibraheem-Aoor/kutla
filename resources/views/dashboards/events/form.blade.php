@extends('layouts.app')

@section('content')
    <events-form :event='{!! isset($event) ? $event : 'null' !!}'  :users='{!! $users->toJson() !!}' :users_add='{!! isset($users_add) ? $users_add->toJson() : 'null' !!}' inline-template>
        <div class="row">
            <div class="col-md-8">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">{{ meta('title') }}</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.name }">
                                <label>العنوان</label>
                                <input type="text" class="form-control" v-model="name">
                                <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.type }">
                                <label>الحالة</label>
                                <v-select  v-model="active_case" track-by="id" label="name" placeholder="اختر نوع الحفظ" :options="actives" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.active" class="help-block">@{{ form.validations.active[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.details }">
                                <label>التفاصيل</label>
                                <textarea  class="form-control" v-model="details" rows="3"></textarea>
                                <span v-if="form.error && form.validations.details" class="help-block">@{{ form.validations.details[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.user_id }">
                                <label>المستخدمين المراد تذكيرهم</label>
                                <v-select :multiple="true" v-model="user_id" track-by="id" label="name" placeholder="اختر المستخدمين" :options="users" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.user_id" class="help-block">@{{ form.validations.user_id[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.user_id }">
                                <label>موعد التذكير</label> <br />
                                <el-date-picker
                                        v-model="value1"
                                        type="datetime"
                                        placeholder="Select date and time">
                                </el-date-picker>
                                <span v-if="form.error && form.validations.user_id" class="help-block">@{{ form.validations.user_id[0] }}</span>
                            </div>

                        </div>


                        </div>
                        <div class="form-actions">
                            <button @click="save" class="btn blue" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> حفظ
                            </button>
                            <a href="{{ route('writers.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </events-form>
    @include('dashboards/all_modal')

@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@include('dashboards/java_script_function')
