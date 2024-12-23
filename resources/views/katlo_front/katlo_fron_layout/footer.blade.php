<footer>
    <div class="container">
        <div class="footer-box">
            <div class="footer-box-logo">
                <a href="#">
                    <img src="{{asset('front_kotli/assets/img/i/all.png')}}" class="img-fluid" alt="footer-logo">
                </a>
            </div>
            <div class="footer-box-social-media">

                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{$setting->facebook}}" target="_blank" class="nav-link">
                            <img src="{{asset('front_kotli/assets/img/facebook.png')}}" alt="facebook">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{$setting->twitter}}" target="_blank" class="nav-link">
                            <img src="{{asset('front_kotli/assets/img/twitter.png')}}" alt="twitter">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{$setting->instagram}}" target="_blank" class="nav-link">
                            <img src="{{asset('front_kotli/assets/img/instagram.png')}}" alt="instagram">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{$setting->youtube}}" target="_blank" class="nav-link">
                            <img src="{{asset('front_kotli/assets/img/youtube.png')}}" alt="youtube">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{$setting->soundcloud}}" target="_blank" class="nav-link">
                            <img style="
    width: 45px;
    height: 45px;"  src="{{asset('img/soundcloud.png')}}" alt="soundcloud">
                        </a>
                    </li>
                </ul>
                <form class="mail-list-form form_contact" method="post" id="add_to_mail">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control placeholder-size" id="email_list" name="email_list"
                               placeholder="اشترك بالقائمة البريدية" aria-label=""
                               aria-describedby="basic-addon1">

                        <div class="input-group-prepend">
                            <button class="btn btn-primary" type="submit"><i
                                        class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</footer>

