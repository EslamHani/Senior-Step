<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\SocialAccount;
use App\Models\User;
use Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    public function authenticated(Request $request, $user){
        if(!$user->verified){
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }

        return redirect()->intended($this->redirectPath());
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        $provider = Socialite::driver('facebook')->stateless()->user();
        $account = SocialAccount::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if($account){
            $user = $account->user;
        }else{
            $akun = new SocialAccount([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook',
            ]);
            $orang = User::where('email', $provider->getEmail())->first();
            if(!$orang){
                //$imageUser = $provider->getAvatar()->store('users');
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'image' => $provider->getAvatar(),
                    'password' => '',
                    'verified' => '1'
                ]);
            }
            $akun->user()->associate($orang);
            $akun->save();
            $user = $orang;
        }

        auth()->login($user);
        return redirect()->to('/home');
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $provider = Socialite::driver('google')->stateless()->user();
        $account = SocialAccount::where('provider', 'google')->where('provider_user_id', $provider->getId())->first();
        if($account){
            $user = $account->user;
        }else{
            $akun = new SocialAccount([
                'provider_user_id' => $provider->getId(),
                'provider' => 'google',
            ]);
            $orang = User::where('email', $provider->getEmail())->first();
            if(!$orang){
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'image' => $provider->getAvatar(),
                    'password' => '',
                    'verified' => '1',
                ]);
            }
            $akun->user()->associate($orang);
            $akun->save();
            $user = $orang;
        }
        auth()->login($user);
        return redirect()->to('/home');   
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->remember == 1 ? true : false;

        if(auth()->attempt(['email' => $input['email'], 'password' => $input['password']], $remember))
        {
            if(auth()->user()->permission == 1)
            {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')
                            ->with('error', 'Email and Password are wrong, try again please');
        }
    }

}
