<?php
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

function meta($key, $value = null)
{
    if ($value) {
        \App\Classes\Meta::set($key, $value);
    }

    return \App\Classes\Meta::get($key);
}

function app_title($title = null)
{
    $orginal = 'فلسطين الآن';
    if (!$title || !strlen($title)) {
        return $orginal;
    }
    return $title . ' | ' . $orginal;
}

function breadcrumbs()
{
    return new \App\Classes\Breadcrumbs;
}

function breadcrumb(array $data)
{
    $home = "<li>" .
        "<i class=\"icon-home\"></i> " .
        "<a href=\"" . route('home') . "\"> الصفحة الرئيسية </a>" .
        (count($data) ? " <i class=\"fa fa-angle-left\"></i> " : "") .
        "</li>";

    if (!count($data)) {
        return $home;
    }

    foreach ($data as $d) {
        if (is_array($d)) {
            $home .= "<li>" .
                "<a href=\"" . route(key($d)) . "\">" . $d[key($d)] . "</a>" .
                " <i class=\"fa fa-angle-left\"></i> " .
                "</li>";
        } else {
            $home .= "<li><span>" . $d . "</span></li>";
        }
    }
    return $home;
}

function generateDateRange(Carbon $start_date, Carbon $end_date)
{
    $dates = [];

    for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
        $dates[] = $date->format('Y-m-d');
    }

    return $dates;
}

function convertImageToBase64($path)
{

    $type = pathinfo($path, PATHINFO_EXTENSION);
    if (file_exists($path)) {
        $data = file_get_contents($path);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    } else {
        return null;
    }
}

function full_file_url_path($files)
{
    $files_urls = [];

    if (is_object($files) || is_array($files)) // more one files
    {
        foreach ($files as $key => $file) {
            $files_urls[] = url($file);
        }
    } else // single file string
    {
        $files_urls = url($files);
    }

    return $files_urls;
}

function num_2_str($number, $lang)
{
    $f = new \NumberFormatter($lang, \NumberFormatter::SPELLOUT);
    $f->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose");
    return $f->format($number);
}

function saveBase64Image($image, $direction, $width = null, $hight = null, $image_type = null, $water_mark = false)
{
    $image_data = getimagesize($image);
    $image_width = $image_data[0];
    $image_height = $image_data[1];

    $img_manager = new ImageManager(new Driver());
    $img = $img_manager->read($image);
    $mime = explode('/', $img->exif()->first()['MimeType'])[1];

    // check direction
    $dir = 'uploads/' . $direction;
    //mkdir(my_public(). $dir);
    File::exists(my_public() . 'uploads/' . $direction . '/') or File::makeDirectory(my_public() . 'uploads/' . $direction, 0755, true);
    File::exists(my_public() . '/' . $dir) or File::makeDirectory(my_public() . $dir, 0755, true);

    // check thump direction
    File::exists(my_public() . 'uploads/' . $direction . '/') or File::makeDirectory(my_public() . 'uploads/' . $direction . '/thump', 0755, true);
    File::exists(my_public() . '/' . $dir . '/thump/') or File::makeDirectory(my_public() . $dir . '/thump/', 0755, true);
    File::exists(my_public() . '/' . $dir . '/thump_770/') or File::makeDirectory(my_public() . $dir . '/thump_770/', 0755, true);
    File::exists(my_public() . '/' . $dir . '/thump_370/') or File::makeDirectory(my_public() . $dir . '/thump_370/', 0755, true);
    File::exists(my_public() . '/' . $dir . '/thump_120/') or File::makeDirectory(my_public() . $dir . '/thump_120/', 0755, true);

    // save Image
    $file_name = rand(10000, 99999) . '.' . $mime;
    $img->save(my_public() . $dir . '/' . $file_name);
    if ($water_mark) {
        //$watermark = Image::make(my_public().'/homeStyle/images/footer-logo.png')->opacity(50);
        $watermark = $img_manager->read(my_public() . '/front_kotli/assets/img/logo.png');
        $img->place(element: $watermark, position: 'center', opacity: 50);
    }

    $image_big = my_public() . $dir . '/' . $file_name;
    if ($image_type == 'small') {
        compress_image($image_big, $image_big, 85);
    }
    // save_thump
    if ($width) {

        // $thump_image = $img->resize($width, $hight);
        $img->save(my_public() . $dir . '/' . $file_name);
        $thump_image = $img->resize(370, 230);
        $img->save(my_public() . $dir . '/thump_370/' . $file_name);
        $image_big = my_public() . $dir . '/' . $file_name;
        $image_thumb = my_public() . $dir . '/thump_370/' . $file_name;
        compress_image($image_big, $image_big, 85);
        compress_image($image_thumb, $image_thumb, 85);

    } else {
        if ($image_width < 770 || $image_height < 480) {
            //$watermark = Image::make(my_public().'/img/31993.png');
            //$watermark->insert($img, 'center');
            $img->save(my_public() . $dir . '/thump_770/' . $file_name);

        } else {
            $img->resize(770, 480);
            $img->save(my_public() . $dir . '/thump_770/' . $file_name);

        }

        $thump_image2 = $img->resize(370, 230);
        $img->save(my_public() . $dir . '/thump_370/' . $file_name);
        $thump_image3 = $img->resize(170, 155);
        $img->save(my_public() . $dir . '/thump_120/' . $file_name);

        $image_image1 = my_public() . $dir . '/thump_770/' . $file_name;
        $image_image2 = my_public() . $dir . '/thump_370/' . $file_name;
        $image_image3 = my_public() . $dir . '/thump_120/' . $file_name;
        compress_image($image_image1, $image_image1, 85);
        compress_image($image_image2, $image_image2, 85);
        compress_image($image_image3, $image_image3, 85);
    }

    return $dir . '/' . $file_name;
}

