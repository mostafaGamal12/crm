<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\ForgetPassword;
use App\Models\FcmToken;
use App\Models\User;
use App\Services\FcmService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'resetPassword', 'changePassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password'], Request()->remember);
        // try {

        if (!$token = auth()->attempt($credentials)) {
            return $this->fail_response(__("Unauthorized"), 401);
        }
        if (Auth::user()->active == 0) {
            auth()->logout();
            return $this->fail_response(__("InActive Account"), 403);
        }
        if (Request()->filled('token')) {
            if (!(FcmToken::where('token', Request()->token)->first())) {
                FcmToken::create([
                    'user_id' => auth()->id(),
                    'token' => Request()->token,
                    'device_type' => Request()->device_type,
                ]);
            }
        }
        if (Auth::user()->first_login == 0) {
            $token = Str::random(64);
            DB::table('password_resets')->where('email', Request()->email)->delete();
            DB::table('password_resets')->Insert([
                'email' => Request()->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            return $this->success_response(__('Change your Password First'), ['email' => Auth::user()->email, 'reset_token' => $token], 406);
        }
        return $this->success_response(__('Success'), ['user' => Auth::user(), 'token' => $token]);
        // } catch (\Throwable $th) {
        //     return $this->fail_response(__("Some thing is wring"), 400);
        // }
    }

    public function resetPassword()
    {
        Request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
        ]);
        try {
            $token = Str::random(64);
            DB::table('password_resets')->where('email', Request()->email)->delete();
            DB::table('password_resets')->Insert([
                'email' => Request()->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $user = User::where('email', Request()->email)->first();

            Mail::to(Request()->email)->send(new ForgetPassword(Request()->url . '?reset_token=' . $token,  $user));
            return $this->success_response(__('Success'), [], 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    public function changePassword()
    {
        Request()->validate([
            'reset_token' => ['required', 'string', 'max:255', 'exists:password_resets,token'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        try {
            $result =  DB::table('password_resets')->where('token', Request()->reset_token)->first();
            if (!$result) {
                return $this->fail_response(__("Not Found"));
            }
            $user = User::where('email', $result->email)->first();
            $user->password = Hash::make(Request()->password);
            if ($user->first_login == 0) {
                $user->first_login = 1;
            }
            $user->save();
            DB::table('password_resets')->where('token', Request()->reset_token)->delete();
            return $this->success_response(__('Success'), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = User::find(Auth::id());
        return $this->success_response(__('Success'), new UserResource($user));
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
        return $this->respondWithToken(auth()->refresh());
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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}