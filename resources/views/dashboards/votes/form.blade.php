@extends('layouts.app')

@section('content')
    <vote-form :vote='{!! isset($vote) ? $vote : 'null' !!}' :categories='{!! $categories->toJson() !!}' inline-template>
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
                                <label>عنوان الاستفتاء</label>
                                <input type="text" class="form-control" v-model="name">
                                <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.active }">
                                <label>الحالة</label>
                                <v-select v-model="active_vote" track-by="id" label="name" placeholder="اختر نوع الحفظ" :options="actives" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.active" class="help-block">@{{ form.validations.active[0] }}</span>
                            </div>
                            {{--<div class="form-group" :class="{ 'has-error': form.error && form.validations.type }">--}}
                                {{--<label>نوع الاستفتاء</label>--}}
                                {{--<v-select v-model="vote_type" track-by="id" label="name" placeholder="اختر نوع الاستفتاء" :options="all_type" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>--}}
                                {{--<span v-if="form.error && form.validations.type" class="help-block">@{{ form.validations.type[0] }}</span>--}}
                            {{--</div>
                            <div v-if="vote_type && vote_type.id=='year'" class="form-group" :class="{ 'has-error': form.error && form.validations.category_id }">
                                <label>التصنيف</label>
                                <v-select v-model="category_id" track-by="id" label="name" placeholder="اختر التصنيف" :options="categories" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.category_id" class="help-block">@{{ form.validations.category_id[0] }}</span>
                            </div>--}}

                            {{--<div class="form-group" :class="{ 'has-error': form.error && form.validations.photo_id }">--}}
                                {{--<label>صورة الاستفتاء</label>--}}
                                {{--<div class="fileinput fileinput-new" data-provides="fileinput">--}}

                                    {{--<button id="add-main-img" type="button" style="border: none; background: none;    width: 100%;">--}}
                                        {{--<div class="fileinput-new thumbnail" style="background-color: #eef1f5;">--}}
                                            {{--@if(isset($vote) && $vote->photo)--}}
                                                {{--<img src="{{ asset($vote->photo->thump) }}" style="width: 177px;" id="photo_main_view_src" alt="" />--}}
                                            {{--@else--}}
                                                {{--<img src="{{ asset('img/add_image.png') }}" style="width: 177px;" id="photo_main_view_src" alt="" />--}}

                                            {{--@endif--}}
                                            {{--<input type="hidden"  id="main_photo_id">--}}
                                            {{--<input type="hidden" id="input_upload_from" value="votes">--}}

                                        {{--</div></button>--}}
                                    {{--<span v-if="form.error && form.validations.photo_id" class="help-block">@{{ form.validations.photo_id[0] }}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.details }">
                                <label>التفاصيل</label>
                                <textarea  class="form-control" v-model="details" rows="3"></textarea>
                                <span v-if="form.error && form.validations.details" class="help-block">@{{ form.validations.details[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.details }">
                                <label>الفترة</label>
                                <div class="block">
                                    <el-date-picker
                                            v-model="value6"
                                            type="daterange"
                                            range-separator="إلى"
                                            start-placeholder="تاريخ البداية"
                                            end-placeholder="تاريخ النهاية">
                                    </el-date-picker>
                                </div>
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
                            <a href="{{ route('votes.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="portlet light ">
                    <div class="portlet-title">

                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <input type="hidden" class="form-control" id="get_type_photo">

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.answers }">
                                <label>الخيارات</label> <span> <i class="fa fa-plus-circle" style="color:green;font-size: 20px;cursor: pointer;"  @click="addItem()"></i> </span>
                                <span v-if="form.error && form.validations.answers" class="help-block">@{{ form.validations.answers[0] }}</span>

                                <div class="form-group" >
                                    <div class="row" v-for="(answer, index) in answers">
                                        <div class="col-md-6 form-group">

                                            <input type="text" class="form-control" v-model="answer.name">
                                        </div>
                                        <div class="col-md-4 form-group" >
                                            <div class="fileinput fileinput-new" data-provides="fileinput">

                                                <button :id="'add_vote_image_'+index" class="add_vote_image" type="button" style="border: none; background: none;    width: 100%;">
                                                    <div class="fileinput-new thumbnail" style="background-color: #eef1f5;">

                                                            <img v-if="answer.photo" :src="'{{ asset('/') }}'+answer.photo.thump" style="width: 60px;" :id="'answer_photo_'+index" alt="" />
                                                             <img v-else src="{{ asset('img/add_image.png') }}" style="width: 60px;" :id="'answer_photo_'+index" alt="" />

                                                        <input type="hidden" class="image_answer" v-model="answer.photo_id"   :id="'anser_photo_'+index">

                                                    </div></button>
                                                <span v-if="form.error && form.validations.photo_id" class="help-block">@{{ form.validations.photo_id[0] }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-2"><i class="fa fa-times-circle" style="color:red;font-size: 24px;cursor: pointer;    margin-top: 10px;" @click="deleteItem(answer)"></i></div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>



    </vote-form>
    @include('dashboards/all_modal')

@endsection
@push('styles')
    <style>
        .el-picker-panel__content.el-date-range-picker__content.is-left{
            float: right;
        }
        .el-date-editor.el-input, .el-date-editor.el-input__inner{
            width: 472px !important;
        }
    </style>
@endpush
@include('dashboards/java_script_function')
