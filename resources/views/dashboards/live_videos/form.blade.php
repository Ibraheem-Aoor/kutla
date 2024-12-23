@extends('layouts.app')

@section('content')
    <live_videos-form  :video='{!! isset($video) ? $video : 'null' !!}'  inline-template>
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
                                <label>الاسم</label>
                                <input type="text" class="form-control" v-model="name">
                                <span v-if="form.error && form.validations.name" class="help-block">@{{ form.validations.name[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.description }">
                                <label>الوصف</label>
                                <input type="text" class="form-control" v-model="description">
                                <span v-if="form.error && form.validations.description" class="help-block">@{{ form.validations.description[0] }}</span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.youtube_link }">
                                <label>رابط يوتيوب</label>
                                <input type="text" class="form-control" v-model="youtube_link">
                                <span v-if="form.error && form.validations.youtube_link" class="help-block">@{{ form.validations.youtube_link[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.facebook }">
                                <label>رابط فيسبوك</label>
                                <input type="text" class="form-control" v-model="facebook">
                                <span v-if="form.error && form.validations.facebook" class="help-block">@{{ form.validations.facebook[0] }}</span>
                            </div>
                            <div  class="form-group" :class="{ 'has-error': form.error && form.validations.video_path }">
                                <label>رفع ملف</label>
                                <input type="file" class="form-control" @change="uploadVideoFile($event)">
                                <span v-if="form.error && form.validations.video_path" class="help-block">@{{ form.validations.video_path[0] }}</span>
                                <div class="progress progress-striped progress-success active" id="father_progress_bar"style="margin-top: 7px;height: 15px;" v-if="is_upload_now">
                                <div id="progress_br" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" :style="'width:'+ prgoress_bar">
                                <span class="sr-only"> 80% Complete (danger) </span>
                                </div>
                                </div>
                            </div>


                            {{--<div class="form-group" >--}}
                                {{--<label> نوع الفيديو</label>--}}
                                {{--<select  class="form-control" v-model="video_type">--}}
                                    {{--<option value="youtube">رابط يوتيوب</option>--}}
                                    {{--<option value="uploaded">ملف فيديو</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.type }">
                                <label>حفظ كـ</label>
                                <v-select v-model="active_post" track-by="id" label="name" placeholder="اختر نوع الحفظ" :options="actives" :searchable="true" :allow-empty="true" select-label="اضغط انتر للتحديد" deselect-label="إضغط انتر لإلغاء التحديد"></v-select>
                                <span v-if="form.error && form.validations.active" class="help-block">@{{ form.validations.active[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.start_at }">
                                <label>وقت تشغيل الفيديو</label>
                                <el-date-picker
                                        v-model="start_at"
                                        type="datetime"
                                        placeholder="اختر الوقت والتاريخ">
                                </el-date-picker>
                                <span v-if="form.error && form.validations.start_at" class="help-block">@{{ form.validations.start_at[0] }}</span>
                            </div>
                            <div class="form-group" :class="{ 'has-error': form.error && form.validations.duration }">
                                <label>مدة تشغيل الفيديو بالدقائق</label>
                                <input type="number" min="0" class="form-control" v-model="duration">
                                <span v-if="form.error && form.validations.duration" class="help-block">@{{ form.validations.duration[0] }}</span>
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
            {{--<div class="col-md-6" >--}}
                {{--<div class="portlet light">--}}
                    {{--<div class="portlet-body form">--}}
                        {{--<div class="form-body">--}}
                            {{--<div class="form-group" :class="{ 'has-error': form.error && form.validations.photo_id }">--}}
                                {{--<label>صورة الفيديو</label>--}}
                                {{--<div class="fileinput fileinput-new" data-provides="fileinput">--}}

                                    {{--<button id="add-main-img" type="button" style="border: none; background: none;    width: 100%;">--}}
                                        {{--<div class="fileinput-new thumbnail" style="background-color: #eef1f5;">--}}
                                            {{--@if(isset($video) && $video->photo)--}}
                                                {{--<img src="{{ asset($video->photo->thump) }}" style="width: 177px;height:160px;" id="photo_main_view_src" alt="" />--}}
                                            {{--@else--}}
                                                {{--<img src="{{ asset('img/add_image.png') }}" style="height:160px;width: 177px;" id="photo_main_view_src" alt="" />--}}

                                            {{--@endif--}}
                                            {{--<input type="hidden"  id="main_photo_id">--}}
                                            {{--<input type="hidden" id="input_upload_from" value="videos">--}}

                                        {{--</div></button>--}}
                                    {{--<span v-if="form.error && form.validations.photo_id" class="help-block">@{{ form.validations.photo_id[0] }}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div v-if="video && video.file_name" id="video_file">--}}
                            {{--<button type="button" class="btn red-sunglo" @click="deleteVideoFile(video.id)">إزالة الفديو</button>--}}
                            {{--<div  style="height: 412px;"   v-if="video && video.file_name">--}}
                                {{--<video width="472" height="315" controls>--}}
                                    {{--<source :src="'{{asset('/')}}'+video.file_name" type="video/mp4">--}}

                                    {{--Your browser does not support the video tag.--}}
                                {{--</video>--}}

                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div    v-if="video && video.youtube_link">--}}

                                {{--<iframe  width="472" height="315" :src="'https://www.youtube.com/embed/'+getName(video.youtube_link)" frameborder="0" allowfullscreen></iframe>--}}
                            {{--</div>--}}

                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </live_videos-form>
    @include('dashboards/all_modal')
@endsection
@include('dashboards/java_script_function')
