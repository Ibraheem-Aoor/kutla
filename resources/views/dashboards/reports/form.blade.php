@extends('layouts.app')

@section('content')
    <reports-form  inline-template>
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
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.type }">
                                <label>نوع التقرير</label>
                                <select  class="form-control" v-model="type">
                                    <option value="user" >تقرير اداء المستخدمين</option>
                                    <option value="site" >تقرير عام</option>

                                </select>
                                <span v-if="form.error && form.validations.type" class="help-block">@{{ form.validations.type[0] }}</span>
                            </div>
                            <div v-if="type=='site'">
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.facebook }">
                                <label>عدد المعجبون بالفيس بوك</label>
                                <input type="text" class="form-control" v-model="facebook">
                                <span v-if="form.error && form.validations.facebook" class="help-block">@{{ form.validations.facebook[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.twitter }">
                                <label>عدد متابعين التوتير</label>
                                <input type="text" class="form-control" v-model="twitter">
                                <span v-if="form.error && form.validations.twitter" class="help-block">@{{ form.validations.twitter[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.youtube }">
                                <label>عدد مشاهدات اليوتيوب</label>
                                <input type="text" class="form-control" v-model="youtube">
                                <span v-if="form.error && form.validations.youtube" class="help-block">@{{ form.validations.youtube[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.whatsapp }">
                                <label>عدد مشتركي الواتس اب</label>
                                <input type="text" class="form-control" v-model="whatsapp">
                                <span v-if="form.error && form.validations.whatsapp" class="help-block">@{{ form.validations.whatsapp[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.instagram }">
                                <label>عدد متابعي الانستجرام</label>
                                <input type="text" class="form-control" v-model="instagram">
                                <span v-if="form.error && form.validations.instagram" class="help-block">@{{ form.validations.instagram[0] }}</span>
                            </div>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.start_at }">
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
                                <span v-if="form.error && form.validations.start_at" class="help-block">@{{ form.validations.start_at[0] }}</span>
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
    </reports-form>

@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/dist/theme-chalk.css') }}">

        <style>
            .el-picker-panel__content.el-date-range-picker__content.is-left{
                float: right;
            }
            .el-date-editor.el-input, .el-date-editor.el-input__inner{
                width: 472px !important;
            }
        </style>
    @endpush
