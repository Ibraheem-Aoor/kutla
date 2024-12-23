<?php

namespace App\Http\Controllers;


use App\Models\Adv;
use App\Models\AdvSetting;
use Illuminate\Http\Request;
use File;

use DB;

class AdvsController extends Controller
{


    public function index()
    {
        meta('title', 'الإعلانات');

        $breadcrumb = breadcrumbs()
            ->add('الإعلانات', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if (in_array('add_adv', $this->actions) || in_array('edit_adv', $this->actions) || in_array('delete_adv', $this->actions) || in_array('view_adv', $this->actions)) {

            return view('dashboards.advs.index');
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', ' إضافة إعلان');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الاعلانات', route('advs.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        $setting = AdvSetting::get();
        if (in_array('add_adv', $this->actions)) {

            return view('dashboards.advs.form',compact('setting'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'position' => 'required',
            'active' => 'required',


        ], [], [
            'title' => 'العنوان',
            'url' => 'الرابط',
            'image_src_mobile' => 'الصورة للموبايل',
            'image' => 'الصورة او iframe',
            'iframe' => 'الصورة او iframe',
            'position' => 'مكان الاعلان',
            'active' => 'الحالة',

        ]);
        $avatar_url1=null;
        $avatar_url2=null;
        $avatar_url3=null;
        $avatar_url4=null;
        if($request->image_src1) {
            $avatar_url1 = saveFile($request->image_src1, 'advs');
        }
        if($request->image_src2) {
            $avatar_url2 = saveFile($request->image_src2, 'advs');
        }
        if($request->image_src3) {
            $avatar_url3 = saveFile($request->image_src3, 'advs');
        }
        if($request->image_src4) {
            $avatar_url4 = saveFile($request->image_src4, 'advs');
        }
        $avatar_url_mobile1=null;
        $avatar_url_mobile2=null;
        $avatar_url_mobile3=null;
        $avatar_url_mobile4=null;
        if($request->image_src_mobile1) {
            $avatar_url_mobile1 = saveFile($request->image_src_mobile1, 'advs');
        }
        if($request->image_src_mobile2) {
            $avatar_url_mobile2 = saveFile($request->image_src_mobile2, 'advs');
        }
        if($request->image_src_mobile3) {
            $avatar_url_mobile3 = saveFile($request->image_src_mobile3, 'advs');
        }
        if($request->image_src_mobile4) {
            $avatar_url_mobile4 = saveFile($request->image_src_mobile4, 'advs');
        }

        $adv = new Adv();
        $adv->title = $request->title;
        $adv->image1 = $avatar_url1;
        $adv->image2 = $avatar_url2;
        $adv->image3 = $avatar_url3;
        $adv->image4 = $avatar_url4;
        $adv->location = $request->location;
        $adv->image_mobile1 = $avatar_url_mobile1;
        $adv->image_mobile2 = $avatar_url_mobile2;
        $adv->image_mobile3 = $avatar_url_mobile3;
        $adv->image_mobile4 = $avatar_url_mobile4;
        $adv->iframe1 = $request->iframe1;
        $adv->iframe2 = $request->iframe2;
        $adv->iframe3 = $request->iframe3;
        $adv->iframe4 = $request->iframe4;
        $adv->position = $request->position;
        $adv->active = $request->active;
        $adv->page = $request->page;
        $adv->url1 = $request->url1;
        $adv->url2 = $request->url2;
        $adv->url3 = $request->url3;
        $adv->url4 = $request->url4;
        $adv->save();

        $message = 'تمت إضافة الاعلان بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل الاعلان');
        $adv = Adv::find($id);

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الاعلانات', route('advs.index'))
            ->add(meta('title'));
        meta('breadcrumb', $breadcrumb->render());


        if (in_array('edit_adv', $this->actions)) {
            $setting = AdvSetting::get();

            return view('dashboards.advs.form', compact('adv','setting'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function search(Request $request)
    {
        $advs = Adv::whereNull('deleted_at');

        if (request()->has('filter')) {
            if ($request->filter != '') {
                $filter = request('filter');
                $advs = $advs->where('name', 'LIKE', "%$filter%");

            }
        }

//sleep(50);
        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $advs = $advs->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $advs = $advs->orderBy('id', 'DESC')->paginate(15);

        return response()->json(compact('advs'));
    }

    public function delete_page($id)
    {
        $adv = Adv::find($id);

        if ($adv) {

            $adv->delete();
            $message = 'تم الحذف بنجاح';

            return response()->json(compact('message'));

        }
        return response()->json(compact('فشل'), 404);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'position' => 'required',
            'active' => 'required',


        ], [], [
            'title' => 'العنوان',
            'url' => 'الرابط',
            'image_src_mobile' => 'الصورة للموبايل',
            'image' => 'الصورة او iframe',
            'iframe' => 'الصورة او iframe',
            'position' => 'مكان الاعلان',
            'active' => 'الحالة',

        ]);
        $avatar_url1=null;
        $avatar_url2=null;
        $avatar_url3=null;
        $avatar_url4=null;
        $adv =  Adv::find($id);
        if($request->image_src1 && $request->image_src1!='undefined') {
            $avatar_url1 = saveFile($request->image_src1, 'advs');
        }elseif($request->image_src1_edit){
            $avatar_url1=$adv->image1;
        }
        if($request->image_src2 && $request->image_src2!='undefined') {
            $avatar_url2 = saveFile($request->image_src2, 'advs');
        }elseif($request->image_src2_edit){
            $avatar_url2=$adv->image2;
        }
        if($request->image_src3 && $request->image_src3!='undefined') {
            $avatar_url3 = saveFile($request->image_src3, 'advs');
        }elseif($request->image_src3_edit){
            $avatar_url3=$adv->image3;
        }
        if($request->image_src4 && $request->image_src4!='undefined') {
            $avatar_url4 = saveFile($request->image_src4, 'advs');
        }elseif($request->image_src4_edit){
            $avatar_url4=$adv->image4;
        }
        $avatar_url_mobile1=null;
        $avatar_url_mobile2=null;
        $avatar_url_mobile3=null;
        $avatar_url_mobile4=null;
        if($request->image_src_mobile1 && $request->image_src_mobile1!='undefined') {
            $avatar_url_mobile1 = saveFile($request->image_src_mobile1, 'advs');
        }elseif($request->image_src_mobile1_edit){
            $avatar_url_mobile1=$adv->image_mobile1;
        }
        if($request->image_src_mobile2 && $request->image_src_mobile2!='undefined') {
            $avatar_url_mobile2 = saveFile($request->image_src_mobile2, 'advs');
        }elseif($request->image_src_mobile2_edit){
            $avatar_url_mobile2=$adv->image_mobile2;
        }
        if($request->image_src_mobile3 && $request->image_src_mobile3!='undefined') {
            $avatar_url_mobile3 = saveFile($request->image_src_mobile3, 'advs');
        }elseif($request->image_src_mobile3_edit){
            $avatar_url_mobile3=$adv->image_mobile3;
        }
        if($request->image_src_mobile4 && $request->image_src_mobile4!='undefined') {
            $avatar_url_mobile4 = saveFile($request->image_src_mobile4, 'advs');
        }elseif($request->image_src_mobile4_edit){
            $avatar_url_mobile4=$adv->image_mobile4;
        }


        $adv->title = $request->title;
        $adv->location = $request->location;
        $adv->image1 = $avatar_url1;
        $adv->image2 = $avatar_url2;
        $adv->image3 = $avatar_url3;
        $adv->image4 = $avatar_url4;
        $adv->image_mobile1 = $avatar_url_mobile1;
        $adv->image_mobile2 = $avatar_url_mobile2;
        $adv->image_mobile3 = $avatar_url_mobile3;
        $adv->image_mobile4 = $avatar_url_mobile4;
        $adv->iframe1 = $request->iframe1;
        $adv->iframe2 = $request->iframe2;
        $adv->iframe3 = $request->iframe3;
        $adv->iframe4 = $request->iframe4;
        $adv->position = $request->position;
        $adv->active = $request->active;
        $adv->page = $request->page;
        $adv->url1 = $request->url1;
        $adv->url2 = $request->url2;
        $adv->url3 = $request->url3;
        $adv->url4 = $request->url4;
        $adv->save();

        $message = 'تمت تعديل الاعلان بنجاح';

        return response()->json(compact('message'));
    }
    public function setting()
    {

        meta('title', 'اعدادات الاعلانات');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الاعلانات', route('advs.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        $setting = AdvSetting::get();
        if (in_array('add_adv', $this->actions)) {

            return view('dashboards.advs.setting',compact('setting'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function storeSetting(Request $request)
    {

        $avatar_url=null;
        $main = AdvSetting::find(1);
        $main->adv_part_1= $request->header;
        $main->adv_part_2= $request->main_side_1;
        $main->adv_part_3= $request->part_1;
        $main->adv_part_4= $request->part_2;
        $main->adv_part_5= $request->part_3;
        $main->adv_part_6= $request->part_4;
        $main->adv_part_7= $request->part_5;
        $main->adv_part_8= $request->part_6;
        $main->adv_part_9= $request->part_7;
        $main->adv_part_10= $request->part_8;
        $main->adv_part_11= $request->part_9;
        $main->adv_part_12= $request->part_10;
        $main->adv_part_13= $request->part_11;
        $main->adv_part_14= $request->main_under_title;
        $main->save();
        $details = AdvSetting::find(2);
        $details->adv_part_1= $request->details_side_1;
        $details->adv_part_2= $request->details_side_2;
        $details->adv_part_3= $request->details_side_3;
        $details->adv_part_4= $request->under_title;
        $details->adv_part_5= $request->details_inside;
        $details->adv_part_6= $request->after_details;
        $details->adv_part_7= $request->infront_details;
        $details->save();
        $hotels = AdvSetting::find(3);
        $hotels->adv_part_1= $request->hotel_side_1;
        $hotels->adv_part_2= $request->hotel_side_2;
        $hotels->adv_part_3= $request->hotel_side_3;
        $hotels->adv_part_4= $request->infront_hotels;
        $hotels->save();

        $message = 'تمت تعديل الاعدادات بنجاح';

        return response()->json(compact('message'));
    }


}