function saveFile($file, $direction)
{
    $mime = $file->getClientOriginalExtension();
    $dir = 'uploads/' . $direction . '/' . date('Y') . '/' . date('m');
    File::exists(my_public() . 'uploads/' . $direction . '/') or File::makeDirectory(my_public() . 'uploads/' . $direction, 0755, true);
    File::exists(my_public() . '/' . $dir) or File::makeDirectory(my_public() . $dir, 0755, true);
    $file_name = rand(10000, 99999) . '.' . $mime;
    $file->move(my_public() . $dir, $file_name);
    return $dir . '/' . $file_name;
}

function my_public()
{

    if (env('APP_ENV') == 'local') {
        return public_path() . '/';
    } else {
        return '/home/alkutla/public_html/';
        //  return '/home2/kutlannu/public_html/';
    }


}

function shift_time_format($time)
{
    try {
        $time = Carbon::parse($time);
        return [
            'hh' => $time->format('h'),
            'mm' => $time->format('i'),
            'A' => $time->format('A')
        ];
    } catch (Exception $e) {
        return [
            'hh' => '',
            'mm' => '',
            'A' => ''
        ];
    }
}


function array_to_sql_values($array)
{
    $resultStrings = [];
    foreach ($array as $key => $values) {
        $values = array_map(function ($a) {
            return "'{$a}'";
        }, $values);
        $subArrayString = "(" . implode(",", $values) . ")";
        $resultStrings[] = $subArrayString;
    }

    return implode(",", $resultStrings);
}

function returnDateFormay($date, $time = null)
{

    $array_date = Carbon::parse($date)->format('Y-m-d-D H:i');
    $array_date_new = explode('-', $array_date);
    $array_day_name = explode(' ', $array_date_new[3]);

    switch ($array_day_name[0]) {
        case "Sat":
            $day = 'السبت';
            break;
        case "Sun":
            $day = 'الأحد';
            break;
        case "Mon":
            $day = 'الإثنين';
            break;
        case "Tue":
            $day = 'الثلاثاء';
            break;
        case "Wed":
            $day = 'الأربعاء';
            break;
        case "Thu":
            $day = 'الخميس';
            break;
        case "Fri":
            $day = 'الجمعة';
            break;
    }

    switch ($array_date_new[1]) {
        case "1":
            $month = 'يناير';
            break;
        case "2":
            $month = 'فبراير';
            break;
        case "3":
            $month = 'مارس';
            break;
        case "4":
            $month = 'إبريل';
            break;
        case 5:
            $month = 'مايو';
            break;
        case 6:
            $month = 'يونيو';
            break;
        case 7:
            $month = 'يوليو';
            break;
        case 8:
            $month = 'أغسطس';
            break;
        case 9:
            $month = 'سبتمبر';
            break;
        case 10:
            $month = 'أكتوبر';
            break;
        case 11:
            $month = 'نوفمبر';
            break;
        case 12:
            $month = 'ديسمبر';
            break;
    }

    if ($time) {
        $time_array = explode(':', $array_day_name[1]);
        if ($time_array[1] > 12) {
            $houres = $time_array[0] - 12;
            $pm = 'م';
        } else {
            $houres = $time_array[0];
            $pm = 'ص';
        }

        return $day . ' ' . $array_date_new[2] . ' ' . $month . ' ' . $array_date_new[0] . ' ' . $houres . ':' . $time_array[1] . $pm;
    } else {
        return $day . ' ' . $array_date_new[2] . ' ' . $month . ' ' . $array_date_new[0];
    }

}

