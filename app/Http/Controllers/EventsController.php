<?php

namespace App\Http\Controllers;


use App\Models\Cases;
use App\Models\Events;
use App\Models\EventsUserRemember;
use App\Models\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class EventsController extends Controller
{


    public function index()
    {
        meta('title', 'الأجندة');

        $breadcrumb = breadcrumbs()
            ->add('كافة الأحداث','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_events',$this->actions) || in_array('edit_events',$this->actions) || in_array('delete_events',$this->actions) || in_array('view_events',$this->actions)){

            return view('dashboards.events.index');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', 'إضافة حدث للأجندة');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الأجندة', route('cases.index'))
            ->add(meta('title'));


        meta('breadcrumb', $breadcrumb->render());
       $users=User::where('active',1)->get();
        if(in_array('add_events',$this->actions)){

            return view('dashboards.events.form',compact('users'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
           $this->validate($request, [
            'name'      => 'required|max:255',
             'details'      => 'required',
               'user_id'      => 'required',
               'active'      => 'required',
               'remember_date'      => 'required',

           ], [], [
            'name'      => 'العنوان',
            'details'      => 'التفاصيل',
               'user_id'      => 'المستخدمين',
               'active'      => 'الحالة',
               'remember_date'      => 'تاريخ التذكير',


           ]);

        $event=new Events();
        $event->name=$request->name;
        $event->details=$request->details;
        $event->remember_date=$request->remember_date;
        $event->active=$request->active;
        $event->user_from=auth()->user()->id;
        $event->save();
        $users=$request->user_id;
        foreach ($users as $user){
            $event_user=new EventsUserRemember();
            $event_user->user_id=$user['id'];
            $event_user->event_id=$event->id;
            $event_user->save();
        }

        $message = 'تمت إضافة الحدث بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل حدث للأجندة');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الأجندة', route('cases.index'))
            ->add(meta('title'));
        $event = Events::find($id);
        $event_user=EventsUserRemember::where('event_id',$id)->pluck('user_id')->toArray();
        $users=User::where('active',1)->get();
        $users_add=User::whereIn('id',$event_user)->get();
        meta('breadcrumb', $breadcrumb->render());

        if(in_array('edit_events',$this->actions)){

            return view('dashboards.events.form',compact('event','users_add','users'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function search(Request $request )
    {
        $events = Events::with('users_events.user')->orderBy('id','DESC');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $events = $events->where('name', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $events = $events->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $events = $events->where(function($ss){
            $ss->where('user_from',auth()->user()->id)->orWhereHas('users_events_user');
        })->paginate(15);

        return response()->json(compact('events'));
    }

    public function delete_event($id)
    {
        $event=Events::find($id);

        if($event){
            
          $model_count=EventsUserRemember::where('event_id',$id)->delete();
            $event->delete();
                $message = 'تم الحذف بنجاح';
                return response()->json(compact('message'));
        }
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'details' => 'required',
            'user_id' => 'required',
            'active' => 'required',
            'remember_date' => 'required',

        ], [], [
            'name' => 'العنوان',
            'details' => 'التفاصيل',
            'user_id' => 'المستخدمين',
            'active' => 'الحالة',
            'remember_date' => 'تاريخ التذكير',


        ]);

        $event = Events::find($id);
        $event->name = $request->name;
        $event->details = $request->details;
        $event->remember_date = $request->remember_date;
        $event->active = $request->active;
        $event->save();
        $users = $request->user_id;
        EventsUserRemember::where('event_id',$event->id)->delete();
        foreach ($users as $user) {
            $event_user = new EventsUserRemember();
            $event_user->user_id = $user['id'];
            $event_user->event_id = $event->id;
            $event_user->save();
        }

        $message = 'تمت تعديل الحدث بنجاح';

        return response()->json(compact('message'));
    }
    public function check_event()
    {
        $events=Events::with('users_events_auth')->has('users_events_auth')->get();
      foreach ($events as $ev){
          foreach ($ev->users_events_auth as $user){
             // $user->remember=1;
                $user->save();
          }
      }


        return response()->json(compact('events'));
    }
    public function saw_event(Request $request)
    {
        $event=EventsUserRemember::where('event_id',$request->event_id)->where('user_id',auth()->user()->id)->first();
        $event->remember=1;
        $event->save();
        $message = 'تمت تعديل الحدث بنجاح';

        return response()->json(compact('message'));

    }

    public function remind_later(Request $request)
    {
        $event_lat=EventsUserRemember::where('event_id',$request->event_id)->where('user_id',auth()->user()->id)->first();

        $event=Events::find($request->event_id);
        if($event_lat->remind_later){
            $remind_time=Carbon::parse($event_lat->remind_later);
        }else{
            $remind_time=Carbon::parse($event->remember_date);
        }

        if($request->min_remm){

            $remind_time= $remind_time->addMinutes($request->min_remm);

        }if($request->hour_remm){

            $remind_time=  $remind_time->addHours($request->hour_remm);
        }



        $event_lat->remind_later=$remind_time;
        $event_lat->save();
        $message = 'تمت تعديل الحدث بنجاح';

        return response()->json(compact('message'));

    }




}