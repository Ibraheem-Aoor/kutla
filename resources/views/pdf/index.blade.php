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
            <table id="datatable" style="width: 100%;" autosize="1" repeat_header="1">
                <thead>
                <tr>
                    @if(in_array('enom',$pdfData))
                    <th> رقم الموظف</th>
                    @endif

                    @if(in_array('name',$pdfData))
                    <th> الاسم</th>
                    @endif

                     @if(in_array('job',$pdfData))
                    <th>المهنة</th>
                        @endif


                        @if(in_array('day',$pdfData))
                            <th>اليوم</th>
                        @endif
                    {{--<th>الحالة</th>--}}
                        @if(in_array('date',$pdfData))
                    <th>التاريخ</th>
                        @endif

                        @if(in_array('time1',$pdfData))
                    <th>الدخول</th>
                        @endif

                        @if(in_array('time2',$pdfData))
                    <th>الخروج</th>
                        @endif

                        @if(in_array('status',$pdfData))
                    <th>الحالة</th>
                        @endif

                        @if(in_array('hno',$pdfData))
                    <th>عدد ساعات العمل</th>
                        @endif
                </tr>
                </thead>
                <tbody >

                @foreach($employees as $one)
                    <tr>
                        @if(in_array('enom',$pdfData))
                        <td>{{$one['date']['employee']['job_number'] or '-'}}</td>
                        @endif

                        @if(in_array('name',$pdfData))
                        <td>{{$one['name'] or '-'}}</td>
                        @endif

                            @if(in_array('job',$pdfData))
                        <td>{{$one['type'] or '-'}}</td>
                            @endif
                        {{--<td>--}}
                            {{--@if(isset($one['date']) &&$one['date']['employee']['status'] =='enable')--}}
                                {{--<span  class="label label-info" style="font-size: 15px; font-weight: bold">فعال </span>--}}
                            {{--@endif--}}
                            {{--@if(isset($one['date']) &&$one['date']['employee']['status'] =='disable')--}}
                                {{--<span  class="label label-info" style="font-size: 15px; font-weight: bold"> غير فعال</span>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                            @if(in_array('day',$pdfData))
                        <td>{{$one['date']['today'] or '-'}}</td>
                            @endif

                            @if(in_array('date',$pdfData))
                        <td>{{$one['date']['today'] or '-'}}</td>
                            @endif

                            @if(in_array('time1',$pdfData))
                        <td>{{$one['login'] or '-'}}</td>
                            @endif

                            @if(in_array('time2',$pdfData))
                        <td>{{$one['logout'] or '-'}}</td>
                            @endif

                            @if(in_array('status',$pdfData))
                        <td>
                            @if(isset($one['date']) && $one['date']['status'] =='attendance')
                                <span class="label-success" style="font-size: 15px; font-weight: bold">حضور </span>
                            @endif
                            @if(isset($one['date']) &&$one['date']['status'] =='absence')
                                <span  class="label label-danger" style="font-size: 15px; font-weight: bold">غياب </span>
                            @endif
                            @if(isset($one['date']) &&$one['date']['status'] =='weekend')
                                <span  class="label label-warning" style="font-size: 15px; font-weight: bold">عطلة نهاية الأسبوع </span>
                            @endif
                            @if(isset($one['date']) &&$one['date']['status'] =='official')
                                <span  class="label label-info" style="font-size: 15px; font-weight: bold">عطلة رسمية </span>
                            @endif
                        </td>
                            @endif

                            @if(in_array('hno',$pdfData))
                        <td>{{ $one['date']['period'] or '-'}}</td>
                            @endif

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
                    @if($is_logo== 'true')
                    <td style="padding-top: 30px">
                        <a href="{{$setting->system_url}}" target="_blank" rel="noreferrer">
                            <img src="{{$setting->logo}}" style="display: block" alt="{{$setting->system_name}}"  border="0" height="95" width="95"></a>
                    </td>
                    @endif
                    <td style="vertical-align:bottom; text-align:left; margin-bottom:8px; padding-bottom: 10px" dir="rtl">
                        <br/>
                        <a href="{{$setting->system_url}}" style="font-family: 'Ubuntu', Tahoma; color: #00AAB8; text-decoration: none" target="_blank" rel="noreferrer">{{$setting->system_name}}</a>
                    </td>
                </tr>
            </table>
            <hr>
        </div>
    </htmlpageheader>


    <htmlpagefooter name="page-footer">
        <div style="color: #b4b4b4; font-size: 12px; direction: ltr; text-align: center;">
            <hr>
            {{$setting->system_name}} {{ date('d-m-Y H:i') }}
            <p></p>
        </div>
    </htmlpagefooter>
</div>
</body>
