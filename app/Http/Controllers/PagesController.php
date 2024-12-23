<?php

namespace App\Http\Controllers;


use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class PagesController extends Controller
{


    public function index()
    {
        meta('title', 'الصفحات');

        $breadcrumb = breadcrumbs()
            ->add('الصفحات', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if (in_array('add_page', $this->actions) || in_array('edit_page', $this->actions) || in_array('delete_page', $this->actions) || in_array('view_page', $this->actions)) {

            return view('dashboards.pages.index');
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', ' إضافة صفحة');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الاستفتاءات', route('pages.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        if (in_array('add_page', $this->actions)) {

            return view('dashboards.pages.form');
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'photo_id' => 'required',
            // 'type'      => 'required',
            'detailes' => 'required',


        ], [], [
            'name' => ' عنوان الاستفتاء',
            'photo_id' => 'صورة الصفحة',
            'detailes' => 'التفاصيل',
        ]);

        $page = new Page();
        $page->name = $request->name;
        $page->details = $request->detailes;
        $page->photo_id = $request->photo_id;
        $page->summary = $request->summary;
        $page->active = $request->active;
        $page->save();

        $message = 'تمت إضافة الصفحة بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل الصفحة');
        $page = Page::with('photo')->find($id);

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الصفحات', route('pages.index'))
            ->add(meta('title'));
        meta('breadcrumb', $breadcrumb->render());


        if (in_array('edit_page', $this->actions)) {

            return view('dashboards.pages.form', compact('page'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function search(Request $request)
    {
        $pages = Page::with('photo');

        if (request()->has('filter')) {
            if ($request->filter != '') {
                $filter = request('filter');
                $pages = $pages->where('name', 'LIKE', "%$filter%");

            }
        }


        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $pages = $pages->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $pages = $pages->orderBy('id', 'DESC')->paginate(15);

        return response()->json(compact('pages'));
    }

    public function delete_page($id)
    {
        $page = Page::find($id);

        if ($page) {

            $page->delete();
            $message = 'تم الحذف بنجاح';

            return response()->json(compact('message'));

        }
        return response()->json(compact('فشل'), 404);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'photo_id' => 'required',
            // 'type'      => 'required',
            'detailes' => 'required',


        ], [], [
            'name' => ' عنوان الاستفتاء',
            'photo_id' => 'صورة الصفحة',
            'detailes' => 'التفاصيل',
        ]);

        $page = Page::find($id);
        $page->name = $request->name;
        $page->details = $request->detailes;
        $page->photo_id = $request->photo_id;
        $page->summary = $request->summary;
        $page->active = $request->active;
        $page->save();
        $message = 'تمت التعديل بنجاح';
        return response()->json(compact('message'));
    }

}