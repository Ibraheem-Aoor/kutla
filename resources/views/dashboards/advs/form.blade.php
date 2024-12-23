@extends('layouts.app')

@section('content')
    <advs-form  :adv='{!! isset($adv) ? $adv : 'null' !!}'  :setting='{!! isset($setting) ? $setting : 'null' !!}' inline-template>
        <div class="row">
            <div class="col-md-12">
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

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.page }">
                                <label>الصفحة</label>
                                <select  class="form-control" v-model="page" @change="changePage">
                                    <option value="main">الصفحة الرئيسية </option>
                                    <option value="details">تفاصيل الخبر</option>
                                    <option value="hotels">الفنادق</option>
                                </select>
                                <span v-if="form.error && form.validations.page" class="help-block">@{{ form.validations.page[0] }}</span>
                            </div>
                            <div class="form-group"
                                 :class="{ 'has-error': form.error && form.validations.position }">
                                <label>مكان الاعلان</label>
                                <v-select v-model="position" track-by="id" label="name" placeholder="اختر مكان الاعلان"
                                          :options="positions" :searchable="true" :allow-empty="true"
                                          select-label="اضغط انتر للتحديد"
                                          deselect-label="إضغط انتر لإلغاء التحديد" @input="changePosition"></v-select>
                                <span v-if="form.error && form.validations.position" class="help-block">@{{ form.validations.position[0] }}</span>
                            </div>
                            <br/>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ظهور الاعلان</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="location" id="header" value="ps" v-model="location" >اسرائيل وفلسطين
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="location" id="header" value="other" v-model="location" > باقي الدول
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="location" id="header" value="all" v-model="location"> كل العالم
                                            <span></span>
                                        </label>


                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.url1 }">
                                    <label>رابط العنوان 1</label>
                                    <input type="text" class="form-control" v-model="url1">
                                    <span v-if="form.error && form.validations.url1" class="help-block">@{{ form.validations.url1[0] }}</span>
                                </div>
                                <div v-if="adv_number>1" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.url2 }">
                                    <label>رابط العنوان 2</label>
                                    <input type="text" class="form-control" v-model="url2">
                                    <span v-if="form.error && form.validations.url2" class="help-block">@{{ form.validations.url2[0] }}</span>
                                </div>
                                <div v-if="adv_number>2" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.url3 }">
                                    <label>رابط العنوان 3</label>
                                    <input type="text" class="form-control" v-model="url3">
                                    <span v-if="form.error && form.validations.url3" class="help-block">@{{ form.validations.url3[0] }}</span>
                                </div>
                                <div v-if="adv_number>3" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.url4 }">
                                    <label>رابط العنوان 4</label>
                                    <input type="text" class="form-control" v-model="url4">
                                    <span v-if="form.error && form.validations.url4" class="help-block">@{{ form.validations.url4[0] }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="m-alert m-alert--icon alert alert-warning" role="alert">
                                    <div class="m-alert__icon">
                                        <i class="la la-warning"></i>
                                    </div>
                                    <div class="m-alert__text">
                                        <div class="row">
                                            <div class="col-md-6" v-if="canShow1()"> <strong>  <p>الصورة للحجم الاعلان الكبير الأفقي يجب ان يكون مقاسها 1169*110</p></strong></div>
                                            <div class="col-md-6" v-if="canShow2()" > <strong>  <p>الصورة للحجم الاعلان الكبير الرأسي يجب ان يكون مقاسها 580*270</p></strong></div>

                                            <div class="col-md-6" v-if="canShow3()"> <strong>  <p>الصورة للحجم الاعلان الثنائي الأفقي يجب ان يكون مقاسها 520*110 </p></strong></div>
                                            <div class="col-md-6" v-if="canShow4()"> <strong>  <p>الصورة للحجم الاعلان الثنائي الرأسي يجب ان يكون مقاسها 275*270</p></strong></div>

                                            <div class="col-md-6" v-if="canShow5()"> <strong>  <p>الصورة للحجم الاعلان الثلاثي الأفقي يجب ان يكون مقاسها 401*110 </p></strong></div>
                                            <div class="col-md-6" v-if="canShow6()"> <strong>  <p>الصورة للحجم الاعلان الثلاثي الرأسي يجب ان يكون مقاسها 193*270</p></strong></div>

                                            <div class="col-md-6" v-if="canShow7()"> <strong>  <p>الصورة للحجم الاعلان الرباعي الأفقي يجب ان يكون مقاسها 221*110 </p></strong></div>
                                            <div class="col-md-6" v-if="canShow8()"> <strong>  <p>الصورة للحجم الاعلان الرباعي الرأسي يجب ان يكون مقاسها 135*270</p></strong></div>
                                            <div class="col-md-6" v-if="canShow9()"> <strong>  <p>الصورة للاعلان بجانب تفاصيل الخبر والفنادق يجب ان يكون مقاسها 371*274</p></strong></div>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.image }">
                                    <label> الصورة 1</label>
                                    <input type="file" name="image_src1" id="image_src1" accept="image/*"
                                           style="font-size: 1.2em; padding: 10px 0;"
                                           @change="setImage1"
                                    />
                                    <span v-if="form.error && form.validations.image" class="help-block">@{{ form.validations.image[0] }}</span>

                                    <img v-if="image_src1" class="img-responsive" style="height:100px" :src="image_src1" alt="choose" >
                                    <button type="button" v-if="image_src1" @click="delImage1" class="btn red-sunglo" >حذف الصورة</button>
                                </div>
                                <div v-if="adv_number>1" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.image }">
                                    <label> الصورة 2</label>
                                    <input type="file" name="image_src2" accept="image/*" id="image_src2"
                                           style="font-size: 1.2em; padding: 10px 0;"
                                           @change="setImage2"
                                    />
                                    <span v-if="form.error && form.validations.image" class="help-block">@{{ form.validations.image[0] }}</span>

                                    <img v-if="image_src2" class="img-responsive" style="height:100px" :src="image_src2" alt="choose" >
                                    <button type="button" v-if="image_src2" @click="delImage2" class="btn red-sunglo" >حذف الصورة</button>
                                </div>
                                <div v-if="adv_number>2" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.image }">
                                    <label> الصورة 3</label>
                                    <input type="file" name="image_src3" accept="image/*" id="image_src3"
                                           style="font-size: 1.2em; padding: 10px 0;"
                                           @change="setImage3"
                                    />
                                    <span v-if="form.error && form.validations.image" class="help-block">@{{ form.validations.image[0] }}</span>

                                    <img v-if="image_src3" class="img-responsive" style="height:100px" :src="image_src3" alt="choose" >
                                    <button type="button" v-if="image_src3" @click="delImage3" class="btn red-sunglo" >حذف الصورة</button>
                                </div>
                                <div v-if="adv_number>3"  class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.image }">
                                    <label> الصورة 4</label>
                                    <input type="file" name="image_src4" accept="image/*" id="image_src4"
                                           style="font-size: 1.2em; padding: 10px 0;"
                                           @change="setImage4"
                                    />
                                    <span v-if="form.error && form.validations.image" class="help-block">@{{ form.validations.image[0] }}</span>

                                    <img v-if="image_src4" class="img-responsive" style="height:100px" :src="image_src4" alt="choose" >
                                    <button type="button" v-if="image_src4" @click="delImage4" class="btn red-sunglo" >حذف الصورة</button>
                                </div>

                            </div>
                            <div class="row">
                                <div class="m-alert m-alert--icon alert alert-warning" role="alert">
                                    <div class="m-alert__icon">
                                        <i class="la la-warning"></i>
                                    </div>
                                    <div class="m-alert__text">
                                        <div class="row">
                                            <div class="col-md-6" v-if="canShow1()"> <strong>  <p>الصورة للحجم الاعلان الكبير الأفقي يجب ان يكون مقاسها 330*60</p></strong></div>
                                            <div class="col-md-6" v-if="canShow2()"> <strong>  <p>الصورة للحجم الاعلان الكبير الرأسي يجب ان يكون مقاسها 500*270</p></strong></div>

                                            <div class="col-md-6" v-if="canShow3()"> <strong>  <p>الصورة للحجم الاعلان الثنائي الأفقي يجب ان يكون مقاسها 330*60 </p></strong></div>
                                            <div class="col-md-6" v-if="canShow4()"> <strong>  <p>الصورة للحجم الاعلان الثنائي الرأسي يجب ان يكون مقاسها 275*270</p></strong></div>

                                            <div class="col-md-6" v-if="canShow5()"> <strong>  <p>الصورة للحجم الاعلان الثلاثي الأفقي يجب ان يكون مقاسها 330*60 </p></strong></div>
                                            <div class="col-md-6" v-if="canShow6()"> <strong>  <p>الصورة للحجم الاعلان الثلاثي الرأسي يجب ان يكون مقاسها 193*270</p></strong></div>

                                            <div class="col-md-6" v-if="canShow7()"> <strong>  <p>الصورة للحجم الاعلان الرباعي الأفقي يجب ان يكون مقاسها 330*60 </p></strong></div>
                                            <div class="col-md-6" v-if="canShow8()"> <strong>  <p>الصورة للحجم الاعلان الرباعي الرأسي يجب ان يكون مقاسها 135*270</p></strong></div>
                                            <div class="col-md-6" v-if="canShow9()"> <strong>  <p>الصورة للاعلان بجانب تفاصيل الخبر والفنادق يجب ان يكون مقاسها 330*234</p></strong></div>

                                        </div>

                                    </div>

                                </div>

                                <div  class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.image }">
                                    <label>الصورة للموبايل 1</label>
                                    <input type="file" name="image_src_mobile1" accept="image/*" id="image_src_mobile1"
                                           style="font-size: 1.2em; padding: 10px 0;"
                                           @change="setImageMobile1"
                                    />
                                    <span v-if="form.error && form.validations.image_src_mobile1" class="help-block">@{{ form.validations.image_src_mobile1[0] }}</span>

                                    <img v-if="image_src_mobile1" class="img-responsive" style="height:100px" :src="image_src_mobile1" alt="choose" >
                                    <button type="button" v-if="image_src_mobile1" @click="delImageMobile1" class="btn red-sunglo" >حذف الصورة</button>
                                </div>
                                <div v-if="adv_number>1" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.image }">
                                    <label> الصورة للموبايل 2</label>
                                    <input type="file" name="image_src_mobile2" accept="image/*" id="image_src_mobile2"
                                           style="font-size: 1.2em; padding: 10px 0;"
                                           @change="setImageMobile2"
                                    />
                                    <span v-if="form.error && form.validations.image_src_mobile2" class="help-block">@{{ form.validations.image_src_mobile2[0] }}</span>

                                    <img v-if="image_src_mobile2" class="img-responsive" style="height:100px" :src="image_src_mobile2" alt="choose" >
                                    <button type="button" v-if="image_src_mobile2" @click="delImageMobile2" class="btn red-sunglo" >حذف الصورة</button>
                                </div>
                                <div v-if="adv_number>2"  class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.image }">
                                    <label>الصورة للموبايل 3</label>
                                    <input type="file" name="image_src_mobile3" accept="image/*" id="image_src_mobile3"
                                           style="font-size: 1.2em; padding: 10px 0;"
                                           @change="setImageMobile3"
                                    />
                                    <span v-if="form.error && form.validations.image_src_mobile3" class="help-block">@{{ form.validations.image_src_mobile3[0] }}</span>

                                    <img v-if="image_src_mobile3" class="img-responsive" style="height:100px" :src="image_src_mobile3" alt="choose" >
                                    <button type="button" v-if="image_src_mobile3" @click="delImageMobile3" class="btn red-sunglo" >حذف الصورة</button>
                                </div>
                                <div  v-if="adv_number>3" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.image }">
                                    <label>الصورة للموبايل 4</label>
                                    <input type="file" name="image_src_mobile4" accept="image/*" id="image_src_mobile4"
                                           style="font-size: 1.2em; padding: 10px 0;"
                                           @change="setImageMobile4"
                                    />
                                    <span v-if="form.error && form.validations.image_src_mobile4" class="help-block">@{{ form.validations.image_src_mobile4[0] }}</span>

                                    <img v-if="image_src_mobile4" class="img-responsive" style="height:100px" :src="image_src_mobile4" alt="choose" >
                                    <button type="button" v-if="image_src_mobile4" @click="delImageMobile4" class="btn red-sunglo" >حذف الصورة</button>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.url }">
                                    <label>iframe 1</label>
                                    <textarea rows="2" class="form-control" v-model="iframe1"></textarea>
                                    <span v-if="form.error && form.validations.url" class="help-block">@{{ form.validations.url[0] }}</span>
                                </div>
                                <div v-if="adv_number>1" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.url }">
                                    <label>iframe 2</label>
                                    <textarea rows="2" class="form-control" v-model="iframe2"></textarea>
                                    <span v-if="form.error && form.validations.url" class="help-block">@{{ form.validations.url[0] }}</span>
                                </div>
                                <div v-if="adv_number>2" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.url }">
                                    <label>iframe 3</label>
                                    <textarea rows="2" class="form-control" v-model="iframe3"></textarea>
                                    <span v-if="form.error && form.validations.url" class="help-block">@{{ form.validations.url[0] }}</span>
                                </div>
                                <div v-if="adv_number>3" class="form-group col-md-3" :class="{ 'has-error': form.error && form.validations.url }">
                                    <label>iframe 4</label>
                                    <textarea rows="2" class="form-control" v-model="iframe4"></textarea>
                                    <span v-if="form.error && form.validations.url" class="help-block">@{{ form.validations.url[0] }}</span>
                                </div>
                            </div>




                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.active_adv }">
                                <label>الحالة</label>
                                <select  class="form-control" v-model="active_adv" >
                                    <option value="1">منشور </option>
                                    <option value="0">غير منشور</option>
                                </select>
                                <span v-if="form.error && form.validations.active_adv" class="help-block">@{{ form.validations.active_adv[0] }}</span>
                            </div>

                        </div>
                        <div class="form-actions">
                            <button @click="save" class="btn blue" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> حفظ
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </advs-form>
@endsection
@push('styles')
    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
