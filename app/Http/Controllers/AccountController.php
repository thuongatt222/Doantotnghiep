<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\ForgotAccountRequest;
use App\Http\Requests\Account\LoginAccountRequest;
use App\Http\Requests\Account\ResetAccountRequest;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Mail\ResetPassword;
use App\Mail\VerifyAccount;
use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;

class AccountController extends Controller
{

    public function login()
    {
        return view('Login/index');
    }

    public function check_login(LoginAccountRequest $req)
    {
        $data = $req->only('email', 'password');
        $check = Auth::attempt($data);
        if ($check) {
            $user = Auth::user();
            if ($user->role == 0) {
                return redirect()->route('customer');
            } elseif ($user->role == 1) {
                return redirect()->route('admin');
            }
        }
        flash()->addWarning('Tên đăng nhập hoặc mật khẩu không đúng.');
        return redirect()->route('login');
    }

    public function register()
    {
    }

    public function check_register(StoreAccountRequest $req)
    {
        $data = $req->only('name', 'email');
        $data['avatar'] = 'public/avatar.jpg';
        $data['password'] = bcrypt($req->password);
        if ($acc = User::create($data)) {
            FacadesMail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login');
        }
        return redirect()->back();
    }
    public function verify($email)
    {
        User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->google_id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('customer');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'google_id' => $user->google_id,
                    'role' => 0,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);
                return redirect()->intended('customer');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function profile()
    {

    }

    public function check_profile()
    {

    }
    public function change_password()
    {
        
    }

    public function check_change_password()
    {

    }
    public function check_forgot_password(ForgotAccountRequest $req)
    {
        $data = $req->only('email');
        $account = User::where('email', $data)->first();
        if ($account) {
            FacadesMail::to($account->email)->send(new ResetPassword($account));
        }
        flash()->addError('Tài khoản này không tồn tại.');
        return redirect()->route('account.login');
    }
    public function reset_password(ForgotAccountRequest $req)
    {
        return view('login.changepass', $req);
    }

    public function check_reset_password(ResetAccountRequest $req)
    {
        User::where('email', $req->email)->update(['password' => $req->password]);
        return redirect()->route('account.login');
    }
}
