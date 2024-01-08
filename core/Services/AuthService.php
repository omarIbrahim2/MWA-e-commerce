<?php
namespace Core\Services;


use App\Models\User;
use App\Models\Merchant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Core\Entities\UserEntity;
use Core\Repositories\AdminRepo;
use Core\Interfaces\UserInterface;
use Core\Factories\EntitiesFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthRequests\AuthRegisterReq;
use App\Http\Requests\AuthRequests\AuthRegisterMerchantReq;

class AuthService{
    
    public function registerUser(UserEntity $user , UserInterface $userInterface){
        $createdUser = $userInterface->create($user->getAttributes());
        return $createdUser;
    }

    public function Registering(Request $request , $userType , $relation , $repo){
        $data = $request->validated();
        $Entity = EntitiesFactory::createEntity($data , $userType);
        $Entity->setPassword($data['password']);
        $user = $this->registerUser($Entity , $repo);
        $token = $user->createToken("$user->name Token")->plainTextToken;
        $user->$relation()->create();
        return response()->json([
            'massage' => 'تم تسجيل الحساب بنجاح ..!!',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function merchantRegistering(Request $request , $userType , $relation , $repo , FileService $fileService){
        $data = $request->validated();
        $Entity = EntitiesFactory::createEntity($data , $userType);
        $Entity->setRoleId();
        $Entity->setPassword($data['password']);
        $Entity->UploadImage($fileService ,$request);
        $data['img'] = $Entity->setImage($data['img']);
        $user = $this->registerUser($Entity , $repo);
        $token = $user->createToken("$user->name Token")->plainTextToken;
        $user->$relation()->create();
        return response()->json([
            'massage' => 'تم تسجيل الحساب بنجاح ..!!',
            'token' => $token,
            'user' => $user,
        ]);
    }


    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => "تم الخروج..!!"
        ]);
    }

    public function loginUser(UserInterface $userInterface , UserEntity $user){
       
        try {
            $userModel = $userInterface->getUser($user->getEmail());
        } catch (\Exception $e) {
             return response()->json([
                'email' => $e->getMessage()
             ]);
        }
    
        if (!Auth::attempt(["email" => $user->getEmail() ,"password" => $user->getPassword()], $userModel->role_id == $user->getRoleId())) {     
            throw ValidationException::withMessages([
                "email" =>'البيانات قد تكون غير صحيحة..!!',
            ]);
        }

        $token = $user->setToken($userModel , $userModel->name);

        return response()->json([
            'token' => $token,
            'user' => $userModel,
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