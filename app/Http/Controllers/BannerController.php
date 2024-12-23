<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use App\Models\FileLibrary;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        meta('title', 'اضافة بنر');

        $breadcrumb = breadcrumbs()
            ->add('البنر العلوي', '#')
            ->add('المنشورات المثبتة', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        $banner = Banner::first();

        return view('dashboards.banner.form',compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return saveFile($request->file, 'advs');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        if($request->image1_change){
            $image = $request->image1;
            $file_name = saveBase64Image($image, 'alboms',null,null,null,$request->watermark);
            $img1 = new FileLibrary();
            $img1->file_name=$file_name;
            $img1->type='photo';
            $img1->table_type='albums';
            $img1->save();
            $banner->photo_id=$img1->id;
        }
        if($request->image2_change){
            $image = $request->image2;
            $file_name = saveBase64Image($image, 'alboms',null,null,null,$request->watermark);
            $img2 = new FileLibrary();
            $img2->file_name=$file_name;
            $img2->type='photo';
            $img2->table_type='albums';

            $img2->save();
            $banner->photo2_id=$img2->id;
        }
        if($request->gif_image_change){
            $image = $request->gif_image_url;
            $banner->gif_image=$request->gif;
        }


        $this->validate($request, [
            'title'      => 'required|max:255',
            'link'      => 'required',
            'active'      => 'required',

        ], [], [
            'title'      => 'اسم الموقع',
            'active'      => 'حالة الملف',
            'link'      => 'رابط الموقع',
        ]);

        $banner->title=$request->title;
        $banner->active=$request->active;
        $banner->gif_active=$request->gif_active;
        $banner->link=$request->link;
        $banner->save();


        $message = 'تم تعديل الملف بنجاح';

        return response()->json(compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }

}
