@extends('layouts.app')
@push('styles')
<style>
    .rmove-icon{
        position: absolute;
        cursor: pointer;
        top: 5px;
        right: 21px;
    }
</style>

@endpush
@section('content')
    <alboms-form  :albom='{!! isset($albom) ? $albom : 'null' !!}' :cases='{!! $cases->toJson() !!}'  inline-template>
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
                                <label>عنوان الألبوم</label>
                                <input type="text" class="form-control" v-model="name">
                                <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                            </div>

                            {{--<div class="form-group" :class="{ 'has-error': form.error && form.validations.category_id }">--}}
                                {{--<label> التصنيف</label>--}}
                                {{--<select  class="form-control" v-model="category_id">--}}
                                    {{--<option v-for="cat in categories" :value="cat.id">@{{ cat.name }}</option>--}}

                                {{--</select>--}}
                                {{--<span v-if="form.error && form.validations.category_id" class="help-block">@{{ form.validations.category_id[0] }}</span>--}}
                            {{--</div>--}}
                            {{--<div class="form-group"--}}
                                 {{--:class="{ 'has-error': form.error && form.validations.case }">--}}
                                {{--<label>ملف خاص</label>--}}
                                {{--<v-select v-model="case_id" track-by="id" label="name" placeholder="اختر الملف"--}}
                                          {{--:options="cases" :searchable="true" :allow-empty="true"--}}
                                          {{--select-label="اضغط انتر للتحديد"--}}
                                          {{--deselect-label="إضغط انتر لإلغاء التحديد"></v-select>--}}
                                {{--<span v-if="form.error && form.validations.case" class="help-block">@{{ form.validations.case[0] }}</span>--}}
                            {{--</div>--}}
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.type }">
                                <label>حفظ كـ</label>
                                <v-select v-model="active_post" track-by="id" label="name" placeholder="اختر نوع الحفظ" :options="actives" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.active" class="help-block">@{{ form.validations.active[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.name }">
                                <label>تفاصيل</label>
                                <textarea rows="5" style="resize: none"  class="form-control" v-model="details"></textarea>
                                <span v-if="form.error && form.validations.details" class="help-block">@{{ form.validations.details[0] }}</span>
                            </div>
                                 <div class="form-group" :class="{ 'has-error': form.error && form.validations.name }">
                                     <label>تاريخ النشر</label>
                                     <el-date-picker
                                             v-model="publish_at"
                                             type="datetime"
                                             {{--disabled--}}
                                             placeholder="اختر الوقت والتاريخ">
                                         :picker-options="pickerOptions"
                                     </el-date-picker>
                            </div>



                        </div>
                        <div class="form-actions">
                            <button @click="save" class="btn blue" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> حفظ
                            </button>
                            <a href="{{ route('albums.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="portlet light ">

                    <div class="portlet-body form">
                        <div class="form-body">

                            <div class="form-group">
                                <div style="
                                        position: absolute;
                                        left: 0;
                                        padding-left: 31px;
                                    ">
                                    <p style="margin-bottom: 0;">عدد الصور @{{uploaded_imgs_base64.length}} </p>
                                    <p>عدد الصور المرفوعة @{{uploaded_imgs.length}} </p>
                                    <button @click="uploadImage" style="float: left;" class="btn blue" :disabled="upload.disabled">
                                        <span v-if="upload.disabled">
                                            <i class="fa fa-btn fa-spinner fa-spin"></i>
                                        </span>رفع
                                    </button>



                                </div>
                                <label>الصور</label>
                                <p><el-checkbox v-model="watermark"> إضافة العلامة المائية للصور </el-checkbox></p>
                                <p>
                                    <input type="file" style="display:none;" id="inputfile" @change="getFile($event)" multiple/>
                                    <a  href="javascript:document.getElementById('inputfile').click(); ">
                                        <img src="{{asset('img/add_image.png')}}" alt="choose" >
                                    </a>


                                </p>
                                <div class="row">
                                    <div class="col-sm-3" v-for="img in uploaded_imgs_base64" style="margin-top: 10px;">
                                             <span @click="removeImg(img)" class="rmove-icon">
                                                     <img src="{{asset('/')}}img/remove.png" />
                                                </span>
                                        <img v-if="img.file_name" class="img-responsive" style="height:100px" :src="'{{asset('/')}}'+img.file_name" alt="choose" >
                                        <img v-else class="img-responsive" style="height:100px" :src="img" alt="choose" >

                                    </div>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </alboms-form>
@endsection
<style>
    .el-checkbox__inner{
        width: 20px !important;
        height: 20px !important;
    }
    .el-checkbox__inner::after{
        height: 11px !important;
        left: 7px !important;
    }
</style>
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

@endpush
