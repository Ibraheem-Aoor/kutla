@push('styles')

    <link href="{{ asset('css/dist/vue-multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/dist/theme-chalk.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.39/css/uikit.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/global/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/main.rtl.css') }}">

    <style>
        .el-date-editor.el-input, .el-date-editor.el-input__inner{
            width: 317px;
        }
        .bootstrap-tagsinput{
            width: 100%;
        }
        textarea {
            resize: none;
        }

        .cbp .cbp-item {
            /*right: 0;*/
        }


        .delete_image{
            position: absolute;
            margin-top: 5px;
            font-size: 21px;
            color: red;
            cursor: pointer;
        }

         .el-checkbox__inner{
             width: 20px !important;
             height: 20px !important;
         }
        .el-checkbox__inner::after{
            height: 11px !important;
            left: 7px !important;
        }
        /** By Moman AlBeleses **/
       /* .vue-tags-input[data-v-36b6250a]{
            max-width: 701px !important
        }

        .vue-tags-input .input{
            width: 780px !important
        }*/
        .drag_drop{
            position: absolute;
            width: 100%;
            height: 270px;
            border: 4px dashed #fff;
        }
        .drag_drop p{
            width: 100%;

            text-align: center;
            line-height: 20px
        }
        .upload_form_drag{
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
        }

    </style>
@endpush
   <div id="upload_video_youtube" class="modal fade" tabindex="-1" style=" top: 20% !important;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">إضافة فيديو يوتيوب</h4>
        </div>
        <div class="modal-body">
            <div class="form-group" >
                <label>رابط اليوتيوب</label>
                <input type="text" class="form-control" id="editor_link_youtube-ss">

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn green" id="insert_youtube_link-old">حفظ</button>
            <button type="button" data-dismiss="modal" class="btn btn-outline dark">إغلاق</button>

        </div>
    </div>


<div class="uk-modal " id="upload_video_face" style="padding-top:8%;">
    <div class="uk-modal-dialog ">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title"> اضافة رابط فيسبوك  </h3>
        </div>
        <div class="uk-modal-body">
            <div class="uk-grid">
                <div class="uk-width-1">
                    <div class="parsley-row">
                        <label>الرابط  <span class="req">*</span></label>
                        <input type="text" class="form-control" required  id="editor_link_face" />
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="md-btn  md-btn-success md-btn-wave-light waves-effect waves-button waves-light"  id="insert_face_link">
                حفظ
            </button>
            <button type="button" class="md-btn uk-modal-close md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"  id="cancel_insert_face" >
                الغاء
            </button>
        </div>
    </div>

</div>

<div class="uk-modal " id="add-video-editor" style="padding-top:8%;">
    <div class="uk-modal-dialog ">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title"> اضافة رابط يوتيوب  </h3>
        </div>
        <div class="uk-modal-body">
            <div class="uk-grid">
                <div class="uk-width-1">
                    <div class="parsley-row">
                        <label>رابط الفيديو <span class="req">*</span></label>
                        <input type="text" class="form-control" required  id="editor_link_youtube" />
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="md-btn  md-btn-success md-btn-wave-light waves-effect waves-button waves-light"  id="insert_youtube_link">
                حفظ
            </button>
            <button type="button" class="md-btn uk-modal-close md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"  id="cancel_insert_youtube" >
                الغاء
            </button>
        </div>
    </div>

</div>


