@extends('layouts.app')

@section('content')
    <posts-form :categories='{{ $categories->toJson() }}'
                :countries='{{ $countries->toJson() }}'
                :writers='{{ $writers->toJson() }}'
                :view_types='{{ $view_types->toJson() }}'
                :cases='{{ $cases->toJson() }}'
                :post_edit='{{ isset($post_edit) ? json_encode($post_edit) : 'null' }}'
                :positions='{{ isset($positions) ? $positions : 'null' }}'
                inline-template>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light ">
                     <div class="portlet-title">
                        <div class="caption">
                            <i class=" "></i>
                            <span class="caption-subject  ">{{ meta('title') }}</span>
                        </div>
                        <div class="form-actions" style="float: left;">


                            <button @click="saveReturn" class="btn green" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> نشر
                            </button>
                            <button @click="saveDraft" class="btn yellow" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> مسودة
                            </button>
                            <button @click="savePrivew" class="btn btn-metal" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> معاينة
                            </button>

                            <a href="{{ route('posts.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-8">
                                    
                                   <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.title }">
                                        <label>عنوان المنشور</label>
                                        <input type="text" class="form-control" v-model="title">
                                        <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.title[0] }}</span>
                                    </div>
                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.category_id }">
                                        <label>الجامعة</label>
                                        <v-select v-model="university_id"
                                                  placeholder="اختر الجامعة" :options="universities" :searchable="true"
                                                  :allow-empty="true" select-label="اضغط انتر للتحديد"
                                                  deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                        <span v-if="form.error && form.validations.university_id" class="help-block">@{{ form.validations.university_id[0] }}</span>
                                    </div>
                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.tags_post }">
                                        <label>الوسوم</label>
                                        {{--<textarea rows="3" class="form-control"  id="textarea_tags" ></textarea>--}}
                                        <vue-tags-input
                                                v-model="tag"
                                                :tags="tags"
                                                placeholder="ادخل النص"
                                                :autocomplete-items="autocompleteItems"
                                                :add-only-from-autocomplete="false"
                                                @tags-changed="update">
                                        </vue-tags-input>
                                        <span v-if="form.error && form.validations.tags_post" class="help-block">@{{ form.validations.tags_post[0] }}</span>
                                    </div>

                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.details }" id="can_embed_iframe">
                                        <label>التفاصيل</label>
                                        <textarea class="form-control my-editor" id="detailes"
                                                  rows="18">@if(isset($post)){{$post->details}}@endif</textarea>
                                        <textarea id="content" style="opacity: 0; height: 1px;">@{{details}}</textarea>

                                        <span v-if="form.error && form.validations.details" class="help-block">@{{ form.validations.details[0] }}</span>
                                    </div>





                                </div>
                                <div class="col-md-4">

                                    <input type="hidden" id="input_upload_from" value="post">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="form-group"
                                             :class="{ 'has-error': form.error && form.validations.photo_id }">
                                            <button id="add-main-img" type="button"
                                                    style="border: none; background: none;    width: 100%;">
                                                <div class="fileinput-new thumbnail" style="background-color: #eef1f5;">
                                                    @if(isset($post) && $post->photo)
                                                        <img src="{{ asset($post->photo->thump) }}"
                                                             style="width: 177px;" id="photo_main_view_src" alt=""/>
                                                    @else
                                                        <img src="{{ asset('img/add_image.png') }}"
                                                             style="width: 277px;" id="photo_main_view_src" alt=""/>

                                                    @endif
                                                    <input type="hidden" id="main_photo_id">
                                                </div>
                                            </button>


                                             <!-- End-->
                                            <span v-if="form.error && form.validations.photo_id" class="help-block">@{{ form.validations.photo_id[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.main2 }">

                                        <el-checkbox v-model="slider" ></el-checkbox>
                                        <label style="margin-right: 10px;"> نشر في السلايدر</label>
                                        <span v-if="form.error && form.validations.slider" class="help-block">@{{ form.validations.slider[0] }}</span>
                                    </div>
                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.static }">

                                        <el-checkbox v-model="static" ></el-checkbox>
                                        <label style="margin-right: 10px;">تثبيت في الرئيسية</label>
                                        <span v-if="form.error && form.validations.static" class="help-block">@{{ form.validations.static[0] }}</span>
                                    </div>
                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.report }">

                                        <el-checkbox v-model="report" ></el-checkbox>
                                        <label style="margin-right: 10px;">تقرير</label>
                                        <span v-if="form.error && form.validations.report" class="help-block">@{{ form.validations.report[0] }}</span>
                                    </div>
                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.main_news }">

                                        <el-checkbox v-model="main_news"></el-checkbox>
                                        <label style="margin-right: 10px;">أخبار</label>
                                        <span v-if="form.error && form.validations.main_news" class="help-block">@{{ form.validations.main_news[0] }}</span>
                                    </div>
                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.chosen }">

                                        <el-checkbox v-model="chosen"></el-checkbox>
                                        <label style="margin-right: 10px;">بيان</label>
                                        <span v-if="form.error && form.validations.chosen" class="help-block">@{{ form.validations.chosen[0] }}</span>
                                    </div>
                                    <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.chosen }">

                                        <el-checkbox v-model="private_file"></el-checkbox>
                                        <label style="margin-right: 10px;">ملف خاص </label>
                                        <span v-if="form.error && form.validations.private_file" class="help-block">@{{ form.validations.private_file[0] }}</span>
                                    </div>

                           <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.publish_at }">
                                        <label>تاريخ النشر</label>
                                        <div style="width:317px">
                                            <el-date-picker
                                                    v-model="publish_at"
                                                    type="datetime"
                                                    {{--disabled--}}
                                                    placeholder="اختر الوقت والتاريخ">
                                                   :picker-options="pickerOptions"
                                            </el-date-picker>
                                        </div>
                                        <span v-if="form.error && form.validations.publish_at" class="help-block">@{{ form.validations.publish_at[0] }}</span>
                                    </div>

                                  <div class="form-group"
                                         :class="{ 'has-error': form.error && form.validations.category_id }">
                                        <label>التصنيف</label>
                                        <v-select v-model="category_id" track-by="id" label="name"
                                                  placeholder="اختر التصنيف" :options="categories" :searchable="true"
                                                  :allow-empty="true" select-label="اضغط انتر للتحديد"
                                                  deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                        <span v-if="form.error && form.validations.category_id" class="help-block">@{{ form.validations.category_id[0] }}</span>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="form-actions">

                            <button @click="saveReturn" class="btn green" :disabled="form.disabled">
                                <span v-if="form.disabled">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i>
                                </span> نشر
                            </button>
                            <a href="{{ route('posts.index') }}" class="btn default">إلغاء الأمر</a>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </posts-form>

    @include('dashboards/all_modal')

@endsection

@include('dashboards/java_script_function')
