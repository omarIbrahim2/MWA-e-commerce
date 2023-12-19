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

    public function loginUser(UserInterface $userInterface , UserEntity $user){
       
        $userModel = $userInterface->getUser($user->getEmail());

        if (!Auth::attempt(["email" => $user->getEmail() ,"password" => $user->getPassword()], $userModel->role_id == $user->getRoleId())) {     
            throw ValidationException::withMessages([
                "email" =>'البيانات قد تكون غير صحيحة..!!',
            ]);
        }

        $token = $user->setToken($userModel , $userModel->name);

        return response()->json([
            'token' => $token,
        ] , 201);
    }

    

    public function validate(Request $request){

        return $request->validate([
            "email" => "required|email",
            "password" => 'required',
         ]);
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