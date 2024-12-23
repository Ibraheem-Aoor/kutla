<?php

namespace App\Http\Controllers;

use App\Releas;
use Illuminate\Http\Request;

class ReleasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        meta('title', 'الاصدارات');

        $breadcrumb = breadcrumbs()
            ->add('الاصدارات','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_case',$this->actions) || in_array('edit_case',$this->actions) || in_array('delete_case',$this->actions) || in_array('view_case',$this->actions)){

            return view('dashboards.relase.index');
        }else{
            return view('dashboards.no_permistion');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        meta('title', ' إضافة اصدار');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add(' إضافة اصدار', route('cases.index'))
            ->add(meta('title'));


        meta('breadcrumb', $breadcrumb->render());

        if(in_array('add_case',$this->actions)){

            return view('dashboards.relase.form');
        }else{
            return view('dashboards.no_permistion');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title'      => 'required|max:255',
            //'details'      => 'required',
            'photo_id'      => 'required',
            'active'      => 'required',
            'link'      => 'required',

        ], [], [
            'title'      => 'اسم الملف',
            //'details'      => 'التفاصيل',
            'photo_id'      => 'صورة الملف',
            'active'      => 'حالة الملف',
            'link'      => 'رابط التحميل',


        ]);

        $case=new Releas();
        $case->title=$request->title;
        $case->description=$request->description;
        $case->photo_id=$request->photo_id;
        $case->active=$request->active;
        $case->link=$request->link;
        $case->save();

        $message = 'تمت إضافة الملف بنجاح';

        return response()->json(compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Releas  $releas
     * @return \Illuminate\Http\Response
     */
    public function show(Releas $relea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Releas  $releas
     * @return \Illuminate\Http\Response
     */
    public function edit(Releas $relea)
    {

        meta('title', 'تعديل الاصدار ');
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الاصدارات', route('releas.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());


        if(in_array('edit_case',$this->actions)){

            return view('dashboards.relase.form',compact('relea'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Releas  $releas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Releas $relea)
    {

        $this->validate($request, [
            'title'      => 'required|max:255',
            'photo_id'      => 'required',
            'link'      => 'required',
            'active'      => 'required',

        ], [], [
            'title'      => 'اسم الملف',
            'photo_id'      => 'صورة الملف',
            'active'      => 'حالة الملف',
            'link'      => 'رابط التحميل',
        ]);

        $relea->title=$request->title;
        $relea->description=$request->description;
        $relea->photo_id=$request->photo_id;
        $relea->active=$request->active;
        $relea->link=$request->link;
        $relea->save();


        $message = 'تم تعديل الملف بنجاح';

        return response()->json(compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Releas  $releas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Releas $relea)
    {

        $relea->delete();
        $message = 'تم الحذف بنجاح';

        return response()->json(compact('message'));
    }

    public function search(Request $request )
    {
        $cases = Releas::with('photo')->orderBy('id','DESC');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $cases = $cases->where('title', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $cases = $cases->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $cases = $cases->paginate(15);

        return response()->json(compact('cases'));
    }
}
