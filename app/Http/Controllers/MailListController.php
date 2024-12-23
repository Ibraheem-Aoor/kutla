<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;

use App\Models\Category;
use App\Models\MailList;
use App\Models\MailListPost;
use App\Models\MailSent;
use App\Models\Post;
use App\Models\PostPosition;
use App\Models\Setting;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Mail;

class MailListController extends Controller
{


    public function index()
    {
        meta('title', 'القائمة البريدية');

        $breadcrumb = breadcrumbs()
            ->add('القائمة البريدية', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('view_contactus',$this->actions) || in_array('replay_contactus',$this->actions) || in_array('delete_contactus',$this->actions)){
            return view('dashboards.mail_list.index');
      }else{
            return view('dashboards.no_permistion');
        }
    }
    public function mail_sent()
    {
        meta('title', 'القائمة المرسلة');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('القائمة البريدية', route('mail_list.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('view_contactus',$this->actions) || in_array('replay_contactus',$this->actions) || in_array('delete_contactus',$this->actions)){

            return view('dashboards.mail_list.mail_sent');
        }else{
            return view('dashboards.no_permistion');
        }
    }

    public function send_mail()
    {

        meta('title', 'ارسال للقائمة البريدية');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('القائمة البريدية', route('mail_list.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());


            return view('dashboards.mail_list.send');

    }

    public function post_send_mail(Request $request)
    {
        $this->validate($request, [
            'title'      => 'required|max:255',
            'posts_chose'      => 'required',
        ], [], [
            'title'      => 'عنوان التصنيف',
            'posts_chose'      => 'المنشورات المختارة',
        ]);
        $setting=Setting::find(1);
        $mail_list=MailList::get();
        $data=$request->posts_chose;
      $sent=new MailSent();
        $sent->title=$request->title;
        $sent->save();
      foreach ($data as $post){

          $category=new MailListPost();
          $category->send_to_mail_id=$sent->id;
          $category->post_id=$post['id'];
          $category->save();
      }
        foreach ($mail_list as $e_mail){
            Mail::send('emails.mail_list',['posts'=>$data],function($message) use($e_mail,$setting,$request){
                $message->to($e_mail->email)->subject($request->title);
                $message->from($setting->email,'Ramallah News');
            });
        }

        $message = 'تم ارسال المنشورات الى القائمة البريدية بنجاح';

        return response()->json(compact('message'));
    }



    public function search(Request $request )
    {
        $mail_list = MailList::orderBy('id','DESC');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $mail_list = $mail_list->where('email', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $mail_list = $mail_list->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $mail_list = $mail_list->paginate(15);

        return response()->json(compact('mail_list'));
    }
    public function search_mail_sent(Request $request )
    {
        $mail_list = MailSent::with('post_sent.post');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $mail_list = $mail_list->where('email', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $mail_list = $mail_list->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $mail_list = $mail_list->paginate(15);

        return response()->json(compact('mail_list'));
    }
    public function search_posts(Request $request )
    {
        $posts = Post::where('active',1)->with('category');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $posts = $posts->where('title', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $posts = $posts->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $posts = $posts->paginate(15);

        return response()->json(compact('posts'));
    }

    public function delete($id)
    {
        $category=MailList::find($id);

        if($category){

                $category->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));

        }

    }


}