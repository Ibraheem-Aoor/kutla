@extends('layouts.app')

@section('content')
    <case-form :case='{!! isset($case) ? $case : 'null' !!}' inline-template>
        <div class="row">
            <div class="col-md-6">
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
                                <label>عنوان الملف</label>
                                <input type="text" class="form-control" v-model="name">
                                <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.type }">
                                <label>الحالة</label>
                                <v-select v-model="active_case" track-by="id" label="name" placeholder="اختر نوع الحفظ" :options="actives" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.active" class="help-block">@{{ form.validations.active[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.details }">
                                <label>التفاصيل</label>
                                <textarea  class="form-control" v-model="details" rows="3"></textarea>
                                <span v-if="form.error && form.validations.details" class="help-block">@{{ form.validations.details[0] }}</span>
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
            <div class="col-md-6">
                <div class="portlet light ">
                    <div class="portlet-title">

                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.photo_id }">
                                <label>صورة الملف</label>
                                <div class="fileinput fileinput-new" data-provides="fileinput">

                                    <button id="add-main-img" type="button" style="border: none; background: none;    width: 100%;">
                                        <div class="fileinput-new thumbnail" style="background-color: #eef1f5;">
                                            @if(isset($case) && $case->photo)
                                                <img src="{{ asset($case->photo->thump) }}" style="width: 177px;" id="photo_main_view_src" alt="" />
                                            @else
                                                <img src="{{ asset('img/add_image.png') }}" style="width: 177px;" id="photo_main_view_src" alt="" />

                                            @endif
                                            <input type="hidden"  id="main_photo_id">
                                            <input type="hidden" id="input_upload_from" value="cases">

                                        </div></button>
                                    <span v-if="form.error && form.validations.photo_id" class="help-block">@{{ form.validations.photo_id[0] }}</span>
                                </div>
                            </div>

                        </div>



                    </div>

                </div>
            </div>
            </div>
        </div>
    </case-form>
    @include('dashboards/all_modal')

@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@include('dashboards/java_script_function')