<div class="uk-modal" id="modal-add-video">
       <div class="uk-modal-dialog">
           <div class="uk-modal-header">
               <h3 class="uk-modal-title"> اضافة فيديو رئيسي</h3>
           </div>

           <div class="uk-modal-body  same-height same-height-overflow">
               <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" >
               <div class="md-card">
                   <div class="md-card-content large-padding">
                       <div class="uk-grid" data-uk-grid-margin>
                           <div class="uk-width-medium-1-1">
                               <div class="parsley-row icon-loading">
                                   <label for="video_link">رابط الفيديو<span class="req">*</span></label>
                                   <input type="text" name="video_link" id="video_link"  class="md-input"
                                          data-parsley-required="true"
                                          data-parsley-required-message="هذا الحقل مطلوب"
                                          data-parsley-youtube
                                   />  <input type="hidden" name="video_id" id="video_id"><i  id="loadURL" style="display: none;" class="uk-icon-spinner uk-icon-spin"></i>
                               </div>
                           </div>
                       </div>
                       <div class="uk-grid" data-uk-grid-margin>
                           <div class="uk-width-medium-1-1">
                               <div class="parsley-row">
                                   <label for="video_title">العنوان<span class="req">*</span></label>
                                   <input type="text" name="video_title" id="video_title"   class="md-input" data-parsley-required="true" data-parsley-required-message="هذا الحقل مطلوب" disabled />

                               </div>

                           </div>
                       </div>
                       <div class="uk-grid">
                           <h3 class="heading_a">
                               التصنيف
                               <span class="sub-heading">   قم بإختيار تصنيف الفيديو </span>
                           </h3>
                       </div>

                       <div class="uk-grid" data-uk-grid-margin >

                           <div class="uk-width-medium-1-1">
                               <div class="parsley-row md-input-filled country-sel">
                                   <div class="md-input-wrapper md-input-filled">
                                       <label > التصنيف </label>
                                       <select id="category" name="category" class="select2 md-input label-fixed PUTdisabled" multiple  disabled >
                                           <?php if(isset($videoCat)){?>
                                           @foreach($videoCat as $category)
                                               <option value="{{$category->id}}">{{$category->name}} </option>

                                           @endforeach
                                           <?php }?>
                                       </select>
                                   </div>
                               </div>
                           </div>

                       </div>
                       <div class="uk-grid" data-uk-grid-margin>
                           <div class="uk-width-medium-1-1">
                               <div class="parsley-row">
                                   <label for="video_desc">التفاصيل<span class="req">*</span></label>
                                   <textarea   id="video_desc" name="video_desc" class="md-input PUTdisabled" data-parsley-required="true" data-parsley-required-message="هذا الحقل مطلوب" disabled></textarea>
                               </div>
                           </div>
                       </div>
                       <div class="uk-grid" data-uk-grid-margin>

                           <input type="text" style="visibility: hidden;position: absolute;"  id="video_tags" name="video_tags" class="md-input" />

                           <div class="uk-width-medium-4-10">
                               <div class="parsley-row">
                                   <label for="fullname"> الكلمات المفتاحية ( الوسوم) <span class="req">*</span></label>
                                   <input type="text" class="md-input " id="dataTags" disabled    />
                               </div>
                           </div>

                           <div class="uk-width-medium-2-10 add-tag-cont ">
                               <a class="md-btn md-btn-wave waves-effect waves-button" id="addTags" >
                                   أضف
                               </a>
                           </div>

                           <div class="uk-width-1-1">
                               <div id="putTags" class="uk-grid-margin tags-boxs ">
                               </div>

                           </div>

                       </div>


                   </div>
               </div>




           </div>


           <div class="uk-modal-footer uk-text-right">
               <div class="modal-footer-btns">
                   <button id="saveVideo" class="md-btn  md-btn-success md-btn-wave-light waves-effect waves-button waves-light" >
                       <i  id="loadSaveVideo" style="display: none;" class="uk-icon-spinner uk-icon-spin"></i>   حفظ
                   </button>

                   <button class="md-btn uk-modal-close md-btn-danger md-btn-wave-light waves-effect waves-button waves-light" >
                       الغاء
                   </button>
               </div>
           </div>


       </div>
   </div>

   <div class="uk-modal  right-modal-large" id="add-news-img">
       <div class="uk-modal-dialog uk-modal-dialog-large">
           <div class="uk-modal-header">
               <h3 class="uk-modal-title"> إضافة صورة </h3>
           </div>
           <div class="uk-modal-body">
               <div class="md-card uk-margin-medium-bottom" style="height: 530px">
                   <div class="md-card-content" >
                       <div class="uk-grid">
                           <div class="uk-width-1-1">
                               <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">

                                   <li id="upload_new_photo"><a href="#"> رفع صورة جديدة </a></li>
                                   <li class="uk-active" id="upload_from_archive"><a href="#"> مكتبة الصور </a></li>
                                   <li  id="upload_from_video"><a href="#"> مكتبة الفيديو </a></li>
                                   <li id="upload_big_photo"><a href="#"> رفع صورة كبيرة </a></li>
                                   <li style="display: none" id="upload_you_tube"><a href="#"> رابط يوتويب </a></li>
                                   <li style="display: none" id="upload_face_bokk"><a href="#"> رابط فيس
                                       </a></li>
                                   <li style="display: none" id="upload_file_modal"><a href="#"> تحميل ملف </a></li>
                                   <li style="display: none" id="chose_files_from_archive"><a href="#"> ملفات </a></li>


                               </ul>
                               <div id="tabs_1" class="uk-switcher uk-margin">


                                   <div class="uk-width-1-1 modal-upload-img-tab  " id="uploader_photo_container" style="height: 400px;">
