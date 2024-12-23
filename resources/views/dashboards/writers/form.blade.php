@extends('layouts.app')

@section('content')
    <writers-form :categories='{!! $categories->toJson() !!}'
                  :countries='{!! $countries->toJson() !!}'
                  :writer='{!! isset($writer) ? $writer : 'null' !!}'
                  inline-template>
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
                                <label>اسم الكاتب</label>
                                <input type="text" class="form-control" v-model="name">
                                <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.description }">
                                <label>وصف الكاتب</label>
                                <input type="text" class="form-control" v-model="description">
                                <span v-if="form.error && form.validations.description" class="help-block">@{{ form.validations.description[0] }}</span>
                            </div>

                            {{--<div class="form-group" :class="{ 'has-error': form.error && form.validations.category_id }">--}}
                                {{--<label>التصنيف</label>--}}
                                {{--<v-select v-model="category_id" track-by="id" label="name" placeholder="اختر التصنيف" :options="categories" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>--}}
                                {{--<span v-if="form.error && form.validations.category_id" class="help-block">@{{ form.validations.category_id[0] }}</span>--}}
                            {{--</div>--}}


                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.country_id }">
                                <label>الدولة</label>
                                <v-select v-model="country_id" track-by="id" label="name" placeholder="اختر الدولة" :options="countries" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.country_id" class="help-block">@{{ form.validations.country_id[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.mobile }">
                                <label>رقم الموبايل</label>
                                <input type="text" class="form-control" v-model="mobile">
                                <span v-if="form.error && form.validations.mobile" class="help-block">@{{ form.validations.mobile[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.facebook }">
                                <label>حساب الفيس بوك</label>
                                <input type="text" class="form-control" v-model="facebook">
                                <span v-if="form.error && form.validations.facebook" class="help-block">@{{ form.validations.facebook[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.twitter }">
                                <label>حساب التوتير</label>
                                <input type="text" class="form-control" v-model="twitter">
                                <span v-if="form.error && form.validations.twitter" class="help-block">@{{ form.validations.twitter[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.instagram }">
                                <label>حساب الانستجرام</label>
                                <input type="text" class="form-control" v-model="instagram">
                                <span v-if="form.error && form.validations.instagram" class="help-block">@{{ form.validations.instagram[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.details }">
                                <label>مزيد من التفاصيل</label>
                                <textarea  class="form-control" v-model="details" rows="3"></textarea>
                                <span v-if="form.error && form.validations.details" class="help-block">@{{ form.validations.details[0] }}</span>
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
            <div class="col-md-6">
                <div class="portlet light ">

                    <div class="portlet-body form">
                        <div class="form-body">

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.photo_id }">
                                <label>صورة الكاتب</label>
                                <div class="fileinput fileinput-new" data-provides="fileinput">

                                    <button id="add-main-img" type="button" style="border: none; background: none;    width: 100%;">
                                        <div class="fileinput-new thumbnail" style="background-color: #eef1f5;">
                                            @if(isset($writer) && $writer->photo)
                                                <img src="{{ asset($writer->photo->thump) }}" style="width: 177px;" id="photo_main_view_src" alt="" />
                                            @else
                                                <img src="{{ asset('img/add_image.png') }}" style="width: 177px;" id="photo_main_view_src" alt="" />

                                            @endif
                                            <input type="hidden"  id="main_photo_id">
                                            <input type="hidden" id="input_upload_from" value="writers">

                                        </div></button>
                                    <span v-if="form.error && form.validations.photo_id" class="help-block">@{{ form.validations.photo_id[0] }}</span>
                                </div>
                            </div>


                            {{--<div class="form-group" :class="{ 'has-error': form.error && form.validations.photo_caption }">--}}
                                {{--<label>وصف الصورة</label>--}}
                                {{--<input type="text" class="form-control"  id="post_photo_caption">--}}
                                {{--<span v-if="form.error && form.validations.photo_caption" class="help-block">@{{ form.validations.photo_caption[0] }}</span>--}}
                            {{--</div>--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </writers-form>
    @include('dashboards/all_modal')

@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@include('dashboards/java_script_function')
