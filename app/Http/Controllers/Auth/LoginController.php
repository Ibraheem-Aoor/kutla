<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RecorderLogin;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function credentials(Request $request)
    {
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return [$field => $request->{$this->username()}, 'password' => $request->password, 'status' => 1];
    }

    public function showAdminLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (\request()->method() == "GET"){
            return view('auth.login');
        }

        $validator = Validator::make(\request()->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator->messages());
        }
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email',$email)->first();
        if(isset($user)){
            if (Hash::check($password,$user->password)){
                if ($user->active){
                    Auth::loginUsingId($user->id);
                    return redirect('/dashboard');
                }
//                return redirect('/login')->withErrors([422 => "تم الغاء تفعيل حسابك من قبل الادارة"]);
                return redirect()->route('adminLogin')->withErrors("تم الغاء تفعيل حسابك من قبل الادارة");
            }

        }
        return redirect()->route('adminLogin')->withErrors("البريد الالكتروني او كلمة المرور غير صحيحة");
//        return redirect('/login')->withErrors([422 => "البريد الالكتروني او كلمة المرور غير صحيحة"]);

       /* $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->input('email')]);*/
       /* if (auth()->guard()->attempt($credentials,false))
        {
            $userStatus = \auth()->guard()->user()->active;
            if($userStatus == 0 ){
                \auth()->guard()->logout();
                return redirect('login')->withErrors([422 => "تم الغاء تفعيل حسابك من قبل الادارة"]);
            }
            return redirect('dashboard');
        }
        return redirect('login')->withErrors([422 => "البريد الالكتروني او كلمة المرور غير صحيحة"]);*/

        //////////////////////////////////////////
        /*$email = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');

        $credentials['email'] = $email;
        $credentials['password'] = $password;
        ///////////////////////////////

        if (!Auth::guard()->attempt($credentials,$remember))
        {
            return redirect('login')->withErrors([422 => "البريد الالكتروني او كلمة المرور غير صحيحة"]);
        }

        $userStatus = \auth()->guard()->user()->active;
        if($userStatus == 0 ){
            \auth()->guard()->logout();
            return redirect('login')->withErrors([422 => "تم الغاء تفعيل حسابك من قبل الادارة"]);
        }

        return redirect('dashboard');*/
    }
    public function logout(Request $request)
    {
//        $recorder=RecorderLogin::where('user_id',auth()->user()->id)->where('event_date',date('Y-m-d'))->whereNull('logout_time')->orderby('id','DESC')->first();
//
//        if($recorder){
//            $start=$recorder->event_date.' '.$recorder->login_time;
//            $startTime = Carbon::parse($start);
//            $finishTime = Carbon::parse(date("Y-m-d H:i:s"));
//            $totalDuration = $finishTime->diffInMinutes($startTime);
//            $recorder->logout_time=date("H:i:s");
//            $recorder->duration=$totalDuration;
//            $recorder->save();
//        }
        $this->guard()->logout();

        $request->session()->invalidate();
        if($request->ajax()) {
            return;
        }
        return redirect('/login');
    }
}
