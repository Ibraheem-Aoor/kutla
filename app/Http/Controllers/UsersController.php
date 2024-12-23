<?php

namespace App\Http\Controllers;

use App\Models\ActionRole;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use File;
use DB;

class UsersController extends Controller
{


    public function create_user()
    {
        meta('title', 'إضافة مستخدم');

        $breadcrumb = breadcrumbs()
            ->add('المستخدمين', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        $roles = Role::get();
        if(in_array('add_user',$this->actions) ){

            return view('dashboards.users.add_user', compact('roles'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function edit_user($id)
    {
        meta('title', 'تعديل مستخدم');

        $breadcrumb = breadcrumbs()
            ->add('المستخدمين', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        $roles = Role::get();
        $user = User::with('Role')->find($id);
        if(in_array('edit_user',$this->actions) || auth()->user()->id==$id){

            return view('dashboards.users.add_user', compact('roles', 'user'));
        }else{
            return view('dashboards.no_permistion');
        }
    }


    public function add_user(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            //'mobile' => 'required|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
        ], [], [
            'name' => 'اسم المستخدم',
            'role' => 'مجموعة الصلاحيات',
            'password' => 'كلمة المرور'
        ]);
        $avatar_url=null;
        if($request->photo) {
            $avatar_url = saveBase64Image($request->photo, 'users');
        }

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'role_id' => $request->role,
            'photo' => $avatar_url,
            'password' => \Hash::make($request->password),
        ]);


        $message = 'تمت إضافة مستخدم جديد.';

        return response()->json(compact('message'));
    }

    public function update_user(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            //'mobile' => 'required|unique:users,mobile,'. $user->id,
            'email' => 'required|email|unique:users,email,'. $user->id,
            'role' => 'required'
        ], [], [
            'name' => 'اسم المستخدم',
            'role' => 'مجموعة الصلاحيات'
        ]);
        if($request->photo) {
            $avatar_url = saveBase64Image($request->photo, 'users');
        }
        if ($user) {
            $file1=public_path().'/'.$user->photo;
            $file2=public_path().'/'.$user->thump;
            File::delete($file1,$file2);

            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->role_id = $request->role;
            if($request->photo) {
                $user->photo = $avatar_url;
            }
            if($request->password){
                $user->password = \Hash::make($request->password);
            }
            $user->save();

        }


        $message = 'تم تعديل بيانات المستخدم بنجاح';

        return response()->json(compact('message'));
    }

    public function users()
    {
        meta('title', 'المستخدمين');

        $breadcrumb = breadcrumbs()
            ->add('المستخدمين', '#', 'icon-home')
            ->add(meta('title'));
        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_user',$this->actions) || in_array('edit_user',$this->actions) || in_array('delete_user',$this->actions) || in_array('view_user',$this->actions)){

            return view('dashboards.users.index');
        }else{
            return view('dashboards.no_permistion');
        }
    }

    public function roles()
    {
        meta('title', 'مجموعات المستخدمين');

        $breadcrumb = breadcrumbs()
            ->add('مجموعات المستخدمين', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

       // return view('dashboards.users.roles');

        if(in_array('add_user',$this->actions) || in_array('edit_user',$this->actions) || in_array('delete_user',$this->actions) || in_array('view_user',$this->actions)){

            return view('dashboards.users.roles');
        }else{
            return view('dashboards.no_permistion');
        }
    }

    public function search_users(Request $request)
    {
        $users = User::with('Role')->orderBy('id', 'DESC');

        if (request()->has('filter')) {
            if ($request->filter != '') {
                $filter = request('filter');
                $users = $users->where('name', 'LIKE', "%$filter%");

            }
        }

        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $users = $users->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }
        $users = $users->paginate(15);

        return response()->json(compact('users'));
    }


    public function search_roles(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC');

        if (request()->has('filter')) {
            if ($request->filter != '') {
                $filter = request('filter');
                $roles = $roles->where('name', 'LIKE', "%$filter%");

            }
        }

        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $roles = $roles->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }
        $roles = $roles->paginate(15);

        return response()->json(compact('roles'));
    }

    public function delete_roles($id)
    {
        $role = Role::find($id);

        if ($role) {
            $role_user = User::where('role_id', $id)->count();
            if ($role_user > 0) {
                $message = 'لا يمكن حذف المجموعة لاحتواء عدد من المستخدمين. الرجاء حذف المستخدمين اولا';

                return response()->json(compact('message'), 404);
            } else {
                $role->delete();
                $message = 'تم الحذف بنجاح';

                return response()->json(compact('message'));
            }

        }
    }

    public function store_roles(Request $request)
    {
        $request->validate([
            'name' => 'required',


        ], [], [
            'name' => 'اسم المجموعة ',


        ]);

        Role::create([
            'name' => $request->name
        ]);


        $message = 'تم الإضافة بنجاح.';

        return response()->json(compact('message'));
    }

    public function update_role(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [], [
            'name' => 'اسم المجموعة ',
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $message = 'تم التعديل بنجاح.';

        return response()->json(compact('message'));
    }

    public function privilege_roles($id)
    {
        $role = Role::find($id);
        meta('title', 'الصلاحيات');
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('المجموعات', route('users.roles'))
            ->add($role->name);

        meta('breadcrumb', $breadcrumb->render());

        $actions = ActionRole::where('role_id', $id)->whereNull('user_id')->pluck('name')->toArray();
        //return view('dashboards.users.action_role', compact('role', 'actions'));
        if(in_array('add_user',$this->actions) || in_array('edit_user',$this->actions)){

            return view('dashboards.users.action_role', compact('role', 'actions'));
        }else{
            return view('dashboards.no_permistion');
        }
    }


    public function add_privilege(Request $request)
    {

        $request->validate([
            'privilege' => 'required',


        ], [], [
            'privilege' => 'الصلاحيات',


        ]);
        $privilege = $request->privilege;
        if($request->user_id){

            ActionRole::where('role_id', $request->role)->where('user_id',$request->user_id)->delete();

        }else{
            ActionRole::where('role_id', $request->role)->whereNull('user_id')->delete();

        }
        for ($x = 0; $x < count($privilege); $x++) {
            if ($privilege[$x][array_keys($privilege[$x])[0]]) {
                if($request->user_id) {

                        ActionRole::create([
                            'name' => array_keys($privilege[$x])[0],
                            'role_id' => $request->role,
                            'user_id' => $request->user_id
                        ]);


                }else{
                    ActionRole::create([
                        'name' => array_keys($privilege[$x])[0],
                        'role_id' => $request->role
                    ]);
                }
            }

        }

        $message = 'تم الإضافة بنجاح.';

        return response()->json(compact('message'));
    }

    public function user_privilege($id)
    {
        $user=User::find($id);
        $role = Role::find($user->role_id);
        meta('title', 'الصلاحيات');
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('المستخدمين', route('users.index'))
            ->add($role->name);

        meta('breadcrumb', $breadcrumb->render());


        $actions0 = ActionRole::where('role_id', $user->role_id)->whereNull('user_id')->pluck('name')->toArray();
        $actions1 = ActionRole::where('role_id', $user->role_id)->where('user_id',$id)->pluck('name')->toArray();

        if(!empty($actions1)){
            $actions=$actions1;
        }else{
            $actions=$actions0;
        }

        if(in_array('add_user',$this->actions) || in_array('edit_user',$this->actions)){

            return view('dashboards.users.action_role', compact('role', 'actions','user'));
        }else{
            return view('dashboards.no_permistion');
        }
    }


}