@php
    $setting = \App\Models\Setting::first();
    $linkes  =  \App\Link::orderBy('created_at','desc')->get();
    //$weather=yahoo_weather();
    $w_static = '11';


@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الكتلة الاسلامية </title>
    <link rel="stylesheet" href="{{asset('comming_soon/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('comming_soon/assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('comming_soon/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('comming_soon/assets/css/media.css')}}">
</head>
<style>
    .social-div {
        padding-top: 100px;
    }
    section h1 {
        font-size: 99px;
        margin-top: 100px;
    }
</style>
<body>




<section>
    <div class="container">
        <div class="row">
            <div class="col-12  col-md-5 col-lg-5">
                <div class="logo-div">
                    <img src="{{asset('comming_soon/assets/images/Group 7.png')}}" alt="">
                </div>
                <div>
                    <h1>قريبا</h1>
                    <p>"موقع الكتلة الإسلامية في جامعات الضفة"</p>
                    <p><i class="fas fa-clock"></i>20/02/2020 الساعة 02:00</p>
                </div>
                <div class=" row time">
                    <div class="col-3 text-center">
                        <div class="border-div color3">
                            <span class="timer-span" id="s">00</span>
                        </div>
                        <span class="unit">ثانية</span>
                    </div>
                    <div class="col-3 text-center">
                        <div class="border-div color1">
                            <span class="timer-span" id="m">00</span>
                        </div>
                        <span class="unit">دقيقة</span>
                    </div>
                    <div class="col-3 text-center">
                        <div class="border-div color2">
                            <span class="timer-span" id="h">00</span>
                        </div>
                        <span class="unit">ساعة</span>
                    </div>
                    <div class="col-3 text-center">
                        <div class="border-div color3">
                            <span class="timer-span" id="d">00</span>
                        </div>
                        <span class="unit">ايام</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7 col-1g-7">
                <div class="img-div">
                    <img src="{{asset('comming_soon/assets/images/iMac.png')}}" alt="">
                </div>
                <div class="social-div">
                        <span><a href="{{$setting->facebook}}">
                            <i class="fab fa-facebook-f"></i>wbkutla
                        </a></span>
                    <span><a href="{{$setting->twitter}}">
                            <i class="fab fa-twitter"></i>islamickutla
                        </a></span>
                    <span><a href="{{$setting->instagram}}">
                            <i class="fab fa-instagram"></i>islamickutla
                        </a></span>
                    <span><a href="{{$setting->soundcloud}}">
                            <i class="fab fa-soundcloud"></i>kutlawb
                        </a></span>
                </div>
            </div>
        </div>
    </div>
</section>




    <script src="{{asset('comming_soon/assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('comming_soon/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('comming_soon/assets/js/main.js')}}"></script>
    <script>

        // Set the date we're counting down to
        var countDownDate = new Date("Feb 20, 2020 14:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("s").innerHTML =  seconds ;
            document.getElementById("m").innerHTML =  minutes ;
            document.getElementById("h").innerHTML =  hours ;
            document.getElementById("d").innerHTML = days  ;

            // If the count down is finished, write some text

        }, 1000);
    </script>

</body>

</html>