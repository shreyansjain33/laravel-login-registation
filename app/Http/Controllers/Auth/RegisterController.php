<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Mail\VerifyMail;
use App\User;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|confirmed|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'captcha' => 'required|captcha'
        ]);
    }

    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        	'act' => str_random(48),
        ]);

        try {
            $mailcheck = Mail::to($user->email)->send(new VerifyMail($user));

            return redirect('/login')->with('status','Check you email to Complete Registration.');
        } catch (Exception $ex) {
            return redirect('/login')->with('warning',$ex);
        }
    }

    public function verifyUser($token) {
        $user = User::where('act', $token)->first();
    	if(isset($user)) {
            if(!$user->verified) {
                $user->verified = 1;
                $user->save();
                $status = "E-mail verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        }
        else {
            return redirect('/login')->with('warning', "Sorry! Your email can not be identified.");
        }
        return redirect('/login')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'You need to verify your email. Check your mailbox.');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);
        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());

        return redirect($this->redirectPath());
    }

}
