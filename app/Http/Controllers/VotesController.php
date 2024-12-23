<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Vote;
use App\Models\VoteAnswer;
use App\Models\Votes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class VotesController extends Controller
{


    public function index()
    {
        meta('title', 'الاستفتاءات');

        $breadcrumb = breadcrumbs()
            ->add('الاستفتاءات','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_vote',$this->actions) || in_array('edit_vote',$this->actions) || in_array('delete_vote',$this->actions) || in_array('view_vote',$this->actions)){

            return view('dashboards.votes.index');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function create()
    {

        meta('title', ' إضافة استفتاء');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الاستفتاءات', route('votes.index'))
            ->add(meta('title'));
        $categories = Category::where('type', 'votes')->get();


        meta('breadcrumb', $breadcrumb->render());

        if(in_array('add_vote',$this->actions)){

            return view('dashboards.votes.form',compact('categories'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
           $this->validate($request, [
            'name'      => 'required|max:255',
               'answers'      => 'required',
              // 'type'      => 'required',
               'active'      => 'required',
               'start_date'      => 'required',
               'end_date'      => 'required',

           ], [], [
            'name'      => ' عنوان الاستفتاء',
             'answers'      => 'الخيارات',
               'type'      => 'النوع',
               'active'      => 'حالة الاستفتاء',
               'start_date'      => 'تاريخ البداية',
               'end_date'      => 'تاريخ النهاية',



           ]);
           $has_erro=false;
        $answers=$request->answers;
        if(count($answers)<2){
            $has_erro=true;
        }else{
            for($i=0;$i<count($answers);$i++){
                if(!$answers[$i]['name']){
                    $has_erro=true;
                }
            }
        }

if($has_erro){
    $message = 'الرجاء التأكد من قيم خيارات الاستفتاء';

    return response()->json(compact('message'),404);
}

        $vote=new Vote();
        $vote->name=$request->name;
        $vote->details=$request->details;
        $vote->photo_id=$request->photo_id;
        $vote->type=$request->type;
        $vote->category_id=$request->category_id;
        $vote->active=$request->active;
        $vote->start_date=$request->start_date;
        $vote->end_date=$request->end_date;
        $vote->save();

        $answers_image=$request->answer_image;
        for($i=0;$i<count($answers);$i++){
        $anse=new VoteAnswer();
            $anse->name=$answers[$i]['name'];
            $anse->photo_id=$answers_image[$i];
            $anse->vote_id=$vote->id;
            $anse->save();
        }

        $message = 'تمت إضافة الملف بنجاح';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل الاستفتاء');
        $vote=Vote::with('Category','answers.photo')->find($id);
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الاستفتاءات', route('votes.index'))
            ->add(meta('title'));
        $categories = Category::where('type', 'votes')->get();

        meta('breadcrumb', $breadcrumb->render());


        if(in_array('edit_vote',$this->actions)){

            return view('dashboards.votes.form',compact('vote','categories'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function search(Request $request )
    {
        $votes = Vote::with('Category');

        if(request()->has('filter')) {
            if($request->filter!=''){
                $filter = request('filter');
                $votes = $votes->where('name', 'LIKE', "%$filter%");

            }
        }


        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $votes = $votes->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $votes = $votes->orderBy('id','DESC')->paginate(15);

        return response()->json(compact('votes'));
    }

    public function delete_vote($id)
    {
        $vote=Vote::find($id);

        if($vote){
            
            $vote->answers()->delete();
            $vote->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));

        }
        return response()->json(compact('فشل'),404);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'answers'      => 'required',
            // 'type'      => 'required',
            'active'      => 'required',
            'start_date'      => 'required',
            'end_date'      => 'required',

        ], [], [
            'name'      => ' عنوان الاستفتاء',
            'answers'      => 'الخيارات',
            'type'      => 'النوع',
            'active'      => 'حالة الاستفتاء',
            'start_date'      => 'تاريخ البداية',
            'end_date'      => 'تاريخ النهاية',



        ]);

        $vote=Vote::find($id);
        $vote->name=$request->name;
        $vote->details=$request->details;
        $vote->photo_id=$request->photo_id;
        $vote->type=$request->type;
        $vote->category_id=$request->category_id;
        $vote->active=$request->active;
        $vote->start_date=$request->start_date;
        $vote->end_date=$request->end_date;
        $vote->save();
        $answers=$request->answers;
        $answers_image=$request->answer_image;
        VoteAnswer::where('vote_id',$id)->delete();
        for($i=0;$i<count($answers);$i++){
            $anse=new VoteAnswer();
            $anse->name=$answers[$i]['name'];
            $anse->photo_id=$answers_image[$i];
            $anse->vote_id=$vote->id;
            $anse->save();
        }
    }
    public function details(Request $request)
    {

        $vote = Vote::with('answers')->find($request->vote_id);
        $answer_count = VoteAnswer::where('vote_id', $request->vote_id)->sum('answer_count');
        $html="";
        foreach ($vote->answers as $answer){
        if ($answer_count > 0) {
            $get_rasio = ($answer->answer_count / $answer_count) * 100;
            $get_rasio = number_format((float)$get_rasio, 1, '.', '');
        } else {
            $get_rasio = 0;
        }
            $html.= '<tr><th>'.$answer->name.'</th><th>'.$answer->answer_count.'</th><th>'.$get_rasio.'</th></tr>';
        }
        $html.= '<tr><th>إجمالي المصوتي</th><th>'.$answer_count.'</th><th></th></tr>';
        return response()->json(compact('vote','html','answer_count'));
    }

}