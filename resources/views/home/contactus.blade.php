@extends('home.main')
@section('content')
    <section class="section inner-page">
    <div class="container">
        <div class="section-header">
            <h3 class="section-title">اتصل بنا</h3>
        </div>
        <div class="content-innerPage contact_innerPage">
            <div class="contact_p_one">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contact_half_right">
                                <div class="contact_head">
                                    <h2 class="title-top">تواصل لاقتراحاتك</h2>
                                    <p>نسعد دائما بتواصلكم معنا</p>
                                </div>
                                <form class="mail-list-form form_contact" action="#" id="send_news">
                                    <div class="form-group">
                                        <label>الاسم</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>البريد الالكتروني</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>عنوان الرسالة</label>
                                        <input type="text" class="form-control" id="news_title" name="news_title">
                                    </div>
                                    <div class="form-group">
                                        <label>تفاصيل الرسالة</label>
                                        <textarea class="form-control" id="details" name="details" rows="6"></textarea>
                                    </div>
                                    <div id="alert"  class="alert alert-success " role="alert"  style="display: none;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="width: unset;background-color: unset; margin-top: -1%;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        تم ارسال الرسالة بنجاح. سيتم مراجعتها لاحقا
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
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="contact_img">
                                <div class="contact_p_two section-shadow">
                                    <div class="container">
                                        <div class="contact_head">
                                            <h2 class="title-top">أو تواصل عن طريق الارقام  </h2>
                                        </div>
                                        <div class="hotel-item col-xs-12 col-sm-6">

                                            <div class="hotel-details">
                                                <i class="fa fa-mobile"></i>
                                                <span>{{$setting->mobile}}</span>
                                            </div>

                                            <div class="hotel-details">
                                                <i class="fa fa-phone"></i>
                                                <span>{{$setting->phone}}</span>
                                            </div>
                                            <div class="hotel-details">
                                                <i class="fa fa-facebook"></i>
                                                <a target="_blank" href="{{$setting->facebook}}"><span>Facebook</span></a>
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


    </section>
@endsection
@push('scripts')

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
        $('#send_news').validate({

            rules: {
                name: "required",
                email: {required: true, email: true},
                news_title: "required",
                details: "required"

            },
            messages: {
                name: "هذا الحقل مطلوب",
                email: {required: "هذا الحقل مطلوب", email: "يرجى إدخال إيميل صحيح"},
                news_title: "هذا الحقل مطلوب",
                details: "هذا الحقل مطلوب",

            },
            submitHandler: function (form) {
                    $("#recaptcha").hide();
                    var dataString1 = new FormData();
                    dataString1.append('name', $('#name').val());
                    dataString1.append('email', $('#email').val());
                    dataString1.append('news_title', $('#news_title').val());
                    dataString1.append('details', $('#details').val());
                    dataString1.append('_token', '{{csrf_token()}}');

                    $("#loader").show();
                    $('input').attr('disabled', 'disabled');
                    $('select').attr('disabled', 'disabled');
                    $('button').attr('disabled', 'disabled');
                    $.ajax({
                        url: "{{ URL::to('home/contact_us')}}",
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
                            $('#email').val('');
                            $('#name').val('');
                            $('#details').val('');
                            $('#news_title').val('');

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
@endpush