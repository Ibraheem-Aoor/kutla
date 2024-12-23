<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use DB;

class TagsController extends Controller
{


    public function index()
    {
        meta('title', 'الوسوم');

        $breadcrumb = breadcrumbs()
            ->add('الوسوم','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('delete_tag',$this->actions) || in_array('view_tag',$this->actions)){

            return view('dashboards.tags.index');
        }else{
            return view('dashboards.no_permistion');
        }
    }



    public function search(Request $request )
    {
        $tags = Tag::orderBy('id','DESC');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $tags = $tags->where('name', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $tags = $tags->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $tags = $tags->paginate(30);
        foreach ($tags as $tag){
            $post=Post::where('tags','like','%'.$tag->name.'%')->count();
            $tag->post_count=$post;
        }
        return response()->json(compact('tags'));
    }

    public function delete($id)
    {
        $tag=Tag::find($id);

        if($tag){

            $tag->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));
            }
        }


    public function get_tags(Request $request )
    {
        $tags = Tag::orderBy('id','DESC');


        $tags = $tags->where('name', 'LIKE', $request->term)->orWhere('name', 'LIKE', "%".$request->term."%");



        $tags = $tags->get()->map(function ($c) {
            return $c->name
            ;
        });

        return response()->json(compact('tags'));
    }

}