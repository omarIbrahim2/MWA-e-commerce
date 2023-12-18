<?php
namespace Core\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Core\Entities\UserEntity;
use Core\Interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthService{
    public function registerUser(UserEntity $user , UserInterface $userInterface){
        $createdUser = $userInterface->create($user->getAttributes());
        $user->setToken($createdUser , $createdUser['name']);
        return $createdUser ;
    }

    public function logout(){
        $user = Auth::user();
        Auth::tokens()->where($user->id, 'tokenable_Id')->delete();
        return Auth::logout();
    }

    public function loginUser(Request $request , $credentials){
        $request->validate([
            "email" => "required|email",
            "password" => 'required',
         ]);
         $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $this->ensureIsNotRateLimited($request);  
        $remember_me = $request->has('remember_me') ? true : false;
        if (!Auth::attempt($credentials , $remember_me)) {     
            RateLimiter::hit($this->throttleKey($request->email , $request->ip)); 
            throw ValidationException::withMessages([
                "email" =>'auth.failed',
            ]);
        }
        RateLimiter::clear($this->throttleKey($request->email , $request->ip));

        return $user->setToken($user , $user->name);
    }

    public function AdminCredentials(Request $request){

        return [
            'email' => $request->email,
            'password' => $request->password
        ];
    }

    public function Credentials(Request $request){
        return [
            'email' => $request->email,
            'password' => $request->password,
            'status' => true,
        ];
    }



    public function throttleKey($email , $ip){
        return Str::lower($email). '|' . $ip; 
    }


    public function ensureIsNotRateLimited(Request $request){

        if ( ! RateLimiter::tooManyAttempts($this->throttleKey($request->email , $request->ip) , 5)) {
            return;
        }
        $seconds = RateLimiter::availableIn($this->throttleKey($request->email , $request->ip));
        throw ValidationException::withMessages([
            "email" => 'auth.throttle' , [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ],
        ]);
    }
}