<?php

namespace App\Http\Controllers;

use App\Models\ActionRole;
use App\Models\Albom;
use App\Models\Cases;
use App\Models\Category;
use App\Models\FileLibrary;
use App\Models\Tag;
use File;
//use Image;
use Illuminate\Http\Request;
use App\Classes\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use DB;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AlbomController extends Controller
{

    public function index()
    {
        meta('title', 'الألبومات');

        $breadcrumb = breadcrumbs()
            ->add('الألبومات', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        $categories = Category::where('type', 'album')->get();

        if (in_array('add_album', $this->actions) || in_array('edit_album', $this->actions) || in_array('delete_album', $this->actions) || in_array('view_album', $this->actions)) {

            return view('dashboards.albums.index', compact('categories'));
        } else {
            return view('dashboards.no_permistion');
        }
    }

    public function show($id)
    {

        $albom = Albom::with('photos', 'category')->findOrFail($id);

        meta('title', $albom->name);

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الألبومات', route('albums.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if (in_array('view_album', $this->actions)) {

            return view('dashboards.albums.show', compact('albom'));
        } else {
            return view('dashboards.no_permistion');
        }
    }


    public function create()
    {

        meta('title', 'إضافة ألبوم');


        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الألبومات', route('albums.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        if (in_array('add_album', $this->actions)) {
            $cases = Cases::get();

            return view('dashboards.albums.form', compact('cases'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function getAlbomCat()
    {
        $cat = Category::where('type', 'album')->get();

        return response()->json($cat);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            //'details' => 'required',

        ], [], [
            'name' => 'الاسم ',
            'category_id' => 'تصنيف الألبوم',
            // 'details' => 'تفاصيل الألبوم',

        ]);
        $publish_at = date("Y-m-d H:i:s", strtotime($request->publish_at));
        $albom = Albom::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'details' => $request->details,
            'case_id' => $request->case_id,
            'active' => $request->active,
            'published_at' => $publish_at

        ]);

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                //   $file_name = saveBase64Image($image, 'alboms',null,null,null,$request->watermark);

                $img = FileLibrary::find($image);
                // $img->file_name=$file_name;
                //$img->type='photo';
                //$img->table_type='albums';
                $img->album_id = $albom->id;
                $img->save();
            }
        }


        $message = 'تم الإضافة بنجاح.';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', ' تعديل ألبوم');
        $albom = Albom::with('photos', 'cases')->findOrFail($id);
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('الألبومات', route('albums.index'))
            ->add(meta('title'));
        $cases = Cases::get();
        meta('breadcrumb', $breadcrumb->render());

        if (in_array('edit_album', $this->actions)) {

            return view('dashboards.albums.form', compact('albom', 'cases'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            //'details' => 'required',

        ], [], [
            'name' => 'الاسم ',
            'category_id' => 'تصنيف الألبوم',
            // 'details' => 'تفاصيل الألبوم',

        ]);
        $publish_at = date("Y-m-d H:i:s", strtotime($request->publish_at));
        $albom = Albom::find($id);
        if ($albom) {
            $albom->name = $request->name;
            $albom->category_id = $request->category_id;
            $albom->details = $request->details;
            $albom->active = $request->active;
            $albom->case_id = $request->case_id;
            $albom->published_at = $publish_at;
            $albom->save();
        }
        FileLibrary::where('album_id', $id)->delete();

        foreach ($request->images as $image) {

            if (!is_array($image)) {
                $file_name = saveBase64Image($image, 'alboms');
            } else {
                $file_name = $image['file_name'];
            }
            $img = new FileLibrary();
            $img->file_name = $file_name;
            $img->type = 'photo';
            $img->table_type = 'albums';
            $img->album_id = $id;
            $img->save();
        }
        $message = 'تمت تعديل الألبوم بنجاح';

        return response()->json(compact('message'));
    }

    public function delete($id)
    {
        //dd('dddddd');
        $albom = Albom::findOrFail($id);

        // $albom->photos->delete();
        foreach ($albom->photos as $photo) {
            $photo->album_id = null;
            $photo->save();
        }

        $albom->delete();

        $message = 'تم الحذف بنجاح';

        return response()->json(compact('message'));
    }

    public function deletImage($id)
    {
        //dd('dddddd');
        $file = FileLibrary::findOrFail($id);

        $file->album_id = null;
        $file->save();

        $message = 'تم الحذف بنجاح';

        return response()->json(compact('message'));
    }


    ////Add photo to Albom

    public function add_photo(Request $request, $albom_id)
    {
        $request->validate([
            // 'tags' => 'required',
            //  'photo_caption' => 'required',
            'uploaded_img' => 'required',

        ], [], [
            // 'tags' => 'Tags ',
            //  'photo_caption' => 'عنوان الصورة',
            'uploaded_img' => 'الصورة',

        ]);


        $albom = Albom::findOrFail($albom_id);

        //save Tags
        foreach ($request->tags as $tag) {
            $old_tag = Tag::where('name', $tag)->first();
            if (!$old_tag && $tag) {
                $t = new Tag();
                $t->name = $tag;
                $t->save();
            }
        }

        // If Create new image
        if ($request->image_id == '') {
            $file_name = saveBase64Image($request->uploaded_img, 'alboms');
            $img = new FileLibrary();
            $img->file_name = $file_name;
            $img->type = 'photo';
            $img->table_type = 'albums';
            $img->album_id = $albom->id;
        } else {
            //If Edit
            $img = FileLibrary::findOrFail($request->image_id);
        }
        if ($request->album_cover) {
            $array_update = array('album_cover' => 0);
            DB::table('files_library')
                ->where('album_id', $albom->id)
                ->update($array_update);
        }
        $img->album_cover = $request->album_cover;
        $img->photo_caption = $request->photo_caption;
        $img->tags = $request->tags ? implode(",", $request->tags) : null;
        $img->save();


        $message = 'تم الإضافة بنجاح.';

        return response()->json(compact('message'));

    }


    function saveBase64Image($image, $direction)
    {
        $img_manager = new ImageManager(new Driver());
        $img = $img_manager->read($image);
        $mime = explode('/', $img->exif()->first()['MimeType'])[1];

        // check direction
        $dir = 'uploads/' . $direction;
        File::exists(my_public() . 'uploads/' . $direction . '/') or File::makeDirectory(my_public() . 'uploads/' . $direction, 0755, true);
        File::exists(my_public() . '/' . $dir) or File::makeDirectory(my_public() . $dir, 0755, true);

        // check thump direction
        File::exists(my_public() . 'uploads/' . $direction . '/') or File::makeDirectory(my_public() . 'uploads/' . $direction . '/thump', 0755, true);
        File::exists(my_public() . '/' . $dir . '/thump/') or File::makeDirectory(my_public() . $dir . '/thump/', 0755, true);

        // save Image
        $file_name = rand(10000, 99999) . '.' . $mime;
        $img->save(my_public() . $dir . '/' . $file_name);

        // save_thump
        $thump_image = $img->resize(150, 150);
        $img->save(my_public() . $dir . '/thump/' . $file_name);

        return $dir . '/' . $file_name;
    }


    public function addcover($id)
    {
        //dd('dddddd');
        $image = FileLibrary::findOrFail($id);
        $allphoto = FileLibrary::where('album_id', $image->album_id)->get();
        foreach ($allphoto as $photo) {
            $photo->album_cover = 0;
            $photo->save();
        }
        $image = FileLibrary::findOrFail($id);
        $image->album_cover = 1;
        $image->save();

        $message = 'تم الحذف بنجاح';

        return response()->json(compact('message'));
    }

    public function search_album()
    {
        $filter = json_decode(request('filter'));

        $albums = Albom::with('category')->where(function ($query) use ($filter) {
            if ($filter->title) {
                $query->where('name', 'like', "%$filter->title%");
            }
            if (isset($filter->start_date) && isset($filter->end_date)) {
                if ($filter->start_date && $filter->end_date) {

                    $published_at = date('Y-m-d H:i:s', strtotime($filter->start_date));
                    $published_to = date('Y-m-d H:i:s', strtotime($filter->end_date));
                    $query->whereBetween('created_at', [$published_at, $published_to]);

                }
            }
            if ($filter->category_id) {
                $query->where('category_id', $filter->category_id);
            }
            if (\request('cases') != 'null') {
                $query->where('case_id', \request('cases'));
            }
        })->paginate(20);
        $albums = collect($albums);
        $data = [
            'albums' => $albums['data'],
            'meta' => $albums->except('data'),
        ];
        return response()->json(compact('data'));
    }

    public function album_case($case = null)
    {
        $cases = Cases::find($case);

        meta('title', 'المنشورات');
        if ($case == null) {
            $breadcrumb = breadcrumbs()
                ->add('الألبومات', '#', 'icon-home')
                ->add(meta('title'));
        } else {
            $breadcrumb = breadcrumbs()
                ->add('الألبومات', route('albums.index'), 'icon-home')
                ->add('الملفات الخاصة', route('cases.index'))
                ->add($cases->name);
        }


        $alboms = Albom::with('photos', 'category', 'photoscover')->where('case_id', $cases->id)->orderBy('id', 'DESC')->paginate(50);
        $alboms = collect($alboms);
        $data_albums = [
            'albums' => $alboms['data'],
            'meta' => $alboms->except('data'),
        ];
        $categories = Category::where('type', 'album')->get();

        if (in_array('add_album', $this->actions) || in_array('edit_album', $this->actions) || in_array('delete_album', $this->actions) || in_array('view_album', $this->actions)) {

            return view('dashboards.albums.index', compact('data_albums', 'cases', 'categories'));

        } else {
            return view('dashboards.no_permistion');
        }
    }



    function saveImageForAlbom(Request $request)
    {

        $image = $request->image;
        $file_name = saveBase64Image($image, 'alboms', null, null, null, $request->watermark);
        $img = new FileLibrary();
        $img->file_name = $file_name;
        $img->type = 'photo';
        $img->table_type = 'albums';
        $img->save();
        return ['status' => 'success', 'code' => 200, 'photo_id' => $img->id];
    }
}
