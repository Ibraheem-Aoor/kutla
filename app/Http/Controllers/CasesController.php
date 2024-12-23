<?php

namespace App\Http\Controllers;


use App\Models\Cases;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class CasesController extends Controller
{


    public function index()
    {
        meta('title', 'ملفات خاصة');

        $breadcrumb = breadcrumbs()
            ->add('ملفات خاصة','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_case',$this->actions) || in_array('edit_case',$this->actions) || in_array('delete_case',$this->actions) || in_array('view_case',$this->actions)){

            return view('dashboards.cases.index');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', ' إضافة ملف خاص');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('ملفات خاصة', route('cases.index'))
            ->add(meta('title'));


        meta('breadcrumb', $breadcrumb->render());

        if(in_array('add_case',$this->actions)){

            return view('dashboards.cases.form');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
           $this->validate($request, [
            'name'      => 'required|max:255',
            //'details'      => 'required',
               'photo_id'      => 'required',
               'active'      => 'required',

           ], [], [
            'name'      => 'اسم الملف',
            //'details'      => 'التفاصيل',
               'photo_id'      => 'صورة الملف',
               'active'      => 'حالة الملف',


           ]);

        $case=new Cases();
        $case->name=$request->name;
        $case->details=$request->details;
        $case->photo_id=$request->photo_id;
        $case->active=$request->active;

        $case->save();

        $message = 'تمت إضافة الملف بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل الملف الخاص');
        $case=Cases::find($id);
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('ملفات خاصة', route('cases.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());


        if(in_array('edit_case',$this->actions)){

            return view('dashboards.cases.form',compact('case'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function search(Request $request )
    {
        $cases = Cases::with('photo','posts','videos','albums')->orderBy('id','DESC');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $cases = $cases->where('name', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $cases = $cases->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $cases = $cases->paginate(15);

        return response()->json(compact('cases'));
    }

    public function delete_case($id)
    {
        $case=Cases::find($id);

        if($case){
            
          $model_count=Post::where('case_id',$id)->count();
            if($model_count>0){
                $message = 'لا يمكن حذف الملف الخاص لوجود منشورات خاصه به, الرجاء حذف المنشورات التابعة له اولا';

                return response()->json(compact('message'),404);
            }else{
                $case->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));
            }
        }

    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'photo_id'      => 'required',
            'active'      => 'required',

        ], [], [
            'name'      => 'اسم الملف',
            'photo_id'      => 'صورة الملف',
            'active'      => 'حالة الملف',
        ]);

        $case= Cases::find($id);
        if($case){
            $case->name=$request->name;
            $case->details=$request->details;
            $case->photo_id=$request->photo_id;
            $case->active=$request->active;
            $case->save();
        }
        
        $message = 'تم تعديل الملف بنجاح';

        return response()->json(compact('message'));
    }



}