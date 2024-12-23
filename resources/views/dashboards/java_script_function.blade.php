@push('scripts')
    {{--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}
    <script src="{{asset('assets/global/plugins/tinymce/tinymce.min.js')}}"></script>

    <script src="{{ asset('assets/global/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('assets/global/uikit/js/uikit-icons.min.js') }}"></script>

    <script>
        var editor_config = {
            path_absolute : "/",
            paste_as_text: true,
            selector: "textarea.my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            valid_elements : '+*[*]',

            extended_valid_elements: "+iframe[width|height|name|align|class|frameborder|allowfullscreen|allow|src|*]," +
                "script[language|type|async|src|charset]" +
                "img[*]" +
                "embed[width|height|name|flashvars|src|bgcolor|align|play|loop|quality|allowscriptaccess|type|pluginspage]" +
                "blockquote[dir|style|cite|class|id|lang|onclick|ondblclick"
                +"|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout"
                +"|onmouseover|onmouseup|title]",

            content_css: ['css/main.css?' + new Date().getTime(),
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                'global/plugins/tinymce/visualblocks/visualblocks.css','global/plugins/tinymce/codesample/css/prism.css'
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | twitter | youtube | uploader | facebookVideo | instagram | twitter_url | source code",
            directionality : 'rtl',
            language_url : '{{asset("assets/apps/scripts/tinymce/langs/ar.js")}}',
            language: 'ar',
            setup: function (ed) {
                var icon_url = "http://www.stickpng.com/assets/images/580b57fcd9996e24bc43c53e.png"
                ed.on('init', function (args) {
                    editor_id = args.target.id;

                });
                ed.addButton('twitter', {
                    title : 'أضف تغريدة',
                    image: "{{ asset('/assets/img/editor/twitter.svg') }}",
                    onclick : function() {

                        var xx= tinyMCE.activeEditor.selection.getContent({format : 'htnl'});
                        if(xx !="")
                        {
                            console.log('sss')
                            var ssdas='';
                            var res_share = xx.replace(" ", "%20");
                            res_share=res_share+ssdas;
                            tinyMCE.execCommand('mceInsertContent',false, '<span class="share-tweet" style="color:#60a6e4"><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text='+res_share+'" target="_blank"><i style="color: #55acee;" class="fa fa-twitter"></i></a>'+ xx + '</span>' );
                        }else{
                            $('#tweet_text').val('');
                            $('#tweet_text').removeClass("input-danger");
                            $('#tweet_text').parent().parent().find(".parsley-errors-list").remove();

                        }



                    }
                });
                ed.addButton('youtube', {
                    title : 'أضف فيديو يوتيوب',
                    image: "{{ asset('/assets/img/editor/youtube.svg') }}",
                    onclick : function() {
                        $('#editor_link_youtube').val('');
                        $('#editor_link_youtube').removeClass("input-danger");
                        UIkit.modal("#add-video-editor").show();
                    }
                });
                ed.addButton('facebookVideo', {
                    title : 'أضف فيس بوك فيديو',
                    image:"{{ asset('/assets/img/editor/facebook.svg') }}",
                    onclick : function() {
                          $('#editor_link_face').val('');
                        $('#editor_link_face').removeClass("input-danger");
                        UIkit.modal("#upload_video_face").show();

                    }
                });
                ed.addButton('instagram', {
                    text:false,
                    icon:true,
                    image:'https://image.flaticon.com/icons/svg/174/174855.svg',
                    onclick: function() {
                        // Open window
                        ed.windowManager.open({
                            title: 'Instagram Embed',
                            body: [
                                {   type: 'textbox',
                                    size: 60,
                                    height: '100px',
                                    name: 'instagram',
                                    label: 'content'
                                }
                            ],
                            onsubmit: function(e) {
                                // Insert content when the window form is submitted
                                console.log(e.data.instagram);
                                var embedCode = e.data.instagram;
                                var script = embedCode.match(/<script.*<\/script>/)[0];
                                var scriptSrc = script.match(/".*\.js/)[0].split("\"")[1];

                                var sc = document.createElement("script");
                                sc.setAttribute("src", scriptSrc);
                                sc.setAttribute("type", "text/javascript");

                                var iframe = document.getElementById(editor_id + "_ifr");
                                var iframeHead = iframe.contentWindow.document.getElementsByTagName('head')[0];

                                embedCode1 = embedCode.replace('//platform.instagram.com/en_US/embeds.js','https://platform.instagram.com/en_US/embeds.js');

                                tinyMCE.activeEditor.insertContent(embedCode1);
                                iframeHead.appendChild(sc);
                                setTimeout(function()
                                {
                                    iframe.contentWindow.instgrm.Embeds.process();

                                }, 1000)
                            }
                        });
                    }
                });
                ed.addButton('twitter_url',
                    {
                        text:false,
                        icon: true,
                        image:'{{asset('images/twitter-xxl.png')}}',

                        onclick: function () {

                            ed.windowManager.open({
                                title: 'Twitter Embed',

                                body: [
                                    {   type: 'textbox',
                                        size: 60,
                                        height: '100px',
                                        name: 'twitter',
                                        label: 'twitter'
                                    }
                                ],
                                onsubmit: function(e) {

                                    var tweetEmbedCode = e.data.twitter;

                                    var script = tweetEmbedCode.match(/<script.*<\/script>/)[0];
                                    var scriptSrc = script.match(/".*\.js/)[0].split("\"")[1];

                                    var sc = document.createElement("script");
                                    sc.setAttribute("src", scriptSrc);
                                    sc.setAttribute("type", "text/javascript");

                                    var iframe = document.getElementById(editor_id + "_ifr");
                                    var iframeHead = iframe.contentWindow.document.getElementsByTagName('head')[0];

                                    embedCode1 =tweetEmbedCode.replace('//platform.twitter.com/widgets.js','https://platform.twitter.com/widgets.js');
//
                                    tinyMCE.activeEditor.insertContent(embedCode1);
                                    iframeHead.appendChild(sc);
                                    setTimeout(function()
                                    {
                                        iframe.contentWindow.twttr.widgets.load();

                                    }, 1000)
//                                    console.log(tweetEmbedCode)
//                                    $.ajax({
//                                        url: "https://publish.twitter.com/?query="+tweetEmbedCode,
//
//                                        dataType: "jsonp",
//                                        async: false,
//                                        success: function(data){
//
//                                             //$("#embedCode").val(data.html);
//                                             $("#preview").html(data.html)
//                                            tinyMCE.activeEditor.insertContent(
//                                                '<div class="div_border" contenteditable="false">' +
//                                                '<img class="twitter-embed-image" src="'+icon_url+'" alt="image" style="width: 50px" " />'
//                                                +data.html+
//                                                '</div>');
//
//                                        },
//                                        error: function (jqXHR, exception) {
//                                            var msg = '';
//                                            if (jqXHR.status === 0) {
//                                                msg = 'Not connect.\n Verify Network.';
//                                            } else if (jqXHR.status == 404) {
//                                                msg = 'Requested page not found. [404]';
//                                            } else if (jqXHR.status == 500) {
//                                                msg = 'Internal Server Error [500].';
//                                            } else if (exception === 'parsererror') {
//                                                msg = 'Requested JSON parse failed.';
//                                            } else if (exception === 'timeout') {
//                                                msg = 'Time out error.';
//                                            } else if (exception === 'abort') {
//                                                msg = 'Ajax request aborted.';
//                                            } else {
//                                                msg = 'Uncaught Error.\n' + jqXHR.responseText;
//                                            }
//                                            alert(msg);
//                                        },
//                                    });
//                                    setTimeout(function() {
//                                     //   iframe.contentWindow.twttr.widgets.load();
//
//                                    }, 1000)
                                }
                            });
                        }
                    });
                ed.addButton('uploader', {
                    title : 'أضف صورة',
                    text: "إضافة صور",
                    onclick : function() {

                        var modalFrom =$('#modalFrom').val();
                        $('#modalFrom').val('post_details');
                        $('#add-main-img').click();

                    }
                });

                ed.on("change", function(e){
                    var str=tinyMCE.activeEditor.getContent({format : 'text'}).toString();
                    // alert(tinyMCE.activeEditor.getContent().toString());
                    // alert($('#post_details').code());
                    var post_details_content= str.replace(/<\/?[^>]+>/gi, '');
                    if(post_details_content.length >151)
                    {
                        post_details_content=post_details_content.substr(0, 150);
                    }
                    post_details_content.replace(/\n|\r/g, "");
                    // alert(post_details_content);
                    var url = window.location.pathname;
                    var id_post = url.substring(url.lastIndexOf('/') + 1);
                    if(id_post !='edit'){
                        $('#summary').val(post_details_content);
                    }

                    $('#content').val(tinyMCE.get('detailes').getContent());
                });
                ed.on('Paste', function (e) {
                    jQuery('#content').val(tinyMCE.get('detailes').getContent());

                });
            }
        };

        tinymce.init(editor_config);

        $(document).on('click','#insert_youtube_link',function() {
            var url = $('#editor_link_youtube').val();

            var video_title="";
            var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
            if(videoid != null) {
                $('#editor_link_youtube').removeClass("input-danger");
                $('#editor_link_youtube').parent().parent().find(".parsley-errors-list").remove();
                var youtube_key="AIzaSyAqh2fEovHAQIStyCp3QmfKlvGZZPXpqqA";
                $.getJSON('https://www.googleapis.com/youtube/v3/videos?id='+videoid[1]+'&key='+youtube_key+'&part=snippet&callback=?',function(data){
                    video_title= data.items[0].snippet.title;
                    var youtube_frame='<div class="article-video-box">'+
                        '<div class="embed-responsive embed-responsive-16by9">'+
                        '<iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/'+videoid[1]+'?rel=0&#038;showinfo=0" frameborder="0" allowfullscreen></iframe>'+
                        '</div>'+
                        '<p>'+video_title+'</p>'+
                        '</div><br/>';
                    tinyMCE.execCommand('mceInsertContent',false, youtube_frame);
                   // $('#upload_video_youtube').modal('hide');
                    UIkit.modal("#add-video-editor").hide();
                });
            } else {
                $('#editor_link_youtube').parent().addClass("has-error");
                $('#editor_link_youtube').parent().append('<div class="parsley-errors-list filled" id="parsley-id-4"><span class="parsley-required">يرجى ادخال رابط يوتيوب صحيح</span></div>');
            }
        });

				$(document).on('click','#insert_facebook_link',function(){
                var url = $('#editor_link_face').val();

                var video_title="";
                var tmp =url.split('/');
                var video_id=0;
        //dd($tmp);
        if(tmp.length >=3){
        if (tmp[tmp.length - 3].toLowerCase()== 'videos') {
        video_id = tmp[tmp.length - 2];
        }
        }else if(tmp.length >=2)
        {
        if(tmp[tmp.length - 2].toLowerCase()== 'videos')
        {
        video_id = tmp[tmp.length - 1];
        }
        }
        else {
        video_id = 0;
        }
        if(video_id != 0) {
         $('#editor_link_face').val('');
          $('#editor_link_face').removeClass("input-danger");
            $.getJSON('https://graph.facebook.com/v2.8/'+video_id+'?fields=description,format,content_category,length&access_token='+app_token+'&format=json&callback=?',function(data){
            video_title= JSON.stringify(data['description']);
            var facebook_frame='<div class="article-video-box">'+
        '<div class="embed-responsive embed-responsive-16by9">'+
        '<iframe src="https://www.facebook.com/plugins/video.php?href='+url+'&width=560&show_text=false&appId={{ env("FACEBOOK_APP_ID") }}&height=315"'+
        'width="560" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" '+
        'allowTransparency="true" allowfullscreen="true"  autoplay="false" show-text="false" show-captions="false"></iframe>'+
        '</div>'+
        '<p>'+video_title+'</p>'+
        '</div><br/>';
        tinyMCE.execCommand('mceInsertContent',false, facebook_frame);
         $('#upload_video_face').modal('hide');
            });
        } else {
         $('#editor_link_youtube').parent().addClass("has-error");
                    $('#editor_link_youtube').parent().append('<div class="parsley-errors-list filled" id="parsley-id-4"><span class="parsley-required">يرجى ادخال رابط فيديو فيس بوك صحيح</span></div>');
                }
        });

	/////////////////////// file_manager
        $(document).on('click','#add-main-img',function(){
            $(".filter_type").removeClass("btn-info");
            $("#all_photo").addClass("btn-info");
            $(".same-height-imgs").css("height", "316px");
            var current_view_images=$('#current_view_images').val();
            var modalFromsss =$('#modalFrom').val();
            $("#files_from_archive").hide();
            console.log(modalFromsss)
            if(modalFromsss=='main_photo' || modalFromsss=='album_images'){
                $("#upload_from_video").hide();
            }else{
                $("#upload_from_video").show();
            }
            if(modalFromsss=='post_details'){
                $("#upload_file_modal").show();
                $("#chose_files_from_archive").show();
            }else{
                $("#upload_file_modal").hide();
                $("#chose_files_from_archive").hide();
            }
            $('#photo_main_desc').removeClass("input-danger");
            $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();
            $('#photo_modal_name').val('');
            $('#uk_dp_start').val('');
            $('#uk_dp_end').val('');
            $('#photo_modal_name').blur();
            $('#uk_dp_start').blur();
            $('#uk_dp_end').blur();
            $('#photo_main_desc').val('');
            $("input[name=val_check_ski11]").removeAttr('checked');
            $("input[name=val_check_ski11]").prop('checked', false);
            $("input[name=val_check_ski11]").parent().removeClass("checked");
            $('#sidebar_photo_data').hide();
            $('#photo_uploading_data').children('.upload_avatar').attr("src","https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-128.png");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text(" ");
            $('.uk-comment').children('.upload_name').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(" ");
            $('#url_image_uploaded').val(" ");
            $('#uploader_photo_url').val("");
            $('#uploader_link_msg').hide();

            ///////////////////////////////////////////
            $('#upload_new_photo').show();
            $('#upload_from_archive').show();
            $('#upload_from_url').show();
            $('#upload_from_archive').show();
            $('#upload_new_photo').removeClass("uk-active");
            $('#upload_from_archive').removeClass("uk-active");
            $('#upload_from_url').removeClass("uk-active");
            $('#upload_file_modal').removeClass("uk-active");
            $('#chose_files_from_archive').removeClass("uk-active");
            $('#upload_from_video').removeClass("uk-active");
            $('#upload_big_photo').removeClass("uk-active");

            /////////////////////////////////////
            $('#uploader_photo_container').removeClass("uk-active");
            $('#uploader_archive').removeClass("uk-active");
            $('#uploader_link').removeClass("uk-active");
            $('#uploader_archive').addClass("uk-active");
            $('#upload_video').removeClass("uk-active");
var modalFrom_test=$("#modalFrom").val();
if(modalFrom_test !='main_photo'){
    $(".archive-img-attr").hide();
    $(".archive-imgs").removeClass('uk-width-3-4');
    $(".archive-imgs").addClass('uk-width-4-4');
}else{
    $(".archive-img-attr").show();
    $(".archive-imgs").removeClass('uk-width-4-4');
    $(".archive-imgs").addClass('uk-width-3-4');

}
var input_upload_from=$("#input_upload_from").val();
if(input_upload_from=='cases'){
    $(".filter_type").hide();
    $("#all_cases").show();
    $("#all_cases").removeClass('btn-default');
    $("#all_cases").addClass('btn-info');
}else{
        $(".filter_type").show();
        $("#all_cases").hide();
    input_upload_from='';
}
            $.ajax({
                url: "{{ asset('dashboard/files_library/get_images') }}",
                type: "POST",
                data: {photo_type:input_upload_from, openPhotosModal:0, current_view_images:current_view_images, _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {

                        UIkit.modal("#add-news-img").show();
                        var has_more= response.has_more;
                        $('#current_view_images').val(response.results_ids);

                        if(response.html_res =='')
                        {
                            $('#photos_main_container').html("<div class='not_found'><h3> عفواً: لا توجد نتائج</h3></div>");
                        }
                        else{
                            var html_res= '<ul class="uk-thumbnav" id="photos_modal_container" >'+response.html_res+" </ul>";
                            $('#photos_main_container').html(html_res);
                        }

                        if(has_more == "1")
                        {
                            $('#photos_load_more').parent().show();
                        }else {
                            $('#photos_load_more').parent().hide();
                        }
                    }}
            });

        });

        $(document).on('click','#photos_load_more',function(){
            $('#photos_load_more').html( ' تحميل المزيد <i class="uk-icon-spinner uk-icon-spin"></i> ');
            $('#photos_load_more').	attr('disabled','disabled');
            var current_view_images=$('#current_view_images').val();
            var photo_modal_name=$('#photo_modal_name').val();


            $.ajax({
                url: "{{ asset('dashboard/files_library/get_images') }}",
                type: "POST",
                data: { openPhotosModal:1,
                    current_view_images:current_view_images,
                    photo_modal_name:photo_modal_name,
                    _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        $('#photos_load_more').html( 'تحميل المزيد ');
                        $('#photos_load_more').	removeAttr('disabled');
                        var has_more= response.has_more;
                        $('#current_view_images').val(response.results_ids);
                        $('#photos_modal_container').append(response.html_res);
                        if(has_more == "1")
                        {
                            $('#photos_load_more').parent().show();
                        }else {
                            $('#photos_load_more').parent().hide();
                        }
                    }}
            });

        });


        $(document).on('input','#photo_modal_name', function() {
            var current_view_images=$('#current_view_images').val();
            var photo_modal_name=$('#photo_modal_name').val();
            var uk_dp_start=$('#uk_dp_start').val();
            var uk_dp_end=$('#uk_dp_end').val();
            $('#photo_main_desc').val('');
            $("input[name=val_check_ski11]").removeAttr('checked');
            $("input[name=val_check_ski11]").prop('checked', false);
            $("input[name=val_check_ski11]").parent().removeClass("checked");
            $('#sidebar_photo_data').hide();
            $('#photo_uploading_data').children('.upload_avatar').attr("src","{{ asset('img/default.png') }}");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text(" ");
            $('.uk-comment').children('.upload_name').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(" ");
            $('#url_image_uploaded').val(" ");

            $('#photos_modal_container').html('<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="96" width="96" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"/></svg></div>');
            $('#photos_load_more').parent().hide();
            $.ajax({
                url: "{{ asset('dashboard/files_library/get_images') }}",
                type: "POST",
                data: {
                    openPhotosModal:0,
                    current_view_images:current_view_images,
                    photo_modal_name:photo_modal_name,
                    _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        var has_more= response.has_more;
                        $('#current_view_images').val(response.results_ids);
                        if(response.html_res =='')
                        {
                            $('#photos_main_container').html("<div class='not_found'><h3> عفواً: لا توجد نتائج</h3></div>");
                        }
                        else{
                            var html_res= '<ul class="uk-thumbnav" id="photos_modal_container" >'+response.html_res+" </ul>";
                            $('#photos_main_container').html(html_res);
                        }
                        if(has_more == "1")
                        {
                            $('#photos_load_more').parent().show();
                        }else {
                            $('#photos_load_more').parent().hide();
                        }


                    }}
            });
        });



        ////// Image Upload
        $(document).on('change','#photo_main_upload',function()
        {

            var src=$("#photo_main_upload").val();
            if(src!="") {
                for (var x = 0; x < this.files.length; x++){
                    var file = this.files[x];
                    var imgSize = this.files[x].size;
                    var imgName = this.files[x].name;

                    var currentDate = new Date();
                    var day = "{{ date('d') }}";
                    var month = "{{ date('m') }}";
                    var year = "{{ date('Y') }}";
                    var image_name_upload = $("#image_name_upload").val();



                    if (!!file.type.match(/image.*/)) {

                        if ((Math.round(imgSize)) <= (2 * 1024 * 1024)) {


                            $('#sidebar_photo_data').show();
                            imgSize = imgSize / 1024;
                            $('#photo_uploading_data').children('.upload_avatar').attr("src", "{{ asset('img/default.jpg') }}");
                            $('.uk-comment').children('.upload_name').text(imgName);
                            $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(day + "  " + convertMonthText(parseInt(month)) + " , " + year);
                            $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(Math.round(Math.round(imgSize * 100) / 100) + " KB ");
                            var image_type=$("#image_type").val()
                            formdata = new FormData();
                            formdata.append('image', file);
                            formdata.append('image_id', x);
                            formdata.append('upload_from', $("#input_upload_from").val());
                            formdata.append('photo_caption', image_name_upload);
                            formdata.append('image_type', image_type);
                            if ($('#add_water_mark').is(":checked"))
                            {
                                var add_water_mark=1
                            }else{
                                var add_water_mark=0
                            }
                            formdata.append('water_mark', add_water_mark);

                            formdata.append('_token', "{{ csrf_token() }}");
                            // $('#uploader_span_btn').html('<i class="uk-icon-spinner uk-icon-spin"></i> جاري الرفع');
                            // $('#photo_main_upload').attr('disabled', 'disabled');
                            // $('#upload_photo_error').remove();
                            //
                            // $('#upload_from_url').addClass("uk-disabled");
                            // $('#upload_from_archive').addClass("uk-disabled");
                            //
                            // $('input').attr('disabled', 'disabled');
                            // $('button').attr('disabled', 'disabled');
                            var html_loading='<div class="col-sm-3"  id="imageTTT_'+x+'"  style="margin-top: 10px;">'+
                                '<div class="md-preloader md-preloader-success">'+
                                '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"/></svg>'+
                                '</div>'+
                                '</div>';

                            $('#photoscontainer').append(html_loading);
                            $.ajax({
                                url: "{{ asset('dashboard/files_library/upload_image') }}",
                                type: "POST",
                                data: formdata,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    if (response.success) {
                                        ////////////////////////
                                        var image_id=response.image_id
                                        $("#imageTTT_"+image_id).remove();

                                        var html_loading_s='<div class="col-sm-3"  id="imageTTT_'+image_id+'"  style="margin-top: 10px;width: 130px;">'+
                                            '<img  class="img-responsive" style="height:100px" src="{{asset('/')}}'+response.image_name+'" alt="choose" >'+
                                            '</div>';
                                        $('#photoscontainer').append(html_loading_s);
                                        //////////////////////////////////////////
                                        $('#photo_main_desc').removeClass("input-danger");
                                        $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();
                                        $('#upload_from_url').removeClass("uk-disabled");
                                        $('#upload_from_archive').removeClass("uk-disabled");
                                        $('#uploader_span_btn').html('اختر ملف للرفع');
                                        $('#photo_main_upload').removeAttr('disabled');
                                        $('input').removeAttr('disabled');
                                        $('button').removeAttr('disabled');
                                        ///////////////////////////////////////////////
                                        var number_image=Number(image_id)+1
                                        if(number_image==x){
                                            setTimeout(function(){

                                                $('#upload_new_photo').removeClass("uk-active");
                                                $('#upload_from_archive').removeClass("uk-active");
                                                $('#upload_from_url').removeClass("uk-active");
                                                $('#upload_from_archive').addClass("uk-active");
                                                $('#uploader_photo_container').removeClass("uk-active");
                                                $('#uploader_archive').removeClass("uk-active");
                                                $('#uploader_link').removeClass("uk-active");
                                                $('#uploader_archive').addClass("uk-active");
                                                $('#upload_big_photo').removeClass("uk-active");

                                                ///////////////////////////////////////////////
                                                $('#photoscontainer').html();
                                            }, 1500);
                                        }


                                        var photo_name = response.image_name;
                                        var photo_name_arr = photo_name;
                                        var photo_name_thumb = photo_name_arr;
                                        $('#current_view_images').val($('#current_view_images').val() + "," + response.photo_id);
                                        $('#photo_uploading_data').children('.upload_avatar').attr("src", "{{ asset('/') }}" + photo_name_thumb);
                                        $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text(response.imgWidth);
                                        $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text(response.imgHeight);


                                            $("ul#photos_modal_container li").removeClass('img-active');


                                        $('#photos_modal_container').prepend(response.html_res);
                                        $('#img_upload_options').show();
                                        $('#up_image_id').val(response.photo_id);
                                        $("#up_video_id").val('');
                                        $('#img_upload_options').children(".delPhoto").attr('id', 'del_uploader_photo_' + response.photo_id);
                                        $('#url_image_uploaded').val("{{asset('/')}}" + response.image_name);
                                        $('#photo_main_desc').val('');

                                            $("input[name=val_check_ski11]").removeAttr('checked');
                                            $("input[name=val_check_ski11]").prop('checked', false);
                                            $("input[name=val_check_ski11]").parent().removeClass("checked");


                                    }else{

                                        $('#file_upload-drop').append(
                                            '<div class="uk-push-1-10 uk-margin-top uk-width-8-10  " id="upload_photo_error" ><div class="uploader-alert uk-alert uk-alert-danger" data-uk-alert="">' +
                                            response.message+
                                            ' </div></div>');
                                    }
                                }
                            });


                        }
                        else {
                            $('#upload_photo_error').remove();
                            $('#file_upload-drop').append(
                                '<div class="uk-push-1-10 uk-margin-top uk-width-8-10  " id="upload_photo_error" ><div class="uploader-alert uk-alert uk-alert-danger" data-uk-alert="">' +
                                'يرجى رفع صورة لا يزيد حجمها عن 2 ميغابايت </div></div>');
                        }
                    } else {
                        $('#upload_photo_error').remove();
                        $('#file_upload-drop').append(
                            '<div class="uk-push-1-10 uk-margin-top uk-width-8-10  " id="upload_photo_error" ><div class="uploader-alert uk-alert uk-alert-danger" data-uk-alert="">' +
                            'يرجى رفع ملف  </div></div>');
                    }
                }

            }else {
                $('#upload_photo_error').remove();
                $('#file_upload-drop').append(
                    '<div class="uk-push-1-10 uk-margin-top uk-width-8-10  " id="upload_photo_error" ><div class="uploader-alert uk-alert uk-alert-danger" data-uk-alert="">'+
                    'يرجى رفع صورة </div></div>');


            }


        });


        //         active clicked img
        $(document).on('click','ul#photos_modal_container li', function(){
            var $this = $(this);
            var modalFrom_selected=$("#modalFrom").val();
            $("#up_video_id").val('');
            if ($this.hasClass('img-active')) {
                $this.removeClass('img-active');
                $('#photo_main_desc').removeClass("input-danger");
                $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();
                $('#photo_main_desc').val('');
                $("input[name=val_check_ski11]").removeAttr('checked');
                $("input[name=val_check_ski11]").prop('checked', false);
                $("input[name=val_check_ski11]").parent().removeClass("checked");
                $('#photo_uploading_data').children('.upload_avatar').attr("src","{{ asset('img/default.jpg') }}");
                $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text(" ");
                $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text(" ");
                $('.uk-comment').children('.upload_name').text(" ");
                $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(" ");
                $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(" ");
                $('#sidebar_photo_data').hide();
            } else if (!$this.hasClass('img-active')) {
               if(modalFrom_selected=="main_photo"){
                   $("ul#photos_modal_container li").removeClass('img-active');
               }
                $('#photo_main_desc').removeClass("input-danger");
                $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();
                $this.addClass('img-active');
                var iid=$this.attr("id");
                var id_arr=iid.split("_");
                var photo_id=id_arr[2];
                if(modalFrom_selected=="main_photo"){
                    $.ajax({
                        url: "{{ asset('dashboard/files_library/details')}}",
                        type: 'POST',
                        dataType: 'json',
                        data: { photo_id:photo_id },
                        success: function(response) {
                            if(response.success){

                                $('#sidebar_photo_data').show();
                                var photo_data=response.photo_data;
                                var photo_created_at=photo_data.created_at;
                                var photo_created_at_arr=photo_created_at.split(" ");
                                var photo_created_at_date=	photo_created_at_arr[0].split("-");
                                var day=photo_created_at_date[2];
                                var month=convertMonthText(parseInt(photo_created_at_date[1]));
                                var year=photo_created_at_date[0];
                                var photo_name=	photo_data.file_name;
                                var photo_name_arr=photo_name.split(".");
                                var photo_name_thumb=photo_data.thump;
                                $('#photo_main_desc').val(photo_data.photo_caption);
                                $('#photo_main_desc').removeClass("input-danger");
                                $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();
                                $('#photo_uploading_data').children('.upload_avatar').attr("src","{{ asset('/') }}"+photo_name_thumb);
                                $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text(response.imgWidth);
                                $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text(response.imgHeight);
                                $('.uk-comment').children('.upload_name').text(photo_data.real_name);
                                $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(day+"  "+month+" , "+year);
                                $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(response.imgSize);
                                $('#img_upload_options').show();
                                $('#up_image_id').val(photo_data.id);
                                $('#img_upload_options').children(".delPhoto").attr('id','del_uploader_photo_'+photo_data.id);
                                $('#url_image_uploaded').val("{{asset('/')}}"+response.photo_data.file_name);
                                $("input[name=val_check_ski11]").removeAttr('checked');
                                $("input[name=val_check_ski11]").prop('checked', false);
                                $("input[name=val_check_ski11]").parent().removeClass("checked");
                            }
                        }
                    });
                }

            } else {
                $this.addClass('img-active');
                $('#photo_main_desc').removeClass("input-danger");
                $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();
            }

        });

        $("#uploader_photo_url").bind('input', function() {
            var uploader_photo_url=$('#uploader_photo_url').val();
            if(checkURL(uploader_photo_url)){
                $('input').attr('disabled','disabled');
                $('#uploader_link_container').find('.parsley-row').addClass("icon-loading");
                $('#uploader_link_container').find('.parsley-row').append('<i class="uk-icon-spinner uk-icon-spin"></i>');
                $('#upload_photo_error').remove();

                $('#upload_new_photo').addClass("uk-disabled");
                $('#upload_from_archive').addClass("uk-disabled");
                $.ajax({
                    url: "{{ URL::to('dashboard/photos/modal/url/save') }}",
                    type: "POST",
                    data: {uploader_photo_url : uploader_photo_url,upload_from:$("#input_upload_from").val(),_token:"{{ csrf_token() }}" },
                    success: function(response){
                        if(response.success)
                        {
                            $('#uploader_link_msg').hide();
                            $('#uploader_link_msg').html('');
                            $('#photo_main_desc').removeClass("input-danger");
                            $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();
                            $('input').removeAttr("disabled");
                            $('#uploader_link_container').find('.parsley-row').removeClass("icon-loading");
                            $('#uploader_link_container').find('.parsley-row').children(".uk-icon-spinner").remove();
                            $('#upload_new_photo').removeClass("uk-disabled");
                            $('#upload_from_archive').removeClass("uk-disabled");
                            $('#uploader_photo_url').val('');
                            $('#upload_new_photo').removeClass("uk-active");
                            $('#upload_from_archive').removeClass("uk-active");
                            $('#upload_from_url').removeClass("uk-active");
                            $('#upload_from_archive').addClass("uk-active");
                            $('#upload_big_photo').removeClass("uk-active");

                            ///////////////////////////////////////////////
                            $('#uploader_photo_container').removeClass("uk-active");
                            $('#uploader_archive').removeClass("uk-active");
                            $('#uploader_link').removeClass("uk-active");
                            $('#uploader_archive').addClass("uk-active");
                            //////////////////////////////////////////////////////
                            $('#sidebar_photo_data').show();
                            $("ul#photos_modal_container li").removeClass('img-active');
                            $('#photos_modal_container').prepend(response.html_res);
                            var photo_data=response.photo_data;
                            $('#current_view_images').val($('#current_view_images').val()+","+photo_data.id);
                            var photo_created_at=photo_data.created_at;
                            var photo_created_at_arr=photo_created_at.split(" ");
                            var photo_created_at_date=	photo_created_at_arr[0].split("-");
                            var day=photo_created_at_date[2];
                            var month=convertMonthText(parseInt(photo_created_at_date[1]));
                            var year=photo_created_at_date[0];
                            var photo_name=	photo_data.photo_name;
                            var photo_name_arr=photo_name.split(".");
                            var photo_name_thumb=photo_name_arr[0]+'_thumb_small.'+photo_name_arr[1];
                            $('#photo_uploading_data').children('.upload_avatar').attr("src","{{ URL::asset('uploads/photos') }}"+"/"+year+"/"+photo_created_at_date[1]+"/"+day+"/"+photo_data.photo_name);
                            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text(response.imgWidth);
                            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text(response.imgHeight);
                            $('.uk-comment').children('.upload_name').text(photo_data.real_name);
                            $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(day+"  "+month+" , "+year);
                            $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(response.imgSize);
                            $('#img_upload_options').show();
                            $('#up_image_id').val(photo_data.id);
                            $('#img_upload_options').children(".delPhoto").attr('id','del_uploader_photo_'+photo_data.id);
                            $('#url_image_uploaded').val("{{asset('/')}}"+response.photo_data.file_name);
                            $('#photo_main_desc').val('');
                            $("input[name=val_check_ski11]").removeAttr('checked');
                            $("input[name=val_check_ski11]").prop('checked', false);
                            $("input[name=val_check_ski11]").parent().removeClass("checked");
                        }
                    }
                });
            }else {
                $('#uploader_link_msg').html(
                    '<div class="uk-width-8-10" id="upload_photo_error" ><div class="uk-alert uk-alert-danger" data-uk-alert="">'+
                    '<a href="#" class="uk-alert-close uk-close"></a>يرجى رفع رابط صحيح لصورة</div></div>');
                $('#uploader_link_msg').show();
            }
        });

        $(document).on('click','.delPhoto',function()
        {
            var id=$(this).attr("id");
            var id_arr=id.split("_");
            var photo_id=id_arr[3];
            $.ajax({

                url: '{{ asset("dashboard/files_library") }}/'+photo_id,
                type: "DELETE",
                data: {'id':photo_id,'model':'photos'},
                success: function(response) {

                        $('#img_upload_'+photo_id).remove();
                        $('#photo_uploading_data').children('.upload_avatar').attr("src","{{ asset('img/default.jpg') }}");
                        $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text("");
                        $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text("");
                        $('.uk-comment').children('.upload_name').text(" ");
                        $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text("");
                        $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text("");
                        $('#sidebar_photo_data').hide();
                        $('ul#photos_modal_container li').removeClass('img-active');
                        $(this).attr("id"," ");
                     //   UIkit.modal.alert(response.msg1);

                }
            });

        });



        // window height
        $('.same-height').css('height', $(window).height()-175 );
        $('.same-height-imgs').css('height', $(window).height()-255 );
        $('.same-height-overflow').css('height', $(window).height()-220 );
        function convertMonthText(month)
        {
            var result="";

            switch(month)
            {
                case 1: result="يناير"; break;
                case 2: result="فبراير"; break;
                case 3: result="مارس"; break;
                case 4: result="أبريل"; break;
                case 5: result="مايو"; break;
                case 6: result="يونيو"; break;
                case 7: result="يوليو"; break;
                case 8: result="أغسطس"; break;
                case 9: result="سبتمبر"; break;
                case 10: result="أكتوبر"; break;
                case 11: result="نوفمبر"; break;
                case 12: result="ديسمبر"; break;
                default: result="";
            }
            return result;
        }

        function copy()
        {
            try
            {
                if($('#url_image_uploaded').val() !=''){
                    $('#url_image_uploaded').select();
                    document.execCommand('copy');
                    $('#copy_done').show();

                    setTimeout(function(){
                        $('#copy_done').hide();
                    },1500);
                }

            }
            catch(e)
            {
                alert(e);
            }
        }
        $(document).on('click','#save_main_photo',function(){
            console.log("HHHHHHHHHHHHHHHHHHHHH");
            var photo_id=$('#up_image_id').val();
            var archive =  $("input[name=val_check_ski11]:checked").val();
            var modalFromsss =$('#modalFrom').val();
            var photo_main_desc=$('#photo_main_desc').val();
            var photo_id_array=[];
            var video_id=$("#up_video_id").val();
            /******* Code Add By Moman Albelbesi ********/
            //console.log('This is Model :'+modalFromsss);
            if(modalFromsss =='main_photo'){
                let photo = $('#main_photo_id').val();
                let newName = $('#post_photo_caption').val();

                 //  if(photo){
                   if(photo_id){
                       $.ajax({
                           url: "{{ asset('dashboard/files_library/saveNameOfFile') }}",
                           type: 'POST',
                           dataType: 'json',
                           data: {modalFromsss:modalFromsss, file_id:photo,post_photo_caption:newName },
                           success: function(response) {
                               if(response.success) {
                                   swal({
                                       title:"تم الحفظ بنجاح",
                                       text: "",
                                       type: "success",
                                       timer: 3000,
                                       showConfirmButton: false
                                   });
                               }
                               $('#post_photo_caption').val(newName);
                           }
                       })
                   }else{
                       swal({
                           title:"الرجاء اختيار الصورة",
                           text: "",
                           type: "error",
                           timer: 2000,
                           showConfirmButton: false
                       });
                   }
            }
            /****** End Of Code ****/
            if(modalFromsss !='main_photo'){
                $(".img-active").each(function () {
                    var all_idd=$(this).attr('id');
                    var on_idd=all_idd.split('_');
                    photo_id_array.push(on_idd[2])
                })
            }
            if(modalFromsss=='main_facebook'){
                $("#delet_video").show();
                var url = $('#editor_link_facebook_main').val();

                var video_title="";
                var tmp =url.split('/');
                var video_id=0;
                //dd($tmp);
                if(tmp.length >=3){
                    if (tmp[tmp.length - 3].toLowerCase()== 'videos') {
                        video_id = tmp[tmp.length - 2];
                    }
                }else if(tmp.length >=2)
                {
                    if(tmp[tmp.length - 2].toLowerCase()== 'videos')
                    {
                        video_id = tmp[tmp.length - 1];
                    }
                }
                else {
                    video_id = 0;
                }
                if(video_id != 0) {
                    $('#editor_link_facebook').removeClass("input-danger");
                    $('#editor_link_facebook').parent().parent().find(".parsley-errors-list").remove();
                    var app_token="{{ getAppToken() }}";
                    $.getJSON('https://graph.facebook.com/v2.8/'+video_id+'?fields=description,format,content_category,length&access_token='+app_token+'&format=json&callback=?',function(data){
                        video_title= JSON.stringify(data['description']);
                        var facebook_frame='<div class="article-video-box">'+
                            '<div class="embed-responsive embed-responsive-16by9">'+
                            '<iframe src="https://www.facebook.com/plugins/video.php?href='+url+'&width=560&show_text=false&appId={{ env("FACEBOOK_APP_ID") }}&height=315"'+
                            'width="315" height="200" style="border:none;overflow:hidden" scrolling="no" frameborder="0" '+
                            'allowTransparency="true" allowfullscreen="true"  autoplay="false" show-text="false" show-captions="false"></iframe>'+
                            '</div>'+
                            '</div><br/>';
                        $("#put_video").html(facebook_frame);
                        $("#main_youtube").val('');
                        $("#video_id").val('');
                        $("#main_facebook").val(url);
                        UIkit.modal("#add-news-img").hide();
                    });
                } else {
                    $('#editor_link_facebook_main').addClass("input-danger");
                    $('#editor_link_facebook_main').parent().parent().append('<div class="parsley-errors-list filled" id="parsley-id-4"><span class="parsley-required">يرجى ادخال رابط فيس بوك فيديو صحيح</span></div>');
                }
            }
else if(modalFromsss=='main_youtube'){
    $("#delet_video").show();

                var video_title = "";
                var url = $("#editor_link_youtube_main").val();
                $("#main_youtube").val(url);
     $("#main_facebook").val('');
      $("#video_id").val('');
        var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
        if (videoid != null) {
            $('#editor_link_youtube').removeClass("input-danger");
            $('#editor_link_youtube').parent().parent().find(".parsley-errors-list").remove();
            var youtube_key = "AIzaSyAqh2fEovHAQIStyCp3QmfKlvGZZPXpqqA";
            $.getJSON('https://www.googleapis.com/youtube/v3/videos?id=' + videoid[1] + '&key=' + youtube_key + '&part=snippet&callback=?', function (data) {
                video_title = data.items[0].snippet.title;
                var youtube_frame = '<div class="article-video-box">' +
                    '<div class="embed-responsive embed-responsive-16by9">' +
                    '<iframe class="embed-responsive-item" width="315" height="200" src="https://www.youtube.com/embed/' + videoid[1] + '?rel=0&#038;showinfo=0" frameborder="0" allowfullscreen></iframe>' +
                    '</div>' +
                    '<p>' + video_title + '</p>' +
                    '</div><br/>';
                $("#put_video").html(youtube_frame)

            });
        }
    UIkit.modal("#add-news-img").hide();
}
else if(modalFromsss=='archive'){
                var file_id=$("#up_archive_id").val();
                $.ajax({
                    url: "{{ asset('dashboard/files_library/details_archive')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: {modalFromsss:modalFromsss, file_id:file_id },
                    success: function(response) {
                        if(response.success) {
                            var file_url=response.image_html
                            tinyMCE.execCommand('mceInsertContent', false, file_url);
                            UIkit.modal("#add-news-img").hide();
                        }
                    }
                });

            }
            else if(photo_id !='' || photo_id_array.length || video_id!='')
            {
                    $.ajax({
                        url: "{{ asset('dashboard/files_library/details')}}",
                        type: 'POST',
                        dataType: 'json',
                        data: {modalFromsss:modalFromsss,photo_array:photo_id_array, photo_id:photo_id, video_id:video_id,photo_main_desc:$("#photo_main_desc").val() },
                        success: function(response) {
                            if(response.success) {
                                $('input').attr('disabled', 'disabled');
                                $('button').attr('disabled', 'disabled');
                                $('#save_main_photo').html(' حفظ <i class="uk-icon-spinner uk-icon-spin"></i> ');
                                $('#photo_main_desc').removeClass("input-danger");
                                $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();

                                $('input').removeAttr('disabled');
                                $('button').removeAttr('disabled');
                                $('#save_main_photo').html(' حفظ ');
                                var modalFrom = $('#modalFrom').val();
                                var video_frame = response.video;
                                var vot_photo = $("#get_type_photo").val();

                                if (vot_photo == undefined || vot_photo == '') {

                                if (video_frame) {

                                    if (modalFrom == "post_details") {
                                        if (video_frame && !video_frame.file_name && video_frame.youtube_link) {
                                            var video_title = "";
                                            var url = video_frame.youtube_link
                                            var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
                                            if (videoid != null) {
                                                $('#editor_link_youtube').removeClass("input-danger");
                                                $('#editor_link_youtube').parent().parent().find(".parsley-errors-list").remove();
                                                var youtube_key = "AIzaSyAqh2fEovHAQIStyCp3QmfKlvGZZPXpqqA";
                                                $.getJSON('https://www.googleapis.com/youtube/v3/videos?id=' + videoid[1] + '&key=' + youtube_key + '&part=snippet&callback=?', function (data) {
                                                    video_title = data.items[0].snippet.title;
                                                    var youtube_frame = '<div class="article-video-box">' +
                                                        '<div class="embed-responsive embed-responsive-16by9">' +
                                                        '<iframe class="embed-responsive-item" width="600" height="400" src="https://www.youtube.com/embed/' + videoid[1] + '?rel=0&#038;showinfo=0" frameborder="0" allowfullscreen></iframe>' +
                                                        '</div>' +
                                                        '<p>' + video_title + '</p>' +
                                                        '</div><br/>';
                                                    tinyMCE.execCommand('mceInsertContent', false, youtube_frame);
                                                });
                                            }
                                        }
                                        if (video_frame && video_frame.file_name) {

                                            var youtube_frame = '<video width="600" height="300" controls>' +
                                                '<source src="{{asset('/')}}' + video_frame.file_name + '" type="video/mp4">' +
                                                '</video>';
                                            tinyMCE.execCommand('mceInsertContent', false, youtube_frame);
                                        }
                                    } else {
                                        $("#delet_video").show();
                                        $("#video_id").val(video_frame.id);
                                        if (video_frame && !video_frame.file_name && video_frame.youtube_link) {
                                            var video_title = "";
                                            var url = video_frame.youtube_link
                                            var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
                                            if (videoid != null) {
                                                $('#editor_link_youtube').removeClass("input-danger");
                                                $('#editor_link_youtube').parent().parent().find(".parsley-errors-list").remove();
                                                var youtube_key = "AIzaSyAqh2fEovHAQIStyCp3QmfKlvGZZPXpqqA";
                                                $.getJSON('https://www.googleapis.com/youtube/v3/videos?id=' + videoid[1] + '&key=' + youtube_key + '&part=snippet&callback=?', function (data) {
                                                    video_title = data.items[0].snippet.title;
                                                    var youtube_frame = '<div class="article-video-box">' +
                                                        '<div class="embed-responsive embed-responsive-16by9">' +
                                                        '<iframe class="embed-responsive-item" width="315" height="200" src="https://www.youtube.com/embed/' + videoid[1] + '?rel=0&#038;showinfo=0" frameborder="0" allowfullscreen></iframe>' +
                                                        '</div>' +
                                                        '<p>' + video_title + '</p>' +
                                                        '</div><br/>';
                                                    $("#put_video").html(youtube_frame)

                                                });
                                            }
                                        }
                                        if (video_frame && video_frame.file_name) {

                                            var youtube_frame = '<video width="315" controls>' +
                                                '<source src="' + video_frame.file_name + '" type="video/mp4">' +
                                                '</video>';
                                            $("#put_video").html(youtube_frame)
                                        }

                                    }


                                } else {
                                    if (modalFrom == "post_details") {
                                        var add_photo_inside_details = response.image_html;
                                        tinyMCE.execCommand('mceInsertContent', false, add_photo_inside_details);
                                    } else if (modalFrom == "album_images") {
                                        var add_photo_inside_details = response.image_html;
                                        $("#album_imagess").append(add_photo_inside_details);
                                        var album_image_array = [];
                                        var album_image_input = $("#album_image_array").val();

                                        if (album_image_input != '') {
                                            album_image_array = JSON.parse(album_image_input)
                                        }
                                        // album_image_array.push(photo_id_array)
                                        var children_image = album_image_array.concat(photo_id_array);
                                        var new_array = JSON.stringify(children_image)
                                        $("#album_image_array").val(new_array);

                                    } else {
                                        $("#main_photo_id").val(response.photo_data.id)
                                        $('#photo_main_view_src').attr("src", '{{ asset('/') }}' + response.photo_data.thump370);
                                        $('#photo_main_view_src').attr("title", response.photo_data.photo_caption);
                                        // if(response.main_photo_archive =="1"){
                                        //     $('#photo_main_view_archive').show();
                                        // }else{
                                        //     $('#photo_main_view_archive').hide();
                                        // }
                                        $("#post_photo_caption").show()
                                        //This Line Add Commit to it By Moman Al belbesi
                                            //$("#post_photo_caption").attr('disabled', 'disabled');
                                        // The End Commit
                                        $('#main_photo_id').val(photo_id);
                                        $('#post_photo_caption').val(photo_main_desc);
                                        $('#post_photo_caption').focus();
                                        $('#photo_main_view_container').show();
                                        $('#photo_main_view_desc').text(response.photo_data.photo_caption);
                                    }
                                }
                            }else{
                                    var photo_answer=vot_photo.split('_');
                                    $("#anser_photo_"+photo_answer[2]).val(response.photo_data.id)
                                    $('#answer_photo_'+photo_answer[2]).attr("src", '{{ asset('/') }}' + response.photo_data.thump);
                                }
                                $('#modalFrom').val('main_photo');

                                UIkit.modal("#add-news-img").hide();
                                $('#photo_main_desc').val('');
                                $("input[name=val_check_ski11]").removeAttr('checked');
                                $("input[name=val_check_ski11]").prop('checked', false);
                                $("input[name=val_check_ski11]").parent().removeClass("checked");
                                $('#photo_uploading_data').attr("src","{{ asset('img/default.jpg') }}");

                                $('#sidebar_photo_data').hide();
                                $('ul#photos_modal_container li').removeClass('img-active');
                                $(this).attr("id"," ");

                            }
                        }
                    });

            }else{
                $('#photo_main_desc').addClass("input-danger");
                $('#photo_main_desc').parent().parent().append('<div class="parsley-errors-list filled" id="parsley-id-4"><span class="parsley-required">يرجى اختيار صورة </span></div>');

            }
        });

        $(document).on('click','#cancel_uploader',function()
        {
            $('#modalFrom').val('main_photo');
        });
        $(document).on('click','.filter_type',function()
        {
            $(".filter_type").removeClass("btn-info");
            $(this).addClass("btn-info");
            var photo_type_all=$(this).attr('id');
            var photo_type=photo_type_all.split('_');
            var current_view_images=$('#current_view_images').val();
            var photo_modal_name=$('#photo_modal_name').val();
            var uk_dp_start=$('#uk_dp_start').val();
            var uk_dp_end=$('#uk_dp_end').val();
            $('#photo_main_desc').val('');
            $("input[name=val_check_ski11]").removeAttr('checked');
            $("input[name=val_check_ski11]").prop('checked', false);
            $("input[name=val_check_ski11]").parent().removeClass("checked");
            $('#sidebar_photo_data').hide();
            $('#photo_uploading_data').children('.upload_avatar').attr("src","{{asset('img/default.jpg') }}");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text(" ");
            $('.uk-comment').children('.upload_name').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(" ");
            $('#url_image_uploaded').val(" ");

            $('#photos_modal_container').html('<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="96" width="96" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"/></svg></div>');
            $('#photos_load_more').parent().hide();
            $.ajax({
                url: "{{ asset('dashboard/files_library/get_images') }}",
                type: "POST",
                data: {
                    openPhotosModal:0,
                    current_view_images:current_view_images,
                    photo_modal_name:photo_modal_name,
                    photo_type:photo_type[1],
                    _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        var has_more= response.has_more;
                        $('#current_view_images').val(response.results_ids);
                        if(response.html_res =='')
                        {
                            $('#photos_main_container').html("<div class='not_found'><h3> عفواً: لا توجد نتائج</h3></div>");
                        }
                        else{
                            var html_res= '<ul class="uk-thumbnav" id="photos_modal_container" >'+response.html_res+" </ul>";
                            $('#photos_main_container').html(html_res);
                        }
                        if(has_more == "1")
                        {
                            $('#photos_load_more').parent().show();
                        }else {
                            $('#photos_load_more').parent().hide();
                        }


                    }}
            });
        });


        $(document).on('click','#add_image_album',function()
        {
            var modalFrom =$('#modalFrom').val();
            $('#modalFrom').val('album_images');
            $('#add-main-img').click();

        });
        $(document).on('click','.delete_image',function()
        {
            $(this).parent().remove();
            var image_ids=$(this).attr('id');
            var on_id=image_ids.split('_');
            var album_image_input=$("#album_image_array").val();

                var album_image_array=  JSON.parse(album_image_input)
            for(var i = album_image_array.length - 1; i >= 0; i--) {
                if(on_id[1] == album_image_array[i]) {
                    album_image_array.splice(i, 1);
                }
            }
            if(album_image_array.length>0){
                var new_array=JSON.stringify(album_image_array)
                $("#album_image_array").val(new_array)
            }
            else{
                $("#album_image_array").val('')
            }


        });


        $(document).on('click','#upload_from_video',function(){
            $(".filter_type").removeClass("btn-info");
            $(".same-height-imgs").css("height", "316px");
            $('#files_from_archive').hide();
            var current_view_videos=$('#current_view_videos').val();

            $.ajax({
                url: "{{ asset('dashboard/files_library/get_videos') }}",
                type: "POST",
                data: { openPhotosModal:0, current_view_videos:current_view_videos, _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        $("#all_video_category").html(response.category_html);
                        var has_more= response.has_more;
                        $('#current_view_images').val(response.results_ids);

                        if(response.html_res =='')
                        {
                            $('#videos_main_container').html("<div class='not_found'><h3> عفواً: لا توجد نتائج</h3></div>");
                        }
                        else{
                            var html_res= '<ul class="uk-thumbnav" id="videos_modal_container" >'+response.html_res+" </ul>";
                            $('#videos_main_container').html(html_res);
                        }

                        if(has_more == "1")
                        {
                            $('#videos_load_more').parent().show();
                        }else {
                            $('#videos_load_more').parent().hide();
                        }
                    }}
            });

        });


        $(document).on('click','ul#videos_modal_container li', function(){

            var $this = $(this);
            if ($this.hasClass('img-active')) {
                $this.removeClass('img-active');

                $("ul#videos_modal_container li").removeClass('img-active');
            }else{
                $("ul#videos_modal_container li").removeClass('img-active');
var idd=$this.attr('id');
var id_split=idd.split('_');
                $this.addClass('img-active');
                $("#up_video_id").val(id_split[2]);
            }


        });
        $(document).on('click','#add_video_file',function () {
            $("#upload_from_video").show();
            $("#upload_you_tube").show();
            $("#upload_face_bokk").show();
            $(".filter_type").removeClass("btn-info");
            $("#all_photo").addClass("btn-info");
            $(".same-height-imgs").css("height", "316px");
            var current_view_images=$('#current_view_images').val();
            $('#photo_main_desc').removeClass("input-danger");
            $('#photo_main_desc').parent().parent().find('.parsley-errors-list').remove();
            $('#photo_modal_name').val('');
            $('#uk_dp_start').val('');
            $('#uk_dp_end').val('');
            $('#photo_modal_name').blur();
            $('#uk_dp_start').blur();
            $('#uk_dp_end').blur();
            $('#photo_main_desc').val('');
            $("input[name=val_check_ski11]").removeAttr('checked');
            $("input[name=val_check_ski11]").prop('checked', false);
            $("input[name=val_check_ski11]").parent().removeClass("checked");
            $('#sidebar_photo_data').hide();
            $('#photo_uploading_data').children('.upload_avatar').attr("src","https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-128.png");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_width').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_dimensions').children('#upload_img_heigth').text(" ");
            $('.uk-comment').children('.upload_name').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(" ");
            $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(" ");
            $('#url_image_uploaded').val(" ");
            $('#uploader_photo_url').val("");
            $('#uploader_link_msg').hide();
            $('#editor_link_facebook_main').val("");
            $('#editor_link_youtube_main').val("");
            ///////////////////////////////////////////
            $('#upload_new_photo').hide();
            $('#upload_from_archive').hide();
            $('#upload_from_url').hide();
            $('#upload_from_archive').hide();
            $('#upload_big_photo').hide();

            $('#upload_from_video').addClass("uk-active");

            /////////////////////////////////////
            $('#uploader_photo_container').removeClass("uk-active");
            $('#upload_face_bokk').removeClass("uk-active");
            $('#uploader_photo_container').removeClass("uk-active");
            $('#uploader_archive').removeClass("uk-active");
            $('#uploader_link').removeClass("uk-active");
            $('#uploader_archive').removeClass("uk-active");
            $('#upload_big_photo').removeClass("uk-active");

            $('#upload_video').addClass("uk-active");
            $("#modalFrom").val('main_video');

            var current_view_videos=$('#current_view_videos').val();

            $.ajax({
                url: "{{ asset('dashboard/files_library/get_videos') }}",
                type: "POST",
                data: { openPhotosModal:0, current_view_videos:current_view_videos, _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        $("#all_video_category").html(response.category_html);
                        UIkit.modal("#add-news-img").show();
                        var has_more= response.has_more;
                        $('#current_view_images').val(response.results_ids);

                        if(response.html_res =='')
                        {
                            $('#videos_main_container').html("<div class='not_found'><h3> عفواً: لا توجد نتائج</h3></div>");
                        }
                        else{
                            var html_res= '<ul class="uk-thumbnav" id="videos_modal_container" >'+response.html_res+" </ul>";
                            $('#videos_main_container').html(html_res);
                        }

                        if(has_more == "1")
                        {
                            $('#videos_load_more').parent().show();
                        }else {
                            $('#videos_load_more').parent().hide();
                        }
                    }}
            });

        });

        $(document).on('input','#video_modal_name', function() {
            var current_view_videos=$('#current_view_videos').val();
            var video_modal_name=$('#video_modal_name').val();

            $("input[name=val_check_ski11]").removeAttr('checked');
            $("input[name=val_check_ski11]").prop('checked', false);
            $("input[name=val_check_ski11]").parent().removeClass("checked");

            $('#videos_main_container').html('<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="96" width="96" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"/></svg></div>');
            $('#videos_load_more').parent().hide();
            $.ajax({
                url: "{{ asset('dashboard/files_library/get_videos') }}",
                type: "POST",
                data: {
                    openPhotosModal:0,
                    current_view_videos:current_view_videos,
                    video_modal_name:video_modal_name,
                    _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        $("#all_video_category").html(response.category_html);
                        var has_more= response.has_more;
                        $('#current_view_videos').val(response.results_ids);
                        if(response.html_res =='')
                        {
                            $('#videos_main_container').html("<div class='not_found'><h3> عفواً: لا توجد نتائج</h3></div>");
                        }
                        else{
                            var html_res= '<ul class="uk-thumbnav" id="photos_modal_container" >'+response.html_res+" </ul>";
                            $('#videos_main_container').html(html_res);
                        }
                        if(has_more == "1")
                        {
                            $('#videos_load_more').parent().show();
                        }else {
                            $('#videos_load_more').parent().hide();
                        }


                    }}
            });
        });
        $(document).on('click','.filter_category', function() {
            var current_view_videos=$('#current_view_videos').val();
            var video_cat=$(this).attr('id');
            var cat_id=video_cat.split('_');

            $("input[name=val_check_ski11]").removeAttr('checked');
            $("input[name=val_check_ski11]").prop('checked', false);
            $("input[name=val_check_ski11]").parent().removeClass("checked");

            $('#videos_main_container').html('<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="96" width="96" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"/></svg></div>');
            $('#videos_load_more').parent().hide();
            $.ajax({
                url: "{{ asset('dashboard/files_library/get_videos') }}",
                type: "POST",
                data: {
                    openPhotosModal:0,
                    current_view_videos:current_view_videos,
                    video_cat:cat_id[1],
                    _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        $("#all_video_category").html(response.category_html);
                        var has_more= response.has_more;
                        $('#current_view_videos').val(response.results_ids);
                        if(response.html_res =='')
                        {
                            $('#videos_main_container').html("<div class='not_found'><h3> عفواً: لا توجد نتائج</h3></div>");
                        }
                        else{
                            var html_res= '<ul class="uk-thumbnav" id="photos_modal_container" >'+response.html_res+" </ul>";
                            $('#videos_main_container').html(html_res);
                        }
                        if(has_more == "1")
                        {
                            $('#videos_load_more').parent().show();
                        }else {
                            $('#videos_load_more').parent().hide();
                        }


                    }}
            });
        });
        $(document).on('click','#delet_video',function () {
            $("#put_video").html('')
            $("#video_id").val('');
            $('#main_youtube').val('');
            $('#main_facebook').val('');
            $("#delet_video").hide();
        })
        $(document).on('click','#upload_big_photo',function () {
            $('#upload_new_photo').removeClass("uk-active");
            $('#upload_from_archive').removeClass("uk-active");
            $('#upload_from_url').removeClass("uk-active");
            $('#upload_from_archive').removeClass("uk-active");
            $('#upload_from_video').removeClass("uk-active");
            $('#upload_big_photo').addClass("uk-active");
            $('#files_from_archive').hide();
            $('#add_you_tube_video').hide();
            $('#uploader_file_container').hide();
            /////////////////////////////////////
            $('#uploader_photo_container').addClass("uk-active");
            $('#uploader_archive').removeClass("uk-active");
            $('#uploader_link').removeClass("uk-active");
            $('#uploader_archive').removeClass("uk-active");
            $('#upload_video').removeClass("uk-active");
        $("#image_type").val('big')
        });
        $(document).on('click','#upload_new_photo',function () {
            $("#photoscontainer").html('')
            $('#upload_new_photo').addClass("uk-active");
            $('#upload_from_archive').removeClass("uk-active");
            $('#upload_from_url').removeClass("uk-active");
            $('#upload_from_archive').removeClass("uk-active");
            $('#upload_from_video').removeClass("uk-active");
            $('#upload_big_photo').removeClass("uk-active");
            $('#files_from_archive').hide();
            $('#uploader_file_container').hide();
            /////////////////////////////////////
            $('#uploader_photo_container').addClass("uk-active");
            $('#uploader_archive').removeClass("uk-active");
            $('#uploader_link').removeClass("uk-active");
            $('#uploader_archive').removeClass("uk-active");
            $('#upload_video').removeClass("uk-active");
            $("#image_type").val('small')
        })


        $(document).on('click','#insert_face_link',function()
        {
            var url = $('#editor_link_face').val();

            var video_title="";
            var tmp =url.split('/');
            var video_id=0;
            //dd($tmp);
            console.log("HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHh");
            if(tmp.length >=3){
                if (tmp[tmp.length - 3].toLowerCase()== 'videos') {
                    video_id = tmp[tmp.length - 2];
                }
            }else if(tmp.length >=2)
            {
                if(tmp[tmp.length - 2].toLowerCase()== 'videos')
                {
                    video_id = tmp[tmp.length - 1];
                }
            }
            else {
                video_id = 0;
            }
            tinyMCE.execCommand('mceInsertContent',false, url);
            UIkit.modal("#upload_video_face").hide();

            //this is Commant by moman albelbesi
            /*
            if(video_id != 0) {
                $('#editor_link_facebook').removeClass("input-danger");
                $('#editor_link_facebook').parent().parent().find(".parsley-errors-list").remove();
                var app_token="{{-- getAppToken() --}}";
                $.getJSON('https://graph.facebook.com/v2.8/'+video_id+'?fields=description,format,content_category,length&access_token='+app_token+'&format=json&callback=?',function(data){
                    video_title= JSON.stringify(data['description']);
                    var facebook_frame='<div class="article-video-box">'+
                        '<div class="embed-responsive embed-responsive-16by9">'+
                        '<iframe src="https://www.facebook.com/plugins/video.php?href='+url+'&width=560&show_text=false&appId={{ env("FACEBOOK_APP_ID") }}&height=315"'+
                        'width="560" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" '+
                        'allowTransparency="true" allowfullscreen="true"  autoplay="false" show-text="false" show-captions="false"></iframe>'+
                        '</div>'+
                        '<p>'+video_title+'</p>'+
                        '</div><br/>';
                    tinyMCE.execCommand('mceInsertContent',false, facebook_frame);
                    UIkit.modal("#upload_video_face").hide();
                });
            } else {
                $('#editor_link_face').addClass("input-danger");
                $('#editor_link_face').parent().parent().append('<div class="parsley-errors-list filled" id="parsley-id-4"><span class="parsley-required">يرجى ادخال رابط فيس بوك فيديو صحيح</span></div>');
            }*/
            //end if
        });

        $(document).on('click','.add_vote_image',function()
        {
            var answer_id=$(this).attr('id');
            var answer=answer_id.split('_');
            $("#get_type_photo").val('answer_photo_'+answer[3]);
            $('#add-main-img').click();
        });
        $(document).on('click','#mceu_70-shortcut',function()
        {
            var answer_id=$(this).attr('id');
            var answer=answer_id.split('_');
            $("#get_type_photo").val('answer_photo_'+answer[3]);
            $('#add-main-img').click();
        });

        $(document).on('click','#upload_you_tube',function()
        {
           $('#add_you_tube_video').show();
            $('#add_face_book_video').hide();

            $("#modalFrom").val('main_youtube');
        });

        $(document).on('click','#upload_face_bokk',function()
        {
            $('#add_you_tube_video').hide();
            $('#add_face_book_video').show();
            $("#modalFrom").val('main_facebook');
        });
        $(document).on('click','#upload_file_modal',function()
        {
            $('#files_from_archive').hide();
            $('#add_you_tube_video').hide();
            $('#uploader_file_container').show();
        });

        $(document).on('change','#files_main_upload',function()
        {

            var src=$("#files_main_upload").val();
            if(src!="") {
                for (var x = 0; x < this.files.length; x++){
                    var file = this.files[x];
                    var imgSize = this.files[x].size;
                    var imgName = this.files[x].name;

                    var currentDate = new Date();
                    var day = "{{ date('d') }}";
                    var month = "{{ date('m') }}";
                    var year = "{{ date('Y') }}";



                   // if (!!file.type.match(/image.*/) || !!file.type.match(/doc.*/) || !!file.type.match(/docs.*/) || !!file.type.match(/xls.*/) || !!file.type.match(/xlxs.*/) || !!file.type.match(/txt.*/) || !!file.type.match(/zip.*/)) {

                        if ((Math.round(imgSize)) <= (20 * 1024 * 1024)) {


                            $('#sidebar_photo_data').show();
                            imgSize = imgSize / 1024;
                            $('#photo_uploading_data').children('.upload_avatar').attr("src", "{{ asset('img/default.jpg') }}");
                            $('.uk-comment').children('.upload_name').text(imgName);
                            $('#photo_uploading_data').children('.image-left-det').children('.upload_date').text(day + "  " + convertMonthText(parseInt(month)) + " , " + year);
                            $('#photo_uploading_data').children('.image-left-det').children('.upload_size').text(Math.round(Math.round(imgSize * 100) / 100) + " KB ");
                            formdata = new FormData();
                            formdata.append('file', file);
                            formdata.append('file_id', x);
                            formdata.append('upload_from', $("#input_upload_from").val());

                            formdata.append('_token', "{{ csrf_token() }}");
                            $('#uploader_span_btn_file').html('<i class="uk-icon-spinner uk-icon-spin"></i> جاري الرفع');
                            $('#files_main_upload').attr('disabled', 'disabled');
                            $('#upload_file_error').remove();


                            $('input').attr('disabled', 'disabled');
                            $('button').attr('disabled', 'disabled');
                            var html_loading='<div class="col-sm-3"  id="imageTTT_'+x+'"  style="margin-top: 10px;">'+
                                '<div class="md-preloader md-preloader-success">'+
                                '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"/></svg>'+
                                '</div>'+
                                '</div>';

                            $('#filescontainer').append(html_loading);
                            $.ajax({
                                url: "{{ asset('dashboard/files_library/upload_files') }}",
                                type: "POST",
                                data: formdata,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    if (response.success) {
                                        ////////////////////////
                                        var image_id=response.image_id
                                        $("#imageTTT_"+image_id).remove();

                                        var html_loading_s='<div class="col-sm-3"  id="imageTTT_'+image_id+'"  style="margin-top: 10px;width: 130px;">'+
                                            '<img  class="img-responsive" style="height:100px" src="'+response.image_name+'" alt="choose" >'+
                                            '</div>';
                                        $('#filescontainer').append(html_loading_s);
                                        //////////////////////////////////////////
                                        $('#uploader_span_btn_file').html('اختر ملف للرفع');
                                        $('#files_main_upload').removeAttr('disabled');
                                        $('input').removeAttr('disabled');
                                        $('button').removeAttr('disabled');
                                        ///////////////////////////////////////////////
                                        var number_image=Number(image_id)+1
                                        if(number_image==x){
                                            setTimeout(function(){

                                                $('#upload_new_photo').removeClass("uk-active");
                                                $('#upload_from_archive').removeClass("uk-active");
                                                $('#upload_from_url').removeClass("uk-active");
                                                $('#upload_from_archive').removeClass("uk-active");
                                                $('#uploader_photo_container').removeClass("uk-active");
                                                $('#uploader_archive').removeClass("uk-active");
                                                $('#uploader_link').removeClass("uk-active");
                                                $('#files_from_archive').addClass("uk-active");
                                                $('#upload_big_photo').removeClass("uk-active");
                                                $('#upload_file_modal').removeClass("uk-active");
                                                $('#uploader_file_container').removeClass("uk-active");

                                                $('#chose_files_from_archive').addClass("uk-active");
$("#chose_files_from_archive").click();
                                                ///////////////////////////////////////////////
                                                $('#filescontainer').html('');
                                            }, 1500);
                                        }


                                        var photo_name = response.image_name;
                                        var photo_name_arr = photo_name;
                                        var photo_name_thumb = photo_name_arr;
                                        $("ul#archive_modal_container li").removeClass('img-active');


                                        $('#archive_main_container').prepend(response.html_res);
                                        $('#files_from_archive').show();
                                        $("#up_video_id").val(response.photo_id);
                                        $('#uploader_file_container').hide();

                                    }
                                },
                                error: function (response) {
                                    $('#uploader_span_btn_file').html('اختر ملف للرفع');
                                    $('#files_main_upload').removeAttr('disabled');
                                    $('#filescontainer').html('');
                                    $('#files_main_upload').addClass("input-danger");
                                    $('#file_upload-drop_file').append(
                                        '<div class="uk-push-1-10 uk-margin-top uk-width-8-10  " id="upload_photo_error" ><div class="uploader-alert uk-alert uk-alert-danger" data-uk-alert="">' +
                                        'يجب ان يكون الملف وورد او اكسل او pdf أو zip </div></div>');
                                }
                            });


                        } else {
                            $('#upload_photo_error').remove();
                            $('#file_upload-drop_file').append(
                                '<div class="uk-push-1-10 uk-margin-top uk-width-8-10  " id="upload_photo_error" ><div class="uploader-alert uk-alert uk-alert-danger" data-uk-alert="">' +
                                'يجب ان يكون ملف وورد او اكسل او pdf اوzip </div></div>');
                        }
                    // } else {
                    //     $('#upload_photo_error').remove();
                    //     $('#file_upload-drop_file').append(
                    //         '<div class="uk-push-1-10 uk-margin-top uk-width-8-10  " id="upload_photo_error" ><div class="uploader-alert uk-alert uk-alert-danger" data-uk-alert="">' +
                    //         'يرجى رفع ملف بامتداد صحيح </div></div>');
                    // }
                }

            }else {
                $('#upload_photo_error').remove();
                $('#file_upload-drop_file').append(
                    '<div class="uk-push-1-10 uk-margin-top uk-width-8-10  " id="upload_photo_error" ><div class="uploader-alert uk-alert uk-alert-danger" data-uk-alert="">'+
                    'يرجى رفع ملف </div></div>');


            }


        });
        $(document).on('click','#chose_files_from_archive',function()
        {

            $(".filter_type").removeClass("btn-info");
            $(".same-height-imgs").css("height", "316px");
            $('#files_from_archive').show();
            $("#modalFrom").val('archive');
            $("#uploader_file_container").hide();
            $.ajax({
                url: "{{ asset('dashboard/files_library/get_archive_files') }}",
                type: "POST",
                data: { openPhotosModal:0, _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        var has_more= response.has_more;
                        $('#current_view_archive').val(response.results_ids);

                        if(response.html_res =='')
                        {
                            $('#archive_main_container').html("<div class='not_found'><h3> عفواً: لا توجد نتائج</h3></div>");
                        }
                        else{
                            var html_res= '<ul class="uk-thumbnav" id="archive_modal_container" >'+response.html_res+" </ul>";
                            $('#archive_main_container').html(html_res);
                        }

                        if(has_more == "1")
                        {
                            $('#archive_load_more').parent().show();
                        }else {
                            $('#archive_load_more').parent().hide();
                        }
                    }}
            });

        });

        $(document).on('click','ul#archive_modal_container li', function(){

            var $this = $(this);
            if ($this.hasClass('img-active')) {
                $this.removeClass('img-active');

                $("ul#archive_modal_container li").removeClass('img-active');
            }else{
                $("ul#archive_modal_container li").removeClass('img-active');
                var idd=$this.attr('id');
                var id_split=idd.split('_');
                $this.addClass('img-active');
                $("#up_archive_id").val(id_split[2]);
            }


        });
        $(document).on('click','#archive_load_more',function(){
            $('#archive_load_more').html( ' تحميل المزيد <i class="uk-icon-spinner uk-icon-spin"></i> ');
            $('#archive_load_more').attr('disabled','disabled');
            var current_view_archive=$('#current_view_archive').val();
            var archive_modal_name=$('#archive_modal_name').val();


            $.ajax({
                url: "{{ asset('dashboard/files_library/get_archive_files') }}",
                type: "POST",
                data: { current_view_archive:current_view_archive,archive_modal_name:archive_modal_name, _token:"{{ csrf_token() }}" },
                success: function(response){
                    $('#archive_load_more').html( 'تحميل المزيد ');
                    $('#archive_load_more').removeAttr('disabled');
                    var has_more= response.has_more;
                    $('#current_view_archive').val(response.results_ids);
                    var html_res= '<ul class="uk-thumbnav" id="archive_modal_container" >'+response.html_res+" </ul>";
                    $('#archive_main_container').append(html_res);


                    if(has_more == "1")
                    {
                        $('#archive_load_more').parent().show();
                    }else {
                        $('#archive_load_more').parent().hide();
                    }
                    }
            });


        });

        $(document).on('input','#archive_modal_name', function() {


            var archive_modal_name=$('#archive_modal_name').val();


            $.ajax({
                url: "{{ asset('dashboard/files_library/get_archive_files') }}",
                type: "POST",
                data: { archive_modal_name:archive_modal_name, _token:"{{ csrf_token() }}" },
                success: function(response){
                    $('#archive_load_more').html( 'تحميل المزيد ');
                    $('#archive_load_more').removeAttr('disabled');
                    var has_more= response.has_more;
                    $('#current_view_archive').val(response.results_ids);
                    var html_res= '<ul class="uk-thumbnav" id="archive_modal_container" >'+response.html_res+" </ul>";
                    $('#archive_main_container').html(html_res);


                    if(has_more == "1")
                    {
                        $('#archive_load_more').parent().show();
                    }else {
                        $('#archive_load_more').parent().hide();
                    }
                }
            });
        });
        $(document).on('click','.remove_file',function(){

        var all_id=$(this).attr('id');
        var iid=all_id.split('_')
            $.ajax({
                url: "{{ asset('dashboard/files_library/delete_file') }}/"+iid[2],
                type: "DELETE",
                data: {  _token:"{{ csrf_token() }}" },
                success: function(response){
                    if(response.success)
                    {
                        $("#arc-file_"+iid[2]).remove();

                    }}
            });

        })
        $(document).on('click','#add_ifram_embed',function() {
            var url = $('#iframe_embed_text').val();


            $.ajax({
                url: "https://publish.twitter.com/oembed?url="+url,
                dataType: "jsonp",
                async: false,
                success: function(data){
                    var icon_url='https://www.iconsdb.com/icons/preview/royal-blue/twitter-xxl.png';
                    // $("#embedCode").val(data.html);
                    // $("#preview").html(data.html)
                    tinyMCE.activeEditor.insertContent(
                        '<div class="div_border" contenteditable="false">' +
                        '<img class="twitter-embed-image" src="'+icon_url+'" alt="image" />'
                        +data.html+
                        '</div>');

                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    alert(msg);
                },
            });
        });
        $(document).on('click','.vote_details',function() {
            UIkit.modal("#details").show();
            var idd=$(this).attr('id');
            $.ajax({
                url: "{{ asset('dashboard/votes/details') }}",
                type: "POST",
                data: {vote_id:idd,
                    _token:"{{ csrf_token() }}" },
                success: function(response) {
                    $("#result_votes").html(response.html)
                    $("#title_vote").html(response.vote.name)
                }
            });
        })

    </script>

@endpush