function returnTimeFormay($date)
{

    $array_date = Carbon::parse($date)->format('Y-m-d-D H:i');
    $array_date_new = explode('-', $array_date);
    $array_day_name = explode(' ', $array_date_new[3]);



    $time_array = explode(':', $array_day_name[1]);
    if ($time_array[0] > 12) {
        $houres = ((int) $time_array[0]) - 12;
        $pm = 'م';
    } else {
        $houres = $time_array[0];
        $pm = 'ص';
    }

    return $houres . ':' . $time_array[1] . ' ' . $pm;


}
function getAppToken()
{
    return env('FACEBOOK_APP_ID') . '|' . env('FACEBOOK_APP_SECRET');
}

function compress_image($source_url, $destination_url, $quality)
{
    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);

    //save file
    imagejpeg($image, $destination_url, $quality);

    //return destination file
    return $destination_url;
}

function getUserIP()
{
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}
function yahoo_weather()
{
    $getDataToday = \App\Models\Weather::whereDate('created_at', '=', date('Y-m-d'))->first();
    if (is_null($getDataToday)) {
        $rate = file_get_contents('http://api.weatherstack.com/current?access_key=523f670489e3274879cd19ca77d8c3fe&query=Jerusalem');
        $phpObj = json_decode($rate);
        if (isset($phpObj->current)) {
            $data = \Carbon\Carbon::today();
            $high = $phpObj->current->temperature;
            $getDataToday = \App\Models\Weather::create([
                'weather_date' => $data,
                'high' => $high
            ]);
        }
    }
    return $getDataToday;
}


function extchnge_rate()
{
    $rate = file_get_contents('http://apilayer.net/api/live?access_key=0d19d680df92296d404c7263375d322d&currencies=EUR,EGP,JOD,ILS&source=&format=1');
    $phpObj = json_decode($rate);
    return $phpObj;

}
function check_rate()
{
    $ExchangeRate = \App\Models\ExchangeRate::where('today', date('Y-m-d'))->first();

    if (!$ExchangeRate) {
        $api_result = extchnge_rate();
        if ($api_result->quotes) {
            $USD_ILS = number_format($api_result->quotes->USDILS, 2);
            $JOD_ILS = number_format($api_result->quotes->USDJOD, 2);
            $ILS_EGP = number_format($api_result->quotes->USDEGP, 2);
            $EUR_ILS = number_format($api_result->quotes->USDEUR, 2);

        }


        $ExchangeRate = new \App\Models\ExchangeRate();
        $ExchangeRate->today = date('Y-m-d');
        $ExchangeRate->usd = $USD_ILS;
        $ExchangeRate->jod = $JOD_ILS;
        $ExchangeRate->egp = $ILS_EGP;
        $ExchangeRate->eur = $EUR_ILS;
        $ExchangeRate->save();
    }
    $ExchangeRate = \App\Models\ExchangeRate::where('today', date('Y-m-d'))->first();
    return $ExchangeRate;
}

function check_wheather()
{
    //$dateObject = date('Y-m-d', strtotime($date));

    $Weather = \App\Models\Weather::where('weather_date', date('Y-m-d'))->first();
    if (!$Weather) {
        $sss = yahoo_weather();
        if ($sss) {
            $icon = $sss->forecast->forecastday[0]->day->condition->icon;
            $hig = $sss->forecast->forecastday[0]->day->maxtemp_c;
            $low = $sss->forecast->forecastday[0]->day->mintemp_c;

            $Weather = new \App\Models\Weather();
            $Weather->weather_date = date('Y-m-d');
            $Weather->high = $hig;
            $Weather->low = $low;
            $Weather->type = $icon;
            $Weather->save();
        }

    }

    return $Weather;

}


function return_just_day($date)
{
    $array_date = Carbon::parse($date)->format('D');

    switch ($array_date) {
        case "Sat":
            $day = 'السبت';
            break;
        case "Sun":
            $day = 'الأحد';
            break;
        case "Mon":
            $day = 'الإثنين';
            break;
        case "Tue":
            $day = 'الثلاثاء';
            break;
        case "Wed":
            $day = 'الأربعاء';
            break;
        case "Thu":
            $day = 'الخميس';
            break;
        case "Fri":
            $day = 'الجمعة';
            break;
    }
    return $day;
}
function ip_info()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function ip_data($ip = NULL, $purpose = "location", $deep_detect = TRUE)
{
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "ip" => $ip,
                        "city" => @$ipdat->geoplugin_city,
                        "state" => @$ipdat->geoplugin_regionName,
                        "country" => @$ipdat->geoplugin_countryName,
                        "country_code" => @$ipdat->geoplugin_countryCode,
                        "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );

                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;

                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;

            }
        }
    }
    return $output;
}

function client_ip()
{
    return request()->ip();
}

function substring($title, $width)
{
    if (strlen($title) > $width) {
        return mb_substr($title, 0, $width, "utf-8") . '...';
    } else {
        return $title;
    }

}
function get_adhan()
{
    $adan = \App\Models\Adan::where('date', date('Y-m-d'))->first();
    //This Comment Done By Moman ;
    /*if(empty($adan)){
        $time_aladan = @json_decode(file_get_contents("http://api.aladhan.com/timingsByAddress/".date('Y-m-d')."?address=Jerusalem,Palestine&method=8"));
        if($time_aladan && $time_aladan->data){
            $aladan=$time_aladan->data->timings;

        $adan = new \App\Models\Adan();
        $adan->date=date('Y-m-d');
        $adan->daybreak=$aladan->Fajr;
        $adan->daybreak1=get_adhan($aladan->Fajr,20);
        $adan->noon=$aladan->Dhuhr;
        $adan->noon1=get_adhan($aladan->Dhuhr,20);
        $adan->afternoon=$aladan->Asr;
        $adan->afternoon1=get_adhan($aladan->Asr,20);
        $adan->sunset=$aladan->Maghrib;
        $adan->sunset1=get_adhan($aladan->Maghrib,10);
        $adan->night=$aladan->Isha;
        $adan->night1=get_adhan($aladan->Isha,10);
        $adan->save();
         }else{
            $adan=\App\Models\Adan::orderBy('id','DESC')->first();

        }
    }*/
    return $adan;
}

function return_post_link($post)
{
    if ($post->post_id) {
        $post_id = $post->post_id;
    } else {
        $post_id = $post->id;
    }
    $name = str_replace('%', '::', $post->title);
    $url = (implode('-', explode(' ', $name)));
    $url = (implode('-', explode('/', $url)));
    //$url2=(implode('-',explode(' ',$name)));
    return url('/post/' . $post_id . '/' . $url);
}
function return_new_post_link($post)
{
    if ($post->post_id) {
        $post_id = $post->post_id;
    } else {
        $post_id = $post->id;
    }
    $name = str_replace('%', '::', $post->title);
    $url = (implode('-', explode(' ', $name)));
    $url = (implode('-', explode('/', $url)));
    //$url2=(implode('-',explode(' ',$name)));
    return url('/post/' . $post_id . '/' . $url);
}
function return_category_link($post)
{

    $name = str_replace('%', '::', $post->name);
    return url('/category/' . $post->id . '/' . (implode('-', explode(' ', $name))));
}
function return_new_category_link($post)
{

    $name = str_replace('%', '::', $post->name);
    return url('/category/' . $post->id . '/' . (implode('-', explode(' ', $name))));
}

function saveBase64Ads($image, $direction)
{

    $img_manager = new ImageManager(new Driver());

    $img = $img_manager->read($image);

    $mime = explode('/', $img->exif()->first()['MimeType'])[1];

    // check direction
    $dir = 'uploads/' . $direction;
    File::exists(my_public() . 'uploads/' . $direction . '/') or File::makeDirectory(my_public() . 'uploads/' . $direction, 0755, true);
    File::exists(my_public() . '/' . $dir) or File::makeDirectory(my_public() . $dir, 0755, true);
    $file_name = rand(10000, 99999) . '.' . $mime;
    $img->save(my_public() . $dir . '/' . $file_name);
    return $dir . '/' . $file_name;
}
function day_get($date)
{
    $array_date = Carbon::parse($date)->format('Y-m-d-D H:i');
    $array_date_new = explode('-', $array_date);
    $array_day_name = explode(' ', $array_date_new[3]);

    switch ($array_day_name[0]) {
        case "Sat":
            $day = 'السبت';
            break;
        case "Sun":
            $day = 'الأحد';
            break;
        case "Mon":
            $day = 'الإثنين';
            break;
        case "Tue":
            $day = 'الثلاثاء';
            break;
        case "Wed":
            $day = 'الأربعاء';
            break;
        case "Thu":
            $day = 'الخميس';
            break;
        case "Fri":
            $day = 'الجمعة';
            break;
    }

    switch ($array_date_new[1]) {
        case "1":
            $month = 'يناير';
            break;
        case "2":
            $month = 'فبراير';
            break;
        case "3":
            $month = 'مارس';
            break;
        case "4":
            $month = 'إبريل';
            break;
        case 5:
            $month = 'مايو';
            break;
        case 6:
            $month = 'يونيو';
            break;
        case 7:
            $month = 'يوليو';
            break;
        case 8:
            $month = 'أغسطس';
            break;
        case 9:
            $month = 'سبتمبر';
            break;
        case 10:
            $month = 'أكتوبر';
            break;
        case 11:
            $month = 'نوفمبر';
            break;
        case 12:
            $month = 'ديسمبر';
            break;
    }

    return $array_date_new[2];
}

function month_get($date)
{
    $array_date = Carbon::parse($date)->format('Y-m-d-D H:i');
    $array_date_new = explode('-', $array_date);
    $array_day_name = explode(' ', $array_date_new[3]);

    switch ($array_day_name[0]) {
        case "Sat":
            $day = 'السبت';
            break;
        case "Sun":
            $day = 'الأحد';
            break;
        case "Mon":
            $day = 'الإثنين';
            break;
        case "Tue":
            $day = 'الثلاثاء';
            break;
        case "Wed":
            $day = 'الأربعاء';
            break;
        case "Thu":
            $day = 'الخميس';
            break;
        case "Fri":
            $day = 'الجمعة';
            break;
    }

    switch ($array_date_new[1]) {
        case "1":
            $month = 'يناير';
            break;
        case "2":
            $month = 'فبراير';
            break;
        case "3":
            $month = 'مارس';
            break;
        case "4":
            $month = 'إبريل';
            break;
        case 5:
            $month = 'مايو';
            break;
        case 6:
            $month = 'يونيو';
            break;
        case 7:
            $month = 'يوليو';
            break;
        case 8:
            $month = 'أغسطس';
            break;
        case 9:
            $month = 'سبتمبر';
            break;
        case 10:
            $month = 'أكتوبر';
            break;
        case 11:
            $month = 'نوفمبر';
            break;
        case 12:
            $month = 'ديسمبر';
            break;
    }
    return $month;
}

function time_function()
{

    $array_date = Carbon::now();

    //        $array_date_new=explode('-',$array_date);
//        $array_day_name=explode(' ',$array_date_new[3]);
//        $time_array=explode(':',$array_day_name[1]);
//
//            if($time_array[1]>12){
//                $houres=$time_array[0]-12;
//                $pm='م';
//            }else{
//                $houres=$time_array[0];
//                $pm='ص';
//            }

    return $array_date->format('g:i A');


}
function date_now_function()
{

    $array_date = Carbon::now()->format('Y-m-d-D H:i');
    $array_date_new = explode('-', $array_date);
    $array_day_name = explode(' ', $array_date_new[3]);

    switch ($array_day_name[0]) {
        case "Sat":
            $day = 'السبت';
            break;
        case "Sun":
            $day = 'الأحد';
            break;
        case "Mon":
            $day = 'الإثنين';
            break;
        case "Tue":
            $day = 'الثلاثاء';
            break;
        case "Wed":
            $day = 'الأربعاء';
            break;
        case "Thu":
            $day = 'الخميس';
            break;
        case "Fri":
            $day = 'الجمعة';
            break;
    }

    switch ($array_date_new[1]) {
        case "1":
            $month = 'يناير';
            break;
        case "2":
            $month = 'فبراير';
            break;
        case "3":
            $month = 'مارس';
            break;
        case "4":
            $month = 'إبريل';
            break;
        case 5:
            $month = 'مايو';
            break;
        case 6:
            $month = 'يونيو';
            break;
        case 7:
            $month = 'يوليو';
            break;
        case 8:
            $month = 'أغسطس';
            break;
        case 9:
            $month = 'سبتمبر';
            break;
        case 10:
            $month = 'أكتوبر';
            break;
        case 11:
            $month = 'نوفمبر';
            break;
        case 12:
            $month = 'ديسمبر';
            break;
    }


    return $day . ' ' . $array_date_new[2] . ' ' . $month . ' ' . $array_date_new[0];
}


function getLimitDescription($description, $limit = 7)
{
    $stringSplit = strip_tags($description);
    $value = Str::limit($stringSplit, $limit, '&raquo');
    return $value;
}

function str_limit($value, $limit = null, $end = '...')
{
    return Str::limit($value, $limit, $end);
}