<input type="hidden" id="image_type" value="">

                                       <div style="height: 270px; !important;">
                                           <form action="upload.php" method="POST" class="dropzone dropzone-file-area dropify-wrapper drag_drop">
                                               <div id="file_upload-drop" style="height: 270px;" class="dropzone dropzone-file-area dropify-wrapper" id="my-dropzone"  >
                                                   <p class="uk-text-muted uk-text-small uk-margin-small-bottom"><input type="checkbox" class="form-control" id="add_water_mark" > إضافة العلامة المائية للصور </p>

                                               <input type="file" id="photo_main_upload" name="photo_main_upload" class="upload_form_drag" multiple>
                                               <p>سحب وافلات الصور هنا</p>
                                               </div>

                                           </form>


                                       </div>
                                       <div class="portlet-body form">
                                           <div class="form-body">

                                               <div class="form-group">
                                                 <div class="row" id="photoscontainer" >

                                                   </div>



                                               </div>

                                           </div>
                                       </div>
                                       <!-- progress bar -->

                                       <!-- end of progress bar -->
                                   </div>

                                   <div class="uk-width-1-1 archive-tab " id="uploader_archive">

                                       <div class="uk-grid">

                                           <div class="uk-width-3-4 archive-imgs same-height" id="#main_all_photo">
                                               <div class="uk-grid archive-img-filters ">

                                                   <div class="form-group" style="width: 302px;">
                                                       <label style="margin-top: 12px;    margin-right: 15px">البحث بالوسم</label>
                                                       <input style="width: 200px;      margin-top: -27px; margin-right: 99px;" type="text" class="form-control" id="photo_modal_name" name="photo_modal_name">
                                                   </div>
                                                   <div class="tabbable-line boxless margin-bottom-20" style="padding-top: 10px;">
                                                       <button type="button" style="font-size: 10px;" class="btn btn-info filter_type" id="all_photo">الكل</button>
                                                       <button type="button" style="font-size: 10px;" class="btn btn-default filter_type" id="all_post">منشورات</button>
                                                       <button type="button" style="font-size: 10px;" class="btn btn-default filter_type" id="all_albums">ألبومات</button>
                                                       <button type="button" style="font-size: 10px;" class="btn btn-default filter_type" id="all_writers">كُتاب</button>
                                                       <button type="button" style="font-size: 10px;" class="btn btn-default filter_type" id="all_cases">ملفات خاصة</button>
                                                       <button type="button" style="font-size: 10px;" class="btn btn-default filter_type" id="all_videos">فيديوهات</button>
                                                       <button type="button" style="font-size: 10px;" class="btn btn-default filter_type" id="all_votes">استفتاءات</button>
                                                       <button type="button" style="font-size: 10px;" class="btn btn-default filter_type" id="all_pages">صفحات</button>

                                                   </div>

                                               </div>
                                               <input type="hidden" id="current_view_images" name="current_view_images" value="" />
                                               <div class="same-height-imgs "  >
                                                   <div id="photos_main_container">


                                                   </div>
                                                   <div class="uk-width-1-1 uk-text-center archive-img-load-more" style="display:none">
                                                       <button class="md-btn md-btn-wave waves-effect waves-button"  id="photos_load_more" >
                                                           تحميل المزيد
                                                       </button>
                                                   </div>
                                               </div>

                                           </div>

                                           <div class="uk-width-1-4 archive-img-attr same-height" style="height: 470px !important;">
                                               <div class="img-options" style="display:none" id="sidebar_photo_data">

                                                   <div class="uk-comment">
                                                       <header class="uk-comment-header" id="photo_uploading_data">
                                                           <img class="uk-comment-avatar upload_avatar" src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-128.png" >
                                                           <div class="image-left-det">
                                                               <div class="uk-comment-meta upload_date"> مارس 8, 2016 </div>
                                                               <div class="uk-comment-meta upload_size"> 54 kB </div>
                                                               <div class="uk-comment-meta upload_dimensions"> <span id="upload_img_width" > 23323 </span> <span class="upload-img-x" > x </span> <span id="upload_img_heigth">267 </span>  </div>
                                                           </div>
                                                       </header>
                                                       <h4 class="uk-comment-title upload_name uk-margin-top"> default img </h4>

                                                   </div>

                                                   <div class="img-option-btns"  style="display:none" id="img_upload_options">
                                                       <button type="button" class="md-btn md-btn-flat-danger md-btn-wave waves-effect waves-button delPhoto" > حذف </button>
                                                   </div>

                                                   <div class="uk-width-medium-1">
                                                       <input type="hidden" id="up_image_id" name="up_image_id"  />

                                                       <div class="uk-grid" >
                                                           <div class="uk-width-medium-1 uk-row-first">
                                                               <div class="parsley-row">
                                                                   <label for="photo_main_desc"> وصف الصورة <span class="req">*</span></label>
                                                                   <input type="text" class="form-control" required  id="photo_main_desc" maxlength="200"  />

                                                               </div>
                                                           </div>
                                                       </div>


                                                       <div class="uk-grid" >
                                                           <div class="uk-width-medium-1 uk-row-first">
                                                               <div class="md-input-wrapper md-input-filled">
                                                                   <label>رابط الصورة </label>
                                                                   <input type="text" class="md-input label-fixed"  value="" onclick="this.focus();this.select();copy();" readonly id="url_image_uploaded" ><span class="md-input-bar"></span> </div>
                                                           </div>

                                                       </div>

                                                   </div>

                                               </div>

                                           </div>


                                       </div>
                                   </div>
                                   <div class="uk-width-1-1 archive-tab " id="upload_video">

                                       <div class="uk-grid">

                                           <div class="uk-width-4-4 archive-imgs same-height" id="#main_all_videos">
                                               <div class="uk-grid archive-img-filters ">

                                                   <div class="form-group" >
                                                       <label style="margin-top: 12px;    margin-right: 15px">البحث بالعنوان</label>
                                                       <input style="width: 300px;      margin-top: -27px; margin-right: 99px;" type="text" class="form-control" id="video_modal_name" name="video_modal_name">
                                                   </div>
                                                   <input type="hidden" id="up_video_id" name="up_video_id"  />

                                                   <div class="tabbable-line boxless margin-bottom-20" style="padding-top: 10px;" id="all_video_category">


                                                   </div>

                                               </div>
                                               <input type="hidden" id="current_view_videos" name="current_view_videos" value="" />
                                               <div class="same-height-imgs "  >
                                                   <div id="videos_main_container">


                                                   </div>
                                                   <div class="uk-width-1-1 uk-text-center archive-img-load-more" style="display:none">
                                                       <button class="md-btn md-btn-wave waves-effect waves-button"  id="videos_load_more" >
                                                           تحميل المزيد
                                                       </button>
                                                   </div>
                                               </div>

                                           </div>



                                       </div>
                                   </div>
                                   <div class="uk-width-1-1 modal-upload-img-tab  " id="add_you_tube_video" style="height: 400px;">

                                       <div style="height: 160px !important;padding: 0px 50px 50px 50px;">

                                           <div class="form-group" >
                                               <label>رابط اليوتيوب</label>
                                               <input type="text" class="form-control" id="editor_link_youtube_main">

                                           </div>
                                       </div>

                                       <!-- progress bar -->

                                       <!-- end of progress bar -->
                                   </div>
                                   <div class="uk-width-1-1 modal-upload-img-tab  " id="add_face_book_video" style="height: 400px;">

                                       <div style="height: 160px !important;padding: 0px 50px 50px 50px;">

                                           <div class="form-group" >
                                               <label>رابط فيس</label>
                                               <input type="text" class="form-control" id="editor_link_facebook_main">

                                           </div>
                                       </div>

                                       <!-- progress bar -->

                                       <!-- end of progress bar -->
                                   </div>

                                   <div class="uk-width-1-1 modal-upload-img-tab  " id="uploader_file_container" style="height: 400px;">

                                       <div style="height: 270px; !important;">
                                           <form action="upload.php" method="POST" class="dropzone dropzone-file-area dropify-wrapper drag_drop">
                                               <div id="file_upload-drop" style="height: 270px;" class="dropzone dropzone-file-area dropify-wrapper" id="my-dropzone"  >

                                                   <input type="file" id="files_main_upload" name="files_main_upload" class="upload_form_drag" multiple>
                                                   <p>سحب وافلات الصور هنا</p>
                                               </div>

                                           </form>


                                       </div>
                                       <div class="portlet-body form">
                                           <div class="form-body">

                                               <div class="form-group">
                                                   <div class="row" id="filescontainer" >

                                                   </div>



                                               </div>

                                           </div>
                                       </div>
                                       <!-- progress bar -->

                                       <!-- end of progress bar -->
                                   </div>
                                   <div class="uk-width-1-1 archive-tab " id="files_from_archive">

                                       <div class="uk-grid">

                                           <div class="uk-width-4-4 archive-imgs same-height" id="#main_all_archive" style="margin-right: 35px;">
                                               <div class="uk-grid archive-img-filters ">

                                                   <div class="form-group" >
                                                       <label style="margin-top: 12px;    margin-right: 15px">البحث بالعنوان</label>
                                                       <input style="width: 300px;      margin-top: -27px; margin-right: 99px;" type="text" class="form-control" id="archive_modal_name" name="archive_modal_name">
                                                   </div>
                                                   <input type="hidden" id="up_archive_id" name="up_archive_id"  />


                                               </div>
                                               <input type="text" id="current_view_archive" name="current_view_archive" value="" />
                                               <div class="same-height-imgs "  >
                                                   <div id="archive_main_container">


                                                   </div>
                                                   <div class="uk-width-1-1 uk-text-center archive-img-load-more" style="display:none">
                                                       <button class="md-btn md-btn-wave waves-effect waves-button"  id="archive_load_more" >
                                                           تحميل المزيد
                                                       </button>
                                                   </div>
                                               </div>

                                           </div>



                                       </div>
                                   </div>


                               </div>
                           </div>
                       </div>
                   </div>
               </div>

           </div>

           <div class="uk-modal-footer uk-text-right" >
               <input type="hidden" id="modalFrom" class="modalFrom" value="main_photo" >
               <div class="modal-footer">
                   <button class="md-btn  md-btn-success md-btn-wave-light waves-effect waves-button waves-light" id="save_main_photo" >
                       حفظ
                   </button>

                   <button class="md-btn uk-modal-close md-btn-danger md-btn-wave-light waves-effect waves-button waves-light" id="cancel_uploader"  >
                       الغاء
                   </button>


               </div>
           </div>
       </div>

   </div>

