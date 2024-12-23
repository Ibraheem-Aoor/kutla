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
            <h3 class="arfont text-center">تقرير أداء موظفو وكالة فلسطين الآن عن الفترة
                <br>
                <span style="font-family: tahoma">
                    <span>من: </span> {{ $array_data['date_from'] }}
                    <span>إلى: </span> {{ $array_data['date_to'] }}
                </span>
            </h3>
            <br />
            <table id="datatable" style="width: 100%;" autosize="1" repeat_header="1">
                <thead>
                <tr>
                    <th rowspan="2">المحرر</th>
                    <th colspan="5">الأخبار</th>
                    <th rowspan="2">صور</th>
                    <th rowspan="2">فيديو</th>
                    <th rowspan="2">قراءات</th>
                    <th rowspan="2">اجمالي</th>
                </tr>
                <thead>
                <tr>
                    <th>منقول</th>
                    <th>خاص</th>
                    <th>تقرير</th>
                    <th>مقابلة</th>
                    <th>تجميعي</th>
                </tr>
                </thead>
                <tbody >

                @foreach($users as $one)
                <tr>
                        <td>{{$one['name'] or '-'}}</td>
                        <td>{{$one['transported']}}</td>
                        <td>{{$one['special_report']}}</td>
                        <td>{{$one['synthesis_report']}}</td>
                        <td>{{$one['special_interview']}}</td>
                        <td>{{$one['special_news']}}</td>
                        <td>{{$one['photo']}}</td>
                        <td>{{$one['video']}}</td>
                        <td>{{$one['read']}}</td>
                        <td>{{$one['all_add']}}</td>

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
                          <img src="{{asset('img/logo-old.png')}}" style="display: block" alt="{{$setting->name}}"  border="0" ></a>
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