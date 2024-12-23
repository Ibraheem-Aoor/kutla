@extends('layouts.app')

@section('content')
    <banner-form :case='{!! isset($banner) ? $banner : 'null' !!}' inline-template>
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
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.title }">
                                <label>العنوان</label>
                                <input type="text" class="form-control" v-model="title">
                                <span v-if="form.error && form.validations.title" class="help-block">@{{ form.validations.title[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.link }">
                                <label>رابط </label>
                                <input type="text" class="form-control" v-model="link">
                                <span v-if="form.error && form.validations.link" class="help-block">@{{ form.validations.link[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.type }">
                                <label>تفعيل الgif</label>
                                <v-select v-model="gif_active_case" track-by="id" label="name" placeholder="اختر نوع الحفظ" :options="actives" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.gif_active" class="help-block">@{{ form.validations.gif_active[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.type }">
                                <label>حالة العرض في الموقع </label>
                                <v-select v-model="active_case" track-by="id" label="name" placeholder="اختر نوع الحفظ" :options="actives" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.active" class="help-block">@{{ form.validations.active[0] }}</span>
                            </div>


                        </div>


                    </div>
                    <div class="form-actions">
                        <button @click="save" class="btn blue" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> حفظ
                        </button>
                        <a href="{{ route('link.index') }}" class="btn default">إلغاء الأمر</a>
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
                                <label>صورة الاول</label>
                                <p>
                                    <input type="file" style="display:none;" id="inputfile" @change="getFile($event,1)" />
                                    <a  href="javascript:document.getElementById('inputfile').click(); ">
                                        <img v-if="image1" :src="image1" alt="choose" style="width: 100px;height: 100px;" >
                                        <img v-else src="{{asset('img/add_image.png')}}" style="width: 100px;height: 100px;" alt="choose" >
                                    </a>
                                </p>
                                <label>صورة الثانية</label>
                                <p>
                                    <input type="file" style="display:none;" id="inputfile2" @change="getFile($event,2)"/>
                                    <a  href="javascript:document.getElementById('inputfile2').click(); ">
                                        <img v-if="image2" :src="image2" alt="choose" style="width: 100px;height: 100px;" >
                                        <img v-else  style="width: 100px;height: 100px;" src="{{asset('img/add_image.png')}}" alt="choose" >
                                    </a>
                                </p>
                                <label>صورة gif</label>
                                <p>

                                    <input type="file" style="display:none;" name="myfile" ref="file" id="inputfile4" @change="getFile($event,3)"/>
                                    <a  href="javascript:document.getElementById('inputfile4').click(); ">
                                        <img v-if="gif_image_url" :src="gif_image_url" alt="choose" style="width: 100px;height: 100px;" >
                                        <img v-else  style="width: 100px;height: 100px;" src="{{asset('img/add_image.png')}}" alt="choose" >
                                    </a>
                                </p>

                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-3" v-for="img in uploaded_imgs_base64" style="margin-top: 10px;">--}}
                                             {{--<span @click="removeImg(img)" class="rmove-icon">--}}
                                                     {{--<img src="{{asset('/')}}img/remove.png" />--}}
                                                {{--</span>--}}
                                        {{--<img v-if="img.file_name" class="img-responsive" style="height:100px" :src="'{{asset('/')}}'+img.file_name" alt="choose" >--}}
                                        {{--<img v-else class="img-responsive" style="height:100px" :src="img" alt="choose" >--}}

                                    {{--</div>--}}
                                {{--</div>--}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </banner-form>
    @include('dashboards/all_modal')

@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@include('dashboards/java_script_function')