<div class="uk-modal " id="iframe_embed" style="padding-top:8%;">
    <div class="uk-modal-dialog ">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title"> تضمين تغريدة او منشور انستجرام  </h3>
        </div>
        <div class="uk-modal-body">
            <div class="uk-grid">
                <div class="uk-width-1">
                    <div class="parsley-row">
                        <label>كود التضمين <span class="req">*</span></label>
                        <textarea type="text" class="form-control" required  id="iframe_embed_text" rows="5" ></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="md-btn  md-btn-success md-btn-wave-light waves-effect waves-button waves-light"  id="add_ifram_embed">
                حفظ
            </button>
            <button type="button" class="md-btn uk-modal-close md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"  id="cancel_insert_face" >
                الغاء
            </button>
        </div>
    </div>

</div>
<div class="uk-modal " id="details" style="padding-top:8%;" >
    <div class="uk-modal-dialog " >
        <div class="uk-modal-header">
            <h3 class="uk-modal-title" id="title_vote">  </h3>
        </div>
        <div class="uk-modal-body">
            <div class="uk-grid">
                <div class="uk-width-1">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>السؤال</th>
                            <th>عدد المصوتين</th>
                            <th>النسبة المئوية</th>

                        </tr>
                        </thead>
                        <tbody id="result_votes">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="uk-modal-footer uk-text-right">

            <button type="button" class="md-btn uk-modal-close md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"  id="cancel_insert_face" >
                الغاء
            </button>
        </div>
    </div>

</div>

<div class="uk-modal " id="iframe_embed" style="padding-top:8%;">
    <div class="uk-modal-dialog ">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title"> تضمين تغريدة او منشور انستجرام  </h3>
        </div>
        <div class="uk-modal-body">
            <div class="uk-grid">
                <div class="uk-width-1">
                    <div class="parsley-row">
                        <label>كود التضمين <span class="req">*</span></label>
                        <textarea type="text" class="form-control" required  id="iframe_embed_text" rows="5" ></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="md-btn  md-btn-success md-btn-wave-light waves-effect waves-button waves-light"  id="add_ifram_embed">
                حفظ
            </button>
            <button type="button" class="md-btn uk-modal-close md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"  id="cancel_insert_face" >
                الغاء
            </button>
        </div>
    </div>

</div>