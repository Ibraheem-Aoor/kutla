<style>
    @page {
        header: page-header;
        footer: page-footer;
    }
    .header {
        /*position: absolute;*/
        /*top: 50mm;*/
        /*left: 5mm;*/
        /*width: 20%;*/
    }
    body{
        font-family: sans-serif;
        font-size: 14px;
    }
    .arfont {
        font-family: 'naskharabic', sans-serif;
    }
    .enfont {
        font-family: sans-serif;
    }
    h1,h2,h3,h4,h5,h6,th,span,a {
        font-family: 'naskharabic', sans-serif;
    }
    .text-center {
        display: block;
        text-align: center;
    }
    hr {
        color: #b3b3b3;
        /*font-family: 'naskharabic', tahoma ,sans-serif;*/
    }
    #datatable, #datatable td, #datatable th {
        border-collapse: collapse;
        padding: 10px 8px;
        border: 1px solid #b3b3b3;
    }
    #datatable td {
        padding: 5px;
    }
    #page {
        height: 2000px !important;
        padding-top: 130px;
    }
    .bold_font {
        font-weight: 600;
        background-color: #eeeeee;
    }
    .imgMap {
        border: 2px solid #eee;
    }
    .red {
        color: red;
    }
    .green {
        color:green;
    }
    .blue {
        color: blue;
    }
    .grey {
        color: grey;
    }
    .page-border {
        border: 1px solid #aeaeae;
        border-radius: 10px;
        height: 100%;
    }
    #datatable td {
        text-align: center !important;
    }
    thead { display: table-header-group !important;}
    tfoot { display: table-row-group !important; }
    tr { page-break-inside: avoid !important; }
</style>

<?php $setting=\App\Models\Setting::findOrFail(1); ?>
<body style="direction: rtl">
<div id="app">

    <div id="page">
        <div class="page-border">
            <h3 class="arfont text-center">تقرير وكالة فلسطين الآن عن الفترة
                <br>
                <span style="font-family: tahoma">
                    <span>من: </span> {{ $array_data['date_from'] }}
                    <span>إلى: </span> {{ $array_data['date_to'] }}
                </span>
            </h3>
            <br >
            <h3>الإعلام الجديد</h3>
            <table id="datatable" style="width: 100%;" autosize="1" repeat_header="1">
                <thead>
                <tr>
                    <th>عدد معجبي الفيس بوك</th>
                    <th>عدد متابعي التوتير</th>
                    <th>عدد مشاهدات اليوتيوب</th>
                    <th>عدد مشتركي الواتس اب</th>
                    <th>عدد متابعي الانستجرام</th>
                </tr>
                </thead>
                <tbody >


                <tr>
                    <td>{{$site_data['facebook']}}</td>
                    <td>{{$site_data['twitter']}}</td>
                    <td>{{$site_data['youtube']}}</td>
                    <td>{{$site_data['whatsapp']}}</td>
                    <td>{{$site_data['instagram']}}</td>
                </tr>

                </tbody>
            </table>
            <br >
            <h3>الإحصائية الإجمالية بالأرقام</h3>
            <table id="datatable" style="width: 100%;" autosize="1" repeat_header="1">
                <thead>
                <tr>
                    <th>عدد المود المنجزة</th>
                    <th>عدد الزيارات</th>
                    <th>عدد الزوار</th>
                    <th>عدد الزوار الجدد</th>
                </tr>
                </thead>
                <tbody >


                    <tr>
                        <td>{{$site_data['post_done']}}</td>
                        <td>{{$site_data['all_post_read']}}</td>
                        <td>{{$site_data['all_visit_count']}}</td>
                        <td>{{$site_data['all_new_visit_count']}}</td>
                    </tr>

                </tbody>
            </table>
            <br/>
            <h3>الإحصائية التفصيلية لأقسام الموقع بالأرقام</h3>
            <table id="datatable" style="width: 100%;" autosize="1" repeat_header="1">
                <thead>
                <tr>
                    <th>الزوايا</th>
                    <th>عدد المواد</th>
                </tr>
                </thead>
                <tbody >

                @foreach($categories as $one)

                    <tr>
                        <td>{{$one['name'] or '-'}}</td>
                        <td>{{$one['post_count']}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <htmlpageheader name="page-header">
        <div class="header">
            <table style="width:100%;">
                <tr style="">

                    <td style="padding-top: 30px">
                        <a href="{{asset('/')}}" target="_blank" rel="noreferrer">
                            <img src="{{asset('img/logo-old.png')}}" style="display: block" alt="{{$setting->web_site_name}}"  border="0" ></a>
                    </td>

                    <td style="vertical-align:bottom; text-align:left; margin-bottom:8px; padding-bottom: 10px" dir="rtl">
                        <br/>
                        <a href="{{asset('/')}}" style="font-family: 'Ubuntu', Tahoma; color: #00AAB8; text-decoration: none" target="_blank" rel="noreferrer">{{$setting->web_site_name}}</a>
                    </td>
                </tr>
            </table>
            <hr>
            
        </div>
    </htmlpageheader>


    <htmlpagefooter name="page-footer">
        <div style="color: #b4b4b4; font-size: 12px; direction: ltr; text-align: center;">
            <hr>
            {{$setting->web_site_name}} {{ date('d-m-Y H:i') }}
            <p></p>
        </div>
    </htmlpagefooter>
</div>
</body>