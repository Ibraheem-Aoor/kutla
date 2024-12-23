<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <?php
    $sett=\App\Models\Setting::find(1);
    ?>
    <title>{{$sett->web_site_name}}</title>

    <!-- Stylesheets -->
    <link href="{{asset('homeStyle')}}/css/bootstrap.css" rel="stylesheet">
    <link href="{{asset('homeStyle')}}/css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="{{asset('homeStyle')}}/css/font-awesome.css" rel="stylesheet">
      <link href="{{asset('homeStyle')}}/css/style.css" rel="stylesheet">
    <!-- Responsive -->

</head>
<body>
<div style="background:#ECECEC; width: 100%; height: 100%; margin: 0px" bgcolor="#ECECEC" dir="rtl">



    <table style="font-family:'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'" align="center" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8f8f8" bgcolor="#ECECEC">
        <tbody><tr>
            <td height="50">&nbsp;</td>
        </tr>
        <tr>
            <td height="60" valign="top">
                <table cellspacing="0" align="center" width="460" cellpadding="0">
                    <tbody>
                    <tr>
                        <td valign="middle" width="40" height="60" style="text-align: center; font-size: 30px;">
                            <a href="" target="_blank" style="color: #cd4c78; text-decoration: blink;">
                                <img src="{{ url('img/logo.png') }}" width="200"/>
                                <br/><span style="font-size: 12px; ">{{$sett->web_site_name}} </span>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td height="20">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">
                <table style="font-family:'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif';border:1px solid #eaeff2;border-radius:3px" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
                    <tbody><tr>
                        <td>
                            <table style="font-family:'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif';padding:0" cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
                                <tbody><tr>
                                    <td valign="top" colspan="2" height="30">&nbsp;</td>
                                </tr>
                                <tr>

                                        <div class="box-content-news-xs">

                                            @foreach($posts as $post)
                                           <?php $photo=\App\Models\FileLibrary::find($post['photo_id']);?>
                                                <div class="news-xs news-xs-st3 bg-effect box--shadow wow fadeInUp animated" data-wow-duration="0.500s" data-wow-delay="0.15s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.15s; animation-name: fadeInUp;">
                                                   @if($photo) <a href="{{ url('post/'.$post['id'].'/'.(implode('-',explode(' ',$post['title'])))) }}" class="news-xs-thumb" title="{{$post['title']}}">
                                                        <img src="{{asset($photo['thump'])}}" title="{{$post['title']}}" alt="{{$post['title']}}" class="img-responsive">
                                                    </a>@endif
                                                    <div class="news-xs-txt">
                                                        <div class="n-time"><i class="zmdi zmdi-time zmdi-hc-fw"></i>{{returnDateFormay($post['published_at'])}}</div>
                                                        <h3 class="n-title fo-li-25"><a href="{{ url('post/'.$post['id'].'/'.(implode('-',explode(' ',$post['title'])))) }}">{{$post['title']}}</a></h3>
                                                        <p>{{$post['summary']}}</p>
                                                    </div>
                                                </div>


                                            @endforeach

                                        </div>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td height="50">&nbsp;</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>