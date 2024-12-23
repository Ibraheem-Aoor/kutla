@extends('layouts.app')

@push('styles')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{asset('assets/global/plugins/cubeportfolio/css/cubeportfolio.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{asset('assets/pages/css/portfolio-rtl.min.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->




<link href="{{asset('assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css')}}" rel="stylesheet" type="text/css" />
<style>
    .bootstrap-tagsinput{
        width: 100%;
    }

    .cbp .cbp-item {
        /*right: 0;*/
    }
</style>
@endpush

@section('content')

    <alboms-show  :albom='{!! isset($albom) ? $albom : 'null' !!}'  inline-template>

        <div class="Root">

            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet light">
                        <div class="portlet-title">

                            <div class="caption">
                                <i class="icon-social-dribbble font-green"></i>
                                <span class="caption-subject font-green bold uppercase">{{$albom->name}}</span>
                            </div>
                            <div class="actions">
                                @if(in_array('add_album',$actions))
                                <a class=" btn purple btn-outline sbold" data-toggle="modal" href="#static"> اضافة صورة </a>
                                    @endif
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="portfolio-content portfolio-1">

                                <div v-if="albom.photos.length" id="js-grid-juicy-projects" class="cbp">

                                    {{--image Box--}}
                                    <div v-for="photo in albom.photos" :id="'main_photo_'+photo.id"  :class="'cbp-item graphic '+albom.category.id" >
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-defaultWrap">
                                                <a :href="'{{asset('/')}}'+photo.file_name" class="cbp-lightbox " :data-title="photo.photo_caption +'<br>'+ albom.category.name">
                                                <img :src="'{{asset('/')}}'+photo.thump370" alt=""> </a></div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body">
                                                        @if(in_array('edit_album',$actions))
                                                        <button @click=" editImage(photo)"  class=" btn red uppercase btn red uppercase" >
                                                            <i class="icon-pencil"></i>تعديل
                                                        </button>
                                                        @endif
                                                            @if(in_array('delete_album',$actions))
                                                        <button @click="delImage(photo.id)"  class=" btn red uppercase btn red uppercase" >
                                                            <i class="fa fa-times"></i>إزالة
                                                        </button>
                                                                @endif
                                                            <button v-if="photo.album_cover==0" @click="addCover(photo.id)"  class=" btn red uppercase btn red uppercase" >
                                                                تعيين غلاف
                                                            </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center">@{{ photo.photo_caption }}</div>
                                        <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">@{{ albom.category.name }}</div>
                                    </div>

                                </div>
                                {{--<div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">--}}
                                {{--<a href="../assets/global/plugins/cubeportfolio/ajax/loadMore.html" class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow">--}}
                                {{--<span class="cbp-l-loadMore-defaultText">LOAD MORE</span>--}}
                                {{--<span class="cbp-l-loadMore-loadingText">LOADING...</span>--}}
                                {{--<span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BEGIN PAGE BASE CONTENT -->

            <!-- END PAGE BASE CONTENT -->



            {{--Start Modal --}}
            <div id="static"  class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="closeModal()" aria-hidden="true"></button>
                            <h4 class="modal-title">اضافة صورة</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>عنوان الصورة</label>
                                <input type="text" v-model="photo_caption"  class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label > الوسوم</label>
                                <input-tag :tags.sync="tags"></input-tag>
                                {{--<input type="text" id="tags" v-model="tags" class="form-control" data-role="tagsinput">--}}
                            </div>

                            <div class="form-group">
                                <label>الصورة</label>
                                <p>
                                    <input type="file" style="display:none;" id="inputfile" @change="getFile($event)"/>
                                    <a  v-if="!uploaded_img"  href="javascript:document.getElementById('inputfile').click(); ">
                                        <img src="{{asset('img/add_image.png')}}" alt="choose" >
                                    </a>
                                    <img v-else class="img-responsive" :src="uploaded_img" alt="choose" >
                                </p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="save()"  class="btn green">حفظ</button>

                            <button type="button" @click="closeModal()" class="btn dark btn-outline">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--Start Modal --}}


        </div>
    </alboms-show>




@endsection
{{--<script src="http://127.0.0.1:8000/assets/global/plugins/jquery.min.js" type="text/javascript"></script>--}}

@push('albom_script')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/portfolio-1.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/components-bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>


@endpush

