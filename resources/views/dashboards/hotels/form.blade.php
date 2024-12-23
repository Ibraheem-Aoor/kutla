@extends('layouts.app')

@section('content')
    <hotels-form :hotel='{!! isset($hotel) ? $hotel : 'null' !!}'
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
                                <label>اسم الفندق</label>
                                <input type="text" class="form-control" v-model="name">
                                <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.address }">
                                <label>عنوان الفندق</label>
                                <input type="text" class="form-control" v-model="address">
                                <span v-if="form.error && form.validations.address" class="help-block">@{{ form.validations.address[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.phone }">
                                <label>رقم الهاتف</label>
                                <input type="text" class="form-control" v-model="phone">
                                <span v-if="form.error && form.validations.phone" class="help-block">@{{ form.validations.phone[0] }}</span>
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
                                <label>رابط الموقع</label>
                                <input type="text" class="form-control" v-model="site">
                                <span v-if="form.error && form.validations.site" class="help-block">@{{ form.validations.site[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.whatsapp }">
                                <label>واتس اب</label>
                                <input type="text" class="form-control" v-model="whatsapp">
                                <span v-if="form.error && form.validations.whatsapp" class="help-block">@{{ form.validations.whatsapp[0] }}</span>
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
                                <label>صورة الفندق</label>
                                <div class="fileinput fileinput-new" data-provides="fileinput">

                                    <button id="add-main-img" type="button" style="border: none; background: none;    width: 100%;">
                                        <div class="fileinput-new thumbnail" style="background-color: #eef1f5;">
                                            @if(isset($hotel) && $hotel->photo)
                                                <img src="{{ asset($hotel->photo->thump) }}" style="width: 177px;" id="photo_main_view_src" alt="" />
                                            @else
                                                <img src="{{ asset('img/add_image.png') }}" style="width: 177px;" id="photo_main_view_src" alt="" />

                                            @endif
                                            <input type="hidden"  id="main_photo_id">
                                            <input type="hidden" id="input_upload_from" value="hotels">

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
    </hotels-form>
    @include('dashboards/all_modal')

@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@include('dashboards/java_script_function')
