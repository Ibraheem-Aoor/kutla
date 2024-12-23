<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Page;
use App\Models\Urgent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class UrgentsController extends Controller
{


    public function index()
    {
        meta('title', 'الأخبار العاجلة');

        $breadcrumb = breadcrumbs()
            ->add('الأخبار العاجلة', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if (in_array('add_urgent', $this->actions) || in_array('edit_urgent', $this->actions) || in_array('delete_urgent', $this->actions) || in_array('view_urgent', $this->actions)) {

            return view('dashboards.urgents.index');
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', ' إضافة خبر عاجل');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الأخبار العاجلة', route('urgents.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        if (in_array('add_urgent', $this->actions)) {
            $categories = Category::where('type', 'post')->get();

            return view('dashboards.urgents.form',compact('categories'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'duration' => 'required|numeric|min:1',
            //'category_id' => 'required',
            //'url' => 'required|url',


        ], [], [
            'title' => ' عنوان الاستفتاء',
            'duration' => 'مدة الظهور',
            'url' => 'الرابط',
            'category_id' => 'التصنيف',

        ]);
        $dt = Carbon::parse(date('Y-m-d H:i:s'));
        $dt->addMinutes($request->duration);
        $end_view= $dt->format('Y-m-d H:i:s');

        $urgent = new Urgent();
        $urgent->title = $request->title;
        $urgent->category_id = $request->category_id;
        $urgent->duration = $request->duration;
        $urgent->url = $request->url;
        $urgent->end_view = $end_view;
        $urgent->save();

        $message = 'تمت إضافة الخبر بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل الخبر العاجل');
        $urgent = Urgent::find($id);

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الأخبار العاجلة', route('urgents.index'))
            ->add(meta('title'));
        meta('breadcrumb', $breadcrumb->render());


        if (in_array('edit_urgent', $this->actions)) {
            $categories = Category::where('type', 'post')->get();

            return view('dashboards.urgents.form', compact('urgent','categories'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function search(Request $request)
    {
        $urgents = Urgent::with('category')->whereNull('deleted_at');

        if (request()->has('filter')) {
            if ($request->filter != '') {
                $filter = request('filter');
                $urgents = $urgents->where('name', 'LIKE', "%$filter%");

            }
        }


        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $urgents = $urgents->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $urgents = $urgents->orderBy('id', 'DESC')->paginate(15);

        return response()->json(compact('urgents'));
    }

    public function delete_page($id)
    {
        $urgent = Urgent::find($id);

        if ($urgent) {

            $urgent->delete();
            $message = 'تم الحذف بنجاح';

            return response()->json(compact('message'));

        }
        return response()->json(compact('فشل'), 404);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'duration' => 'required|numeric|min:1',
            //'category_id' => 'required',
            //'url' => 'url',


        ], [], [
            'title' => ' عنوان الاستفتاء',
            'duration' => 'مدة الظهور',
           // 'url' => 'الرابط',
            'category_id' => 'التصنيف',

        ]);
        $dt = Carbon::parse(date('Y-m-d H:i:s'));
        $dt->addMinutes($request->duration);
        $end_view= $dt->format('Y-m-d H:i:s');
        $urgent = Urgent::find($id);
        $urgent->title = $request->title;
        $urgent->duration = $request->duration;
        $urgent->url = $request->url;
        $urgent->category_id = $request->category_id;
        $urgent->end_view = $end_view;
        $urgent->save();

        $message = 'تمت التعديل بنجاح';

        return response()->json(compact('message'));
    }

}