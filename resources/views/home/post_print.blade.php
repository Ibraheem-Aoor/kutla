<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <title>رام الله - موقع رام الله الإخباري</title>
    <link rel="icon" href="{{asset('homeStyle')}}/images/favicon.png" type="image/png">
    <link href="{{asset('homeStyle')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('homeStyle')}}/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('homeStyle')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('homeStyle')}}/css/animate.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('homeStyle')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('homeStyle')}}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('homeStyle')}}/css/jquery.mCustomScrollbar.css">

    <link href="{{asset('homeStyle')}}/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{asset('homeStyle')}}/css/responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <style>
        .fancybox-slide>*{
            background-color:unset !important;
        }
        .error-block{
            color:red;
        }

    </style>
    <meta property="fb:pages" content="1413400918974999" />
    @stack('meta_tag')
</head>
@stack('data_erro')
<body style="background: #fefefe !important;">
<section class="urgent-news" id="breaking__news" >
    <div class="container" id="put_urgent">

    </div>
</section>
<header>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 hidden-xs hidden-sm">
                    <div class="top-header-item">
                        <i class="fa fa-sun-o"></i>
                        <span class="degree">27</span>
                        {{returnDateFormay(date('Y-m-d'))}}
                    </div>
                    <div class="top-header-item">
                        <i class="fa fa-clock-o"></i>
                        {{returnTimeFormay(date('H:i:s'))}} بتوقيت القدس المحتلة
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header">
        <div class="container">
            <a href="{{asset('/')}}" class="logo" ><img style="width: 96% !important" src="{{asset('homeStyle')}}/images/logo.png" /></a>

        </div>
    </div>
</header>
    <section class="section inner-page" id="post_print_div">
        <div class="news-single">
            <div class="container">

                <h1 class="inner-news-title">{{$post_details->title}}</h1>

            </div>
            <div class="inner-news-wrapper">

                <div class="container">
                    <div class="row inner-news-row">
                        <div class="col-xs-12 col-md-12">

                                            <div class="post-thumb-block">
                                                <img src="{{asset($post_details->photo->thump770)}}" alt="" class="img-responsive inner-news-img">
                                            </div>

                            <div class="inner-news-time">
                                <span><i class="fa fa-calendar-o"></i>{{returnDateFormay($post_details->published_at)}}</span>
                                <span><i class="fa fa-clock-o"></i> {{returnTimeFormay($post_details->published_at)}} بتوقيت القدس المحتلة </span>
                            </div>
                            <div class="row source-share">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    {{--<div class="source-item">--}}
                                    {{--<span class="source-title">مصدر الصورة</span>--}}
                                    {{--<span class="source-content">وكالة الأنباء الأمريكية</span>--}}
                                    {{--</div>--}}
                                    @if($post_details->source)
                                        <div class="source-item">
                                            <span class="source-title">مصدر الخبر</span>
                                            <span class="source-content">{{$post_details->source}}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="news-share text-left">

                                    </div>
                                </div>
                            </div>
                            <div class="inner-news-content" style="color: black; font-weight: 300;">

                                {!! $post_details->details !!}
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



<script type="text/javascript" src="{{asset('homeStyle')}}/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="{{asset('homeStyle')}}/js/script.js"></script>
<script type="text/javascript">
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'error-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    $('#add_to_mail').validate({

        rules: {
            email_list: {required: true, email: true},

        },
        messages: {

            email_list: {required: "هذا الحقل مطلوب", email: "يرجى إدخال إيميل صحيح"},


        },
        submitHandler: function (form) {

            var dataString1 = new FormData();
            dataString1.append('email', $('#email_list').val());
            dataString1.append('_token', '{{csrf_token()}}');

            $("#loader").show();
            $('input').attr('disabled', 'disabled');
            $('select').attr('disabled', 'disabled');
            $('button').attr('disabled', 'disabled');
            $.ajax({
                url: "{{ URL::to('home/add_to_mail')}}",
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
                    $('#email_list').val('');

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

</script>

</body>
</html>