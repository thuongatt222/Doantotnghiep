<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\ForgotAccountRequest;
use App\Http\Requests\Account\LoginAccountRequest;
use App\Http\Requests\Account\ResetAccountRequest;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Mail\ResetPassword;
use App\Models\Cart;
use App\Mail\VerifyAccount;
use App\Models\PasswordResetToken;
use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verifyEmail', 'redirectToGoogle', 'handleGoogleCallback']]);
    }

    //register
    public function register(StoreAccountRequest $request)
    {
        $data = $request->only('name', 'email');
        $data['password'] = Hash::make($request->password);
        $data['role'] = 0;
        $data['status'] = 1;
        $data['avatar'] = 'avatar.jpg';
        $user = User::create($data);

        // Send verification email
        if ($user) {
            try {
                FacadesMail::to($user->email)->send(new VerifyAccount($user));
                $cart = new Cart();
                $cart->user_id = $user->user_id;
                $cart->save();
                return response()->json(['message' => 'Đăng ký thành công! Vui lòng kiểm tra email để xác minh tài khoản của bạn.'], 200);
            } catch (\Exception $e) {
                $user->delete();
                return response()->json([
                    'message' => 'Không thể gửi email, vui lòng thử lại.'
                ], 500);
            }
        }
        return response()->json(['message' => 'Tạo tài khoản bị lỗi.'], 500);
    }
    //verify Email
    public function verifyEmail(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            return response()->json(['message' => 'url không hợp lệ/hết hạn được cung cấp'], 401);
        }
        $user = User::where('user_id', $id)->firstOrFail();
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        } else {
            return response()->json(['message' => 'Email đã được xác nhận.'], 400);
        }
        // return response()->json(['message' => 'Email xác nhận thành công!'], 200);
        return redirect()->to(env('URL_CUSTOMER'));
    }
    // login with google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'name' => $user->name,
                        'google_id' => $user->id,
                        'role' => 0,
                        'avatar' => 'public/avatar.jpg',
                        'password' => encrypt('123456dummy')
                    ]
                );

                Auth::login($newUser);
            }

            // Return Google access token and user data to the frontend
            return response()->json([
                'access_token' => $user->token,
                'token_type' => 'Bearer',
                'user' => Auth::user()
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    //login
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function check_forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
        ]);
        $user = User::where('email', $request->email)->first();
        $token = \Str::random(100);
        $tokenData = [
            'token' => $token,
            'email' => $request->email,
        ];
        if (PasswordResetToken::create($tokenData)) {
            FacadesMail::to($request->email)->send(new ResetPassword($user, $token));
            return response()->json(['message' => 'Kiểm tra email để tiếp tục'], 200);
        }
        return response()->json(['message' => 'Đã xảy ra lỗi, vui lòng kiểm tra lại.'], 500);
    }
    public function reset_password(Request $request, $token)
    {
        $request->validate(['password' => 'require|min:6|confirmed']);
        $tokenData = PasswordResetToken::checkToken($token);
        $user = $tokenData->user;
        $data = [
            'password' => bcrypt($request->password),
        ];
        $check = $user->update($data);
        if ($check) {
            return response()->json(['message' => 'Cập nhật mật khẩu thành công.'], 200);
        }
        return response()->json(['message' => 'Đã xảy ra lỗi, vui lòng kiểm tra lại.'], 500);
    }
}
