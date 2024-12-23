<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;

use App\Models\Category;
use App\Models\Country;
use App\Models\Subscription;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class HotelsController extends Controller
{


    public function index()
    {
        meta('title', 'الفنادق');

        $breadcrumb = breadcrumbs()
            ->add('الفنادق','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_hotel',$this->actions) || in_array('edit_hotel',$this->actions) || in_array('delete_hotel',$this->actions) || in_array('view_hotel',$this->actions)){

            return view('dashboards.hotels.index');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', ' إضافة فندق');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الفنادق', route('hotels.index'))
            ->add(meta('title'));
        

        meta('breadcrumb', $breadcrumb->render());

        if(in_array('add_writer',$this->actions)){

            return view('dashboards.hotels.form',compact('categories','countries'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
           $this->validate($request, [
            'name'      => 'required|max:255',
            'address'      => 'required',
            'mobile'      => 'required',
            'phone'      => 'required',
               'photo_id'      => 'required',

           ], [], [
            'name'      => 'اسم الفندق',
            'address'      => 'العنوان',
            'phone'      => 'الهاتف',
            'mobile'      => 'رقم الموبايل',
               'photo_id'      => 'صورة الفندق',


           ]);

        $writer=new Hotel();
        $writer->name=$request->name;
        $writer->address=$request->address;
        $writer->phone=$request->phone;
        $writer->mobile=$request->mobile;
        $writer->facebook=$request->facebook;
        $writer->site=$request->site;
        $writer->whatsapp=$request->whatsapp;
        $writer->photo_id=$request->photo_id;
        $writer->save();

        $message = 'تمت إضافة الفندق بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل فندق');
        $hotel=Hotel::find($id);
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الفنادق', route('hotels.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());


        if(in_array('edit_hotel',$this->actions)){

            return view('dashboards.hotels.form',compact('hotel'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function search(Request $request )
    {
        $hotels = new Hotel();

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $hotels = $hotels->where('name', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $hotels = $hotels->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $hotels = $hotels->orderBy('id','DESC')->paginate(15);

        return response()->json(compact('hotels'));
    }

    public function delete_hotel($id)
    {
        $writer=Hotel::find($id);

        if($writer){
            

                $writer->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));
            }


    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'address'      => 'required',
            'mobile'      => 'required',
            'phone'      => 'required',
            'photo_id'      => 'required',

        ], [], [
            'name'      => 'اسم الفندق',
            'address'      => 'العنوان',
            'phone'      => 'الهاتف',
            'mobile'      => 'رقم الموبايل',
            'photo_id'      => 'صورة الفندق',


        ]);

        $writer= Hotel::find($id);
        $writer->name=$request->name;
        $writer->address=$request->address;
        $writer->phone=$request->phone;
        $writer->mobile=$request->mobile;
        $writer->facebook=$request->facebook;
        $writer->site=$request->site;
        $writer->whatsapp=$request->whatsapp;
        $writer->photo_id=$request->photo_id;
        $writer->save();

        $message = 'تمت تعديل الفندق بنجاح';

        return response()->json(compact('message'));
    }

}