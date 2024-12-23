<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Countact;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;
use DB;

class ContactusController extends Controller
{


    public function index()
    {
        meta('title', 'البريد الوارد');

        $breadcrumb = breadcrumbs()
            ->add('البريد الوارد','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('view_contactus',$this->actions) || in_array('replay_contactus',$this->actions) || in_array('delete_contactus',$this->actions)){

            return view('dashboards.contactus.index');
        }else{
            return view('dashboards.no_permistion');
        }
    }



    public function search(Request $request )
    {
        $filter = json_decode(request('filter'));
        $posts = Countact::where('type','message')->where(function ($query) use ($filter) {
            if ($filter->title) {
                $query->where('title', 'like', "%$filter->title%");
            }
            if (isset($filter->start_date) && isset($filter->end_date)) {
                if ($filter->start_date && $filter->end_date) {

                    $published_at = date('Y-m-d H:i:s', strtotime($filter->start_date));
                    $published_to = date('Y-m-d H:i:s', strtotime($filter->end_date));
                    $query->whereBetween('created_at', [$published_at, $published_to]);

                }
            }
            if ($filter->user) {
                $query->where('name', "$filter->user");
            }

        });


       if (request()->has('sort') && request()->sort!='{"fieldName":"created_at","order":"desc"}') {
            $sort = json_decode(request('sort'), true);
            $posts = $posts->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }


        $posts = $posts->orderBy('id', 'DESC')->paginate(25);

        return response()->json(compact('posts'));
    }

    public function delete($id)
    {
        $message=Countact::find($id);

        if($message){

            $message->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));
            }
        }

        public function replay(Request $request){

            $request->validate([
                'message' => 'required',

            ], [], [
                'message' => 'نص الرسالة ',

            ]);
            $replay=Countact::find($request->message_id);
            if($replay){
                $replay->is_replay=1;
                $replay->replay_text=$request->message;
                $replay->save();
                $data=['user_name'=>$replay->name,'msg'=>$request->message];
$setting=Setting::find(1);
                Mail::send('emails.replay_msg',['data'=>$data],function($message) use($replay,$setting){
                    $message->to($replay->email,$replay->name)->subject('رد على- '.$replay->title);
                    $message->from($setting->email,'Pal Times');
                });
            }

            $message = 'تم الإرسال بنجاح';

            return response()->json(compact('message'));


        }

        public function is_read($id){
        $contact=Countact::find($id);
            $contact->is_read=1;
            $contact->save();
            $message = 'تم الإرسال بنجاح';

            return response()->json(compact('message'));
        }

}