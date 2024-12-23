@extends('layouts.app')
@section('content')
    <live_videos-index  inline-template>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">البث المباشر</span>
                        </div>
                        <div class="actions">
                            @if(in_array('add_live_videos',$actions))
                            <a href="{{  route('live_videos.create') }}" class="btn btn-primary">إضافة بث مباشر</a>
                            @endif
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table-component ref="table" :data="fetchData" :table-class="'table table-striped table-bordered table-hover'"
                            :filter-input-class="'form-control'"
                            :filter-placeholder="'بحث'"
                            :show-caption="false"
                            sort-by="created_at"
                            sort-order="desc"
                            filter-no-results="عذرا, لقد تعذر وجود بيانات!"
                            >

                            <table-column label="العنوان" show="name"></table-column>

                            <table-column label="تاريخ النشر" show="created_at_days"></table-column>
                            <table-column label="عدد المشاهدات" show="watchNo"></table-column>
                                <table-column label="عرض الفيديو" :sortable="false" :filterable="false">
                                    <template scope="category">
                                        <button  class=" btn purple btn-outline sbold" @click="openVideo(category)">
                                            <i class="fa fa-play"></i>
                                            مشاهدة الفيديو</button>

                                    </template>
                                </table-column>
                                <table-column label="فترة التشغيل من" show="start_at"></table-column>
                                <table-column label="فترة التشغيل إلى" show="end_at"></table-column>
                                <table-column label="مدة التشغيل" show="duration"></table-column>
                                <table-column label="" :sortable="false" :filterable="false">
                                    <template scope="category">
                                        @if(in_array('edit_video',$actions))
                                        <a :href="'{{asset('/')}}dashboard/live_videos/'+category.id+'/edit'">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a> |@endif
                                            @if(in_array('delete_video',$actions))
                                        <a @click="deleteCategory(category.id)" href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                                @endif
                                    </template>
                                </table-column>
                            </table-component>
                        </div>
                    </div>
                </div>
            </div>


            {{--Start Modal --}}
            <div id="static" class="modal bs-modal-lg fade" tabindex="-1" data-backdrop="static" data-keyboard="false" >
                <div class="modal-dialog  modal-lg"  style="height: 410px">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" @click="closeVideo()" class="close"  aria-hidden="true"></button>
                            <h4 class="modal-title">مشاهدة الفيديو</h4>
                        </div>
                        <div class="modal-body">
                            <div class="portlet-body">
                                <ul class="nav nav-tabs">

                                    <li v-if="video_select && video_select.youtube_link" :class="returnClassY(video_select)">
                                        <a  href="#tab_1_2" data-toggle="tab" aria-expanded="true"> يويتيوب </a>
                                    </li>
                                    <li v-if="video_select && video_select.file_name" :class="returnClassF(video_select)">
                                        <a  href="#tab_1_3" data-toggle="tab" aria-expanded="true"> فيديو </a>
                                    </li>
                                    <li v-if="video_select && video_select.facebook" :class="returnClassF(video_select)">
                                        <a  href="#tab_1_4" data-toggle="tab" aria-expanded="true"> فيسبوك </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in" :class="returnClassY(video_select)" id="tab_1_2">
                                        <iframe v-if="video_select && video_select.youtube_link" width="800" height="400" :src="'https://www.youtube.com/embed/'+getName(video_select.youtube_link)" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <div class="tab-pane fade in" :class="returnClassF(video_select)" id="tab_1_3">



                                    </div>
                                    <div class="tab-pane fade in" :class="returnClassFace(video_select)" id="tab_1_4">

                                     @{{ getFacebook(video_select) }}

                                    </div>
                            </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{--Start Modal --}}


                            {{--<video--}}
                                    {{--id="vid1"--}}
                                    {{--class="video-js vjs-default-skin"--}}
                                    {{--controls--}}
                                    {{--autoplay--}}
                                    {{--width="640" height="264"--}}
                                    {{--data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v=xjS6SftYQaQ"}] }'--}}
                            {{-->--}}
                            {{--</video>--}}


            {{--//Test--}}

        </div>
    </live_videos-index>
@endsection