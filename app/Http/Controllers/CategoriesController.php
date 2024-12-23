<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;

use App\Models\Category;
use App\Models\PostPosition;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class CategoriesController extends Controller
{


    public function index()
    {
        meta('title', 'التصنيفات');

        $breadcrumb = breadcrumbs()
            ->add('التصنيفات', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if (in_array('add_cat', $this->actions) || in_array('edit_cat', $this->actions) || in_array('delete_cat',$this->actions) || in_array('view_cat', $this->actions)){
            return view('dashboards.categories.index');
      }else{
            return view('dashboards.no_permistion');
        }
    }

    public function create()
    {

        meta('title', 'إضافة تصنيف');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('التصنيفات', route('categories.index'))
            ->add(meta('title'));
        $positions = PostPosition::get();

        meta('breadcrumb', $breadcrumb->render());

        if (in_array('add_cat', $this->actions)) {

            return view('dashboards.categories.form',compact('positions'));
        }else{
            return view('dashboards.no_permistion');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'type'      => 'required',
        ], [], [
            'name'      => 'عنوان التصنيف',
            'type'      => 'نوع التصنيف',
        ]);
        if($request->position){
            $array_update = array('position' => null);
            DB::table('categories')
                ->where('position', $request->position)
                ->update($array_update);
        }
      $category=new Category();
      $category->name=$request->name;
      $category->type=$request->type;
      $category->is_menu=$request->is_menu;
      $category->position=$request->position;
      $category->order=$request->order;
      $category->save();

        $message = 'تمت إضافة التصنيف بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'إضافة تصنيف');
$category=Category::with('Position')->find($id);
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('التصنيفات', route('categories.index'))
            ->add(meta('title'));
        $positions = PostPosition::get();
        meta('breadcrumb', $breadcrumb->render());

        if (in_array('edit_cat', $this->actions)) {

            return view('dashboards.categories.form',compact('category','positions'));
        }else{
            return view('dashboards.no_permistion');
        }
    }

    public function search(Request $request )
    {
        $categories = Category::where('type','post')->with('Position');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $categories = $categories->where('name', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $categories = $categories->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $categories = $categories->paginate(25);

        return response()->json(compact('categories'));
    }

    public function delete_category($id)
    {
        $category=Category::find($id);

        if($category){
            switch ($category->type) {
                case "post":
                    $model='App\Models\Post';
                    $mdels_name='المنشورات';
                    break;
                case "video":
                    $model='App\Models\Video';
                    $mdels_name='الفديوهات';
                    break;
                case "writer":
                    $model='App\Models\Writer';
                    $mdels_name='الكتاب';
                    break;
                case "album":
                    $model='App\Models\Album';
                    $mdels_name='الألبومات';
                    break;
                case "votes":
                    $model='App\Models\Vote';
                    $mdels_name='استطلاع الرأي';
                    break;

            }
            $model_count=0;
            if($model){
                $model_count=$model::where('category_id',$id)->count();
            }

            //$model_count=0;
            if($model_count>0){
                $message = 'لا يمكن حذف هذا التصنيف , يجب أن يتم حذف كافة '.$mdels_name.' الخاصة به';

                return response()->json(compact('message'),404);
            }else{
                $category->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));
            }
        }

    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'type'      => 'required',
        ], [], [
            'name'      => 'عنوان التصنيف',
            'type'      => 'نوع التصنيف',
        ]);
        if($request->position){
            $array_update = array('position' => null);
            DB::table('categories')
                ->where('position', $request->position)
                ->update($array_update);
        }
        $category=Category::find($id);

        if($category){
            $category->name=$request->name;
            $category->type=$request->type;
            $category->is_menu=$request->is_menu;
            $category->position=$request->position;
            $category->order=$request->order;
            $category->save();
        }


        $message = 'تمت تعديل التصنيف بنجاح';

        return response()->json(compact('message'));
    }

}