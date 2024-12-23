<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>لوحة تحكم - الكتلة الاسلامية</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Fingerprint By Raspberry Holding" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link rel="shortcut icon" href="{{asset('new_front_kotla/assets/images/logo.png')}}" type="image/x-icon" >

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/global/css/components-rtl.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/pages/css/login-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Cairo:300,400,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <style>
        .loading { position: fixed; width: 100%; height: 100%; z-index: 100; background: rgba(0, 0, 0, 0.24); top: 0; }
        .loading i { display: block !important; margin: 22% auto; font-size: 100px; color:#36c6d3; }
        [v-cloak] { display: none; }
        *:not(.fa):not(.fab):not(.la):not(.select2-selection__arrow):not(.close):not(.phpdebugbar-fa){
            font-family: 'Cairo', sans-serif !important;

        }
    </style>
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="{{ url('/') }}">
        <img src="{{asset('new_front_kotla/assets/images/logo.png')}}"  style="width: 200px;" alt="logo">
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content" id="login-form" v-cloak>
    <!-- BEGIN LOGIN FORM -->
    <auth-login inline-template>
        <div>
            <h3 class="form-title font-green">تسجيل الدخول</h3>
            <div class="alert alert-danger" v-if="form.message">
                <span> @{{ form.message }} </span>
            </div>
            <div class="form-body">
                <div class="form-group" :class="{ 'has-error': form.error && form.validations.email }">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">البريد الالكتروني</label>
                    <input class="form-control" type="email" placeholder="البريد الالكتروني" v-model="email" dir="ltr" />
                    <span class="help-block" v-if="form.error && form.validations.email">
                        <strong>@{{ form.validations.email[0] }}</strong>
                    </span>
                </div>
                <div class="form-group" :class="{ 'has-error': form.error && form.validations.password }">
                    <label class="control-label visible-ie8 visible-ie9">كلمة المرور</label>
                    <input class="form-control" type="password" autocomplete="off" @keyup.enter="login" placeholder="كلمة المرور" v-model="password" dir="ltr" />
                    <span class="help-block" v-if="form.error && form.validations.password">
                        <strong>@{{ form.validations.password[0] }}</strong>
                    </span>
                </div>
                <div class="form-actions">
                    <button @click="login" type="submit" class="btn green uppercase" :disabled="form.disabled">
                        <span v-if="form.disabled">
                            <i class="fa fa-btn fa-spinner fa-spin"></i>
                        </span> تسجيل الدخول
                    </button>
                    <label class="rememberme check mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" v-model="remember" value="1" />تذكرني
                        <span></span>
                    </label>
                </div>
            </div>

        </div>
    </auth-login>
    <!-- END LOGIN FORM -->
</div>
<div id="loading-div" class="loading" style="display: block;">
    <i style="color: #fff;" class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <span class="sr-only">Loading...</span>
</div>
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
<script>
    let BASE_URL = '{{ url('/') }}';
</script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
<script src="{{ asset('js/auth.js') }}"></script>

<script>
    $(document).ready(function(){
        document.getElementById('loading-div').style.display = 'none';
    });
</script>

</body>

</html>