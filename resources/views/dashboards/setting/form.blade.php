@extends('layouts.app')

@section('content')
    <setting-form :setting='{{ isset($setting)? $setting : 'null' }}'
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
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.web_site_name }">
                                <label>عنوان الموقع</label>
                                <input type="text" class="form-control" v-model="web_site_name">
                                <span v-if="form.error && form.validations.web_site_name" class="help-block">@{{ form.validations.web_site_name[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.email }">
                                <label>الايميل</label>
                                <input type="text" class="form-control" v-model="email">
                                <span v-if="form.error && form.validations.email" class="help-block">@{{ form.validations.email[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.phone }">
                                <label>رقم التلفون</label>
                                <input type="text" class="form-control" v-model="phone">
                                <span v-if="form.error && form.validations.phone" class="help-block">@{{ form.validations.phone[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.mobile }">
                                <label>رقم الجوال</label>
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
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.youtube }">
                                <label>حساب اليوتيوب</label>
                                <input type="text" class="form-control" v-model="youtube">
                                <span v-if="form.error && form.validations.youtube" class="help-block">@{{ form.validations.youtube[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.googepluse }">
                                <label>حساب جوجل +</label>
                                <input type="text" class="form-control" v-model="googepluse">
                                <span v-if="form.error && form.validations.googepluse" class="help-block">@{{ form.validations.googepluse[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.whatsapp }">
                                <label>حساب الواتس اب</label>
                                <input type="text" class="form-control" v-model="whatsapp">
                                <span v-if="form.error && form.validations.whatsapp" class="help-block">@{{ form.validations.whatsapp[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.telegram }">
                                <label>حساب التلجرام</label>
                                <input type="text" class="form-control" v-model="telegram">
                                <span v-if="form.error && form.validations.telegram" class="help-block">@{{ form.validations.telegram[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.nabd }">
                                <label>حساب نبض</label>
                                <input type="text" class="form-control" v-model="nabd">
                                <span v-if="form.error && form.validations.nabd" class="help-block">@{{ form.validations.nabd[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.soundcloud }">
                                <label>حساب الساوند كلاويد</label>
                                <input type="text" class="form-control" v-model="soundcloud">
                                <span v-if="form.error && form.validations.soundcloud" class="help-block">@{{ form.validations.soundcloud[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.main_tags }">
                                <label>الوسوم الرئيسية</label>
                                <textarea  class="form-control" v-model="main_tags"></textarea>
                                <span v-if="form.error && form.validations.main_tags" class="help-block">@{{ form.validations.main_tags[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.main_tags }">
                                <label>وصف الموقع </label>
                                <textarea  class="form-control" v-model="description"></textarea>
                                <span v-if="form.error && form.validations.description" class="help-block">@{{ form.validations.description[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.google_analytics }">
                                <label>Google Analytics Code</label>
                                <textarea  class="form-control" v-model="google_analytics"></textarea>
                                <span v-if="form.error && form.validations.google_analytics" class="help-block">@{{ form.validations.google_analytics[0] }}</span>
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
    </setting-form>

@endsection