<script>
    let _AVATAR_IMAGE1 = '{{ isset($adv) && strlen($adv->image1) ? convertImageToBase64(public_path().'/'.$adv->image1) : null }}';
    let _AVATAR_IMAGE2 = '{{ isset($adv) && strlen($adv->image2) ? convertImageToBase64(public_path().'/'.$adv->image2) : null }}';
    let _AVATAR_IMAGE3 = '{{ isset($adv) && strlen($adv->image3) ? convertImageToBase64(public_path().'/'.$adv->image3) : null }}';
    let _AVATAR_IMAGE4 = '{{ isset($adv) && strlen($adv->image4) ? convertImageToBase64(public_path().'/'.$adv->image4) : null }}';
    let _AVATAR_IMAGE_mobile1 = '{{ isset($adv) && strlen($adv->image_mobile1) ? convertImageToBase64(public_path().'/'.$adv->image_mobile1) : null }}';
    let _AVATAR_IMAGE_mobile2 = '{{ isset($adv) && strlen($adv->image_mobile1) ? convertImageToBase64(public_path().'/'.$adv->image_mobile1) : null }}';
    let _AVATAR_IMAGE_mobile3 = '{{ isset($adv) && strlen($adv->image_mobile1) ? convertImageToBase64(public_path().'/'.$adv->image_mobile1) : null }}';
    let _AVATAR_IMAGE_mobile4 = '{{ isset($adv) && strlen($adv->image_mobile1) ? convertImageToBase64(public_path().'/'.$adv->image_mobile1) : null }}';


</script>