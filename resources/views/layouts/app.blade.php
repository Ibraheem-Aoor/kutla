<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ app()->getLocale() }}" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة التحكم </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Fingerprint By Raspberry Holding" name="description" />
    <meta content="" name="author" />
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{asset('new_front_kotla/assets/images/logo.png')}}" type="image/x-icon" >
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/global/css/googleapis.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/global/css/components-rounded-rtl.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('assets/layouts/layout4/css/layout-rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/layouts/layout4/css/themes/default-rtl.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('assets/layouts/layout4/css/custom-rtl.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .loading { position: fixed; width: 100%; height: 100%; z-index: 20000; background: rgba(0, 0, 0, 0.25); top: 0; }
        .loading i { margin-top: 20%;font-size: 43px;color: #2a4f62 !important;margin-right: 50%; }
        .page-header.navbar .page-logo .logo-default { margin: 20px 0 0; width: 90%; }
        .table-component__table th { cursor: pointer; }
        .table-component__th--sort-asc:after { content: '↑'; }
        .table-component__th--sort-desc:after { content: '↓'; }
    </style>
    <!-- END THEME LAYOUT STYLES -->
    <link href="{{ asset('assets/global/css/jquerysctipttop.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')

    <style>

        {{--@import url({{ asset('assets/fonts/Bahij_TheSansArabic-Bold/stylesheet.css') }});--}}

        {{--@import  url('{{ asset('assets/fonts/droidarabicnaskh.css') }}');--}}
        {{--@import  url('{{ asset('assets/fonts/ubuntu_font.css') }}');--}}
        {{--@import  url('{{ asset('assets/fonts/ubuntu_font.css') }}');--}}
        {{--*{--}}
            {{--/*font-family: hl;*/--}}
            {{--/*font-weight: 500;*/--}}
            {{--/*font-size: 16px !important;*/--}}
            {{--/*font-family: 'Bahij TheSansArabic';*/--}}
            {{--font-family: 'Droid Arabic Naskh', 'ubuntu font' ,serif;--}}
        {{--}--}}
        [v-cloak] {
            display: none;
        }
        .progress-bar-danger{
            background-color: #7f7f85;
        }
        .table-component__message{
            text-align: center;
        }
    </style>
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<div id="app">

    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo" >
                <a href="{{ url('/') }}">
                    {{--<img style="width: 151px;    margin-top: 7px;" src="{{asset('front_kotli/assets/img/logo.png')}}"  style="/* width: 151px; */margin-top: 7px;height: 60px;width: 57px;" alt="logo" class="logo-default" /> </a>--}}
                <div class="menu-toggler sidebar-toggler">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <!-- DOC: Apply "dropdown-dark" class below "dropdown-extended" to change the dropdown styte -->
                        <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                        <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->

                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- END INBOX DROPDOWN -->

                        <!-- BEGIN NOTIFICATION DROPDOWN -->

                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile">  {{ auth()->user()->name }} </span>
                                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                <img alt="" class="img-circle" src="{{ auth()->user()->image }}">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i> تسجيل الخروج
                                    </a>
                                    <a href="{{asset('dashboard/users/'.auth()->user()->id.'/edit')}}" >
                                        <i class="fa fa-edit"></i>تعديل بياناتي
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </ul>

                        </li>

                        <!-- END USER LOGIN DROPDOWN -->

                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- END SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    @include('layouts.partials.menu')
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" v-cloak>


                @if(meta('breadcrumb'))
                    <div class="page-head">
                        {!! meta('breadcrumb') !!}
                    </div>
                @endif

                @yield('content')
                <input type="hidden" id="event_remmber_id">
                <div class="modal" id="edit_remember" tabindex="-1" role="basic" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style=" width: 514px;right: 23%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" >التذكير لاحقا </h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>التذكير بعد</label>:
                                </div>
                                <div class="row">

                                    <div class="col-md-5">
                                        <label>ساعة</label>: <input type="number" min="0" class="form-control" id="hour_remm" name="hour_remm"> </div>
                                    <div class="col-md-5">
                                        <label>دقيقة</label>:  <input type="number" min="0" class="form-control" id="min_remm" name="min_remm"> </div>
                                </div>


                            </div>

                            <div class="modal-footer">
                                <button  class="btn green" id="save_remmber" >
                                <span >
                                    <i class="fa fa-btn fa-spinner fa-spin" id="show_load" style="display: none"></i>
                                </span> حفظ
                                </button>
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal" >الغاء الأمر</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                    <div id="add_urgent_news_modal"  class="modal fade" tabindex="-1" data-backdrop="add_urgent_news_modal" data-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">اضافة خبر عاجل</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="mail-list-form form_contact" action="#" id="add_urgent_news">
                                        <div class="form-group">
                                            <label>نص الخبر</label>
                                            <input type="text" class="form-control" id="title_urgent" name="title_urgent">
                                        </div>
                                        <div class="form-group">
                                            <label>رابط الخبر</label>
                                            <input type="text" class="form-control" id="url_urgent" name="url_urgent">
                                        </div>
                                        <div class="form-group">
                                            <label>مدة الظهور</label>
                                            <input type="number" min="1" class="form-control" id="duration_urgent" name="duration_urgent">
                                        </div>
                                        <div id="alert"  class="alert alert-success " role="alert"  style="display: none;">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="width: unset;background-color: unset; margin-top: -1%;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                           تم إضافة الخبر بنجاح
                                        </div>
                                        <div id="faild_send"  class="alert alert-danger " role="alert" style="display: none; ">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style=" width: unset;background-color: unset; margin-top: -1%;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            حدثت مشكلة ما في الإرسال الرجاء إرسال الخبر مرة أخرى لاحقا!
                                        </div>
                                        <div class="g-recaptcha" data-sitekey="6LcJSV8UAAAAAEIRjsE8TOYhy-XqEEeRHslWrBJG"></div>
                                        <span for="name" generated="true" id="recaptcha" style="display: none" class="error-block">هذا الحقل مطلوب</span>
                                        <br />

                                        <button type="submit" class="btn btn_contact">ارسال<i style="display: none;"  id="loader" class="fa fa-spinner fa-spin"></i> </button>
                                        <button type="button" id="close_urgent"  class="btn dark btn-outline">الغاء</button>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">

    </div>
    <!-- END FOOTER -->
    <div id="loading-div" class="loading" style="display: block;">

        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>

        <span class="sr-only">Loading...</span>
    </div>
</div>

<script>
    let USER = JSON.parse('{!!json_encode( [
        'id' => auth()->id(),
        'name' => auth()->user()->name
        ]) !!}');
    let REHSUP = '{{ env('PUSHER_APP_KEY') }}';
    let BASE_URL = '{{ url('/') }}';
</script>
<!--[if lt IE 9]>
<script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<link href="{{asset('assets/tags/easyNotify.js')}}" rel="stylesheet" type="text/css">

<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->

<script src="{{ asset('assets/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/layouts/layout4/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    let app_token="{{ getAppToken() }}";
    let face_app="{{ env('FACEBOOK_APP_ID') }}";
</script>
@stack('scripts')

<script src="{{ url('js/app.js?aaa=www') }}"></script>


{{-- custom scripts--}}
<script>
    $(document).ready(function(){
        $('#loading-div').hide();

       // setInterval(executeQuery, 10000);
    });
    var myFunction = function() {
        alert('Click function');
    };
    var myImg = "{{ auth()->user()->image }}";

    function executeQuery() {
        $.ajax({
            url: "{{ asset('dashboard/events/check_event') }}",
            success: function (data) {
                var all_events=data.events
                for (i = 0; i < all_events.length; i++) {
                    console.log(Date.now())
                    console.log(all_events[i].users_events_auth[0].remind_later)
                    if(all_events[i].users_events_auth[0]){
                        var xx=0;
                        swal({
                                title: all_events[i].name,
                                text: all_events[i].details,
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-success",
                                cancelButtonText: "تذكير لاحقا",
                                confirmButtonText: "موافق",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    $.ajax({
                                        url: "{{ asset('dashboard/events/saw_event') }}",
                                        type: "POST",
                                        data: {
                                            event_id: all_events[xx].id,
                                            _token: "{{ csrf_token() }}"
                                        },
                                        success: function (response) {
                                            swal({
                                                title:'تم اغلاق التذكير' ,
                                                text: "",
                                                type: "success",
                                                timer: 3000,
                                                showConfirmButton: false
                                            });
                                        }
                                    })
                                } else {
                                    swal.close()
                                    $("#event_remmber_id").val(all_events[xx].id)
                                    $('#edit_remember').modal('show');

                                }
                            });
                        //   $("#easyNotify").easyNotify(options);
                    }
                }

            }
        });

    }
    $(document).on('click','#save_remmber',function () {
        $("#show_load").show();
        var event_id=$("#event_remmber_id").val();
        var min_remm=$("#min_remm").val();
        var hour_remm=$("#hour_remm").val();

        $.ajax({
            url: "{{ asset('dashboard/events/remind_later') }}",
            type: "POST",
            data: {
                event_id: event_id,min_remm: min_remm,hour_remm: hour_remm,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                $('#edit_remember').modal('hide');
                $("#show_load").hide();
                swal({
                    title:'سيتم تذكيرك لاحقا حسب الوقت المحدد' ,
                    text: "",
                    type: "success",
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        })
    })

</script>

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
@stack('albom_script')
<script type="text/javascript" src="{{asset('homeStyle/js/jquery.validate.min.js')}}"></script>

<script>
    $('#add_urgent_news').validate({

        rules: {
            title_urgent: "required",
            duration_urgent: "required"

        },
        messages: {
            title_urgent: "هذا الحقل مطلوب",
            duration_urgent: "هذا الحقل مطلوب",

        },
        submitHandler: function (form) {
            $("#recaptcha").hide();
            var dataString1 = new FormData();
            dataString1.append('title', $('#title_urgent').val());
            dataString1.append('url', $('#url_urgent').val());
            dataString1.append('duration', $('#duration_urgent').val());
            dataString1.append('_token', '{{csrf_token()}}');

            $("#loader").show();
            $('input').attr('disabled', 'disabled');
            $('select').attr('disabled', 'disabled');
            $('button').attr('disabled', 'disabled');
            $.ajax({
                url: "{{ URL::to('dashboard/urgents')}}",
                type: 'POST',
                dataType: 'json',
                data: dataString1,
                async: false,
                cache: false,

                success: function (response) {

                    $("#loader").hide();
                    $("#alert").show();
                    $('#alert').fadeOut(10000);
                    $('input').removeAttr('disabled');
                    $('select').removeAttr('disabled');
                    $('button').removeAttr('disabled');
                    $('#title_urgent').val('');
                    $('#url_urgent').val('');
                    $('#duration_urgent').val('');
                    setTimeout(() => {
                        $('#add_urgent_news_modal').modal('toggle');
                    }, 1500)

                },
                error: function (response) {
                    $('input').removeAttr('disabled');
                    $('select').removeAttr('disabled');
                    $('button').removeAttr('disabled');
                    $("#loader").hide();
                    $("#faild_send").show();
                    $('#faild_send').fadeOut(10000);

                },
                contentType: false,
                processData: false,
            });

        }
    });
    $(document).on("click","#close_urgent",function () {
        $('#add_urgent_news_modal').modal('toggle');
    })

</script>
</body>

</html>