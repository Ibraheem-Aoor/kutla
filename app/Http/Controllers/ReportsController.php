<?php

namespace App\Http\Controllers;


use App\Models\Cases;
use App\Models\Category;
use App\Models\Post;
use App\Models\Report;
use App\Models\UserLog;
use App\Models\Visitor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use File;
use DB;

class ReportsController extends Controller
{


    public function index()
    {
        meta('title', 'التقارير');

        $breadcrumb = breadcrumbs()
            ->add('التقارير','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('view_user_logs',$this->actions)){

            return view('dashboards.reports.index');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', ' انشاء تقرير جديد');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('التقارير', route('reports.index'))
            ->add(meta('title'));


        meta('breadcrumb', $breadcrumb->render());

        if(in_array('view_user_logs',$this->actions)){

            return view('dashboards.reports.form');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
           $this->validate($request, [
            'type'      => 'required',
               'start_date'      => 'required',
               'end_date'      => 'required'

           ], [], [
            'type'      => 'نوع التقرير',
               'start_date'      => 'تاريخ بداية الفترة',
               'end_date'      => 'تاريخ نهاية الفترة'
           ]);
           if($request->type=='site'){
               $this->validate($request, [
                   'facebook'      => 'required',
                   'twitter'      => 'required',
                   'youtube'      => 'required',
                   'whatsapp'      => 'required',
                   'instagram'      => 'required'

               ], [], [
                   'facebook'      => 'المعجبون بالفيس بوك',
                   'twitter'      => 'متابعين التوتير',
                   'youtube'      => 'مشاهدات اليوتيوب',
                   'whatsapp'      => 'مشتركي الواتس اب',
                   'instagram'      => 'متابعي الانستجرام'
               ]);
           }
        $published_at = date('Y-m-d H:i:s', strtotime($request->start_date));
        $published_to = date('Y-m-d H:i:s', strtotime($request->end_date));
        $array_data=['date_from'=>$request->start_date,'date_to'=>$request->end_date];

        if($request->type=='site'){

       $categories=Category::where('type','post')->get();

            $post_done=Post::whereBetween('created_at', [$published_at, $published_to])->count();
             $all_visit_count=Visitor::whereBetween('created_at', [$published_at, $published_to])->count();
            $all_post_read=Post::whereBetween('created_at', [$published_at, $published_to])->sum('read_number');

            $all_new_visit_count=Visitor::whereBetween('created_at', [$published_at, $published_to])->distinct('ip')->count();
            $site_data=['facebook'      => $request->facebook,
                'twitter'      => $request->twitter,
                'youtube'      => $request->youtube,
                'whatsapp'      => $request->whatsapp,
                'instagram'      => $request->instagram,
                'post_done'      => $post_done,
                'all_post_read'      => $all_post_read,
                'all_visit_count'      => $all_visit_count,
                'all_new_visit_count'      => $all_new_visit_count];
            foreach ($categories as $cat){
           $post_count=Post::where('category_id',$cat->id)->whereBetween('created_at', [$published_at, $published_to])->count();
           $cat->post_count=$post_count;
       }
            $pdf = \PDF::loadView('pdf.site', compact('categories', 'site_data','array_data'));
            $pdf_name = 'تقرير عام _' . time();
        }else{
            $users=User::get();
            foreach ($users as $user){

                $user['transported']=Post::where('type','transported')->where('user_id',$user->id)->whereBetween('created_at', [$published_at, $published_to])->count();
                $user['special_report']=Post::where('type','special_report')->where('user_id',$user->id)->whereBetween('created_at', [$published_at, $published_to])->count();
                $user['synthesis_report']=Post::where('type','synthesis_report')->where('user_id',$user->id)->whereBetween('created_at', [$published_at, $published_to])->count();
                $user['special_interview']=Post::where('type','special_interview')->where('user_id',$user->id)->whereBetween('created_at', [$published_at, $published_to])->count();
                $user['special_news']=Post::where('type','special_news')->where('user_id',$user->id)->whereBetween('created_at', [$published_at, $published_to])->count();
                $user['photo']=UserLog::where('user_id',$user->id)->where('event','created')->where('logable_type','App\Models\FileLibrary')->whereBetween('created_at', [$published_at, $published_to])->count();
                $user['video']=UserLog::where('user_id',$user->id)->where('event','created')->where('logable_type','App\Models\Video')->whereBetween('created_at', [$published_at, $published_to])->count();
                $user['read']=Post::where('user_id',$user->id)->whereBetween('created_at', [$published_at, $published_to])->sum('read_number');
                $all_add=Post::where('user_id',$user->id)->whereBetween('created_at', [$published_at, $published_to])->count();
                $user['all_add']=$all_add+$user['photo']+$user['video'];
            }
            $pdf = \PDF::loadView('pdf.user', compact('users','array_data'));
        }

        \File::exists(my_public() . 'uploads/pdf/') or File::makeDirectory(my_public() . 'uploads/pdf/', 0755, true);
        $pdf_name = 'pdf-' . mt_rand(6, 999999) . '.pdf';
        $pdf_link = 'uploads/pdf/' . $pdf_name;
        $pdf->save('uploads/pdf/' . $pdf_name);
        $case=new Report();
        $case->type=$request->type;
        $case->date_from=$request->start_date;
        $case->date_to=$request->end_date;
        $case->file = $pdf_link;
        $case->save();

        $message = 'تمت إنشاء التقرير بنجاح';

        return response()->json(compact('message'));
    }


    public function search(Request $request)
    {
        $filter = json_decode(request('filter'));
        $reports = Report::where(function ($query) use ($filter) {
            if (isset($filter->start_date) && isset($filter->end_date)) {
                if ($filter->start_date && $filter->end_date) {
                    $published_at = date('Y-m-d H:i:s', strtotime($filter->start_date));
                    $published_to = date('Y-m-d H:i:s', strtotime($filter->end_date));
                    $query->whereBetween('created_at', [$published_at, $published_to]);
                }
            }
            if ($filter->type) {
                $query->where('type', "$filter->type");
            }

        });


        if (request()->has('sort') && request()->sort!='{"fieldName":"created_at","order":"desc"}') {
            $sort = json_decode(request('sort'), true);
            $reports = $reports->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }


        $reports = $reports->orderBy('id', 'DESC')->paginate(15);

        return response()->json(compact('reports'));
    }

    public function delete_reports($id)
    {
        $report=Report::find($id);

        if($report){
            $file=public_path().'/'.$report->file;
            File::delete($file);
            $report->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));

        }

    }




}