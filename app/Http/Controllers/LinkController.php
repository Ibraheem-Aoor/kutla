<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        meta('title', 'مواقع اخري');

        $breadcrumb = breadcrumbs()
            ->add('مواقع اخريس','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        return view('dashboards.links.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        meta('title', ' إضافة موقع');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('المواقع', route('link.index'))
            ->add(meta('title'));


        meta('breadcrumb', $breadcrumb->render());

        return view('dashboards.links.form');

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
            'title'      => 'اسم الموقع',
            //'details'      => 'التفاصيل',
            'photo_id'      => 'صورة الملف',
            'active'      => 'حالة الملف',
            'link'      => 'رابط الموقع',


        ]);

        $case=new Link();
        $case->title=$request->title;
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
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {

        meta('title', 'تعديل الموقع ');
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('المواقع', route('link.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
            return view('dashboards.links.form',compact('link'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {

        $this->validate($request, [
            'title'      => 'required|max:255',
            'photo_id'      => 'required',
            'link'      => 'required',
            'active'      => 'required',

        ], [], [
            'title'      => 'اسم الموقع',
            'photo_id'      => 'صورة الموقع',
            'active'      => 'حالة الملف',
            'link'      => 'رابط الموقع',
        ]);

        $link->title=$request->title;
        $link->photo_id=$request->photo_id;
        $link->active=$request->active;
        $link->link=$request->link;
        $link->save();


        $message = 'تم تعديل الملف بنجاح';

        return response()->json(compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();
        $message = 'تم الحذف بنجاح';

        return response()->json(compact('message'));
    }


    public function search(Request $request )
    {
        $cases = Link::with('photo')->orderBy('id','DESC');

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
