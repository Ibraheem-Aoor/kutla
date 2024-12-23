<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;

use App\Models\Category;
use App\Models\Country;
use App\Models\Subscription;
use App\Models\Writer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class WritersController extends Controller
{


    public function index()
    {
        meta('title', 'الكُتاب');

        $breadcrumb = breadcrumbs()
            ->add('الكُتاب','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_writer',$this->actions) || in_array('edit_writer',$this->actions) || in_array('delete_writer',$this->actions) || in_array('view_writer',$this->actions)){

            return view('dashboards.writers.index');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', ' إضافة كاتب');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الكُتاب', route('writers.index'))
            ->add(meta('title'));
        $categories=Category::where('type','writer')->get();
        $countries=Country::orderBy('en_name','ASC')->get();

        meta('breadcrumb', $breadcrumb->render());

        if(in_array('add_writer',$this->actions)){

            return view('dashboards.writers.form',compact('categories','countries'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
           $this->validate($request, [
            'name'      => 'required|max:255',
            'category_id'      => 'required',
            'description'      => 'required',
           // 'mobile'      => 'required',
            'details'      => 'required',
               'photo_id'      => 'required',

           ], [], [
            'name'      => 'اسم الكاتب',
            'category_id'      => 'التصنيف',
            'description'      => 'الوصف',
           // 'mobile'      => 'رقم الموبايل',
            'details'      => 'التفاصيل',
               'photo_id'      => 'صورة الكاتب',


           ]);

        $writer=new Writer();
        $writer->name=$request->name;
        $writer->category_id=$request->category_id;
        $writer->country_id=$request->country_id;
        $writer->mobile=$request->mobile;
        $writer->details=$request->details;
        $writer->facebook=$request->facebook;
        $writer->instagram=$request->instagram;
        $writer->twitter=$request->twitter;
        $writer->photo_caption=$request->photo_caption;
        $writer->photo_id=$request->photo_id;
        $writer->description=$request->description;
        $writer->save();

        $message = 'تمت إضافة الكاتب بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل كاتب');
        $writer=Writer::with('Category','Country')->find($id);
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الكُتاب', route('writers.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        $categories=Category::where('type','writer','photo')->get();
        $countries=Country::get();
        if(in_array('edit_writer',$this->actions)){

            return view('dashboards.writers.form',compact('writer','categories','countries'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function search(Request $request )
    {
        $writers = Writer::with('Category','Country','photo','Posts');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $writers = $writers->where('name', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $writers = $writers->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $writers = $writers->orderBy('id','DESC')->paginate(15);

        return response()->json(compact('writers'));
    }

    public function delete_writer($id)
    {
        $writer=Writer::find($id);

        if($writer){
            
            //$model_count=Post::where('writer_id',$id)->count();
            $model_count=0;
            if($model_count>0){
                $message = 'لا يمكن حذف الكاتب لوجود منشورات خاصه به, الرجاء حذف المنشورات التابعة له اولا';

                return response()->json(compact('message'),404);
            }else{
                $writer->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));
            }
        }

    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'category_id'      => 'required',
          //  'country_id'      => 'required',
            'description'      => 'required',
            'details'      => 'required',
            'photo_id'      => 'required',

        ], [], [
            'name'      => 'اسم الكاتب',
            'category_id'      => 'التصنيف',
          //  'country_id'      => 'الدولة',
            'description'      => 'الوصف',
            'details'      => 'التفاصيل',
            'photo_id'      => 'صورة الكاتب',
        ]);

        $writer= Writer::find($id);
        if($writer){
            $writer->name=$request->name;
            $writer->category_id=$request->category_id;
            $writer->country_id=$request->country_id;
            $writer->mobile=$request->mobile;
            $writer->details=$request->details;
            $writer->facebook=$request->facebook;
            $writer->instagram=$request->instagram;
            $writer->twitter=$request->twitter;
            $writer->photo_id=$request->photo_id;
            $writer->photo_caption=$request->photo_caption;
            $writer->description=$request->description;
            $writer->save();
        }
        
        $message = 'تمت إضافة الكاتب بنجاح';

        return response()->json(compact('message'));
    }

}