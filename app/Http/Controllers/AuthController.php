<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Customer;
use App\Models\Merchant;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\AuthService;
use Core\Services\FileService;
use Core\Repositories\AdminRepo;
use Core\Factories\EntitiesFactory;
use Illuminate\Support\Facades\App;
use App\Http\Requests\AuthRequests\AuthRegisterReq;
use App\Http\Requests\AuthRequests\AuthRegisterCustomerReq;
use App\Http\Requests\AuthRequests\AuthRegisterMerchantReq;

class AuthController extends Controller
{
    use HandleUpload;
    private $productRepo , $fileService  , $authservice;
    public function __construct( FileService $fileService , AuthService $authService){
        $this->fileService = $fileService ;
        $this->authservice = $authService;
        
    }

    public function adminRegister( Request $req ){
        $data = $req->validate([
            "role_id" =>"required",
            "name" => "required|string|min:3|max:50",
            "email"=> "required|email",
            "password"=> "required|confirmed|min:6",
            "phone"=> "min:11",
            "address"=> "string",
        ]);
        $Entity = EntitiesFactory::createEntity($data , 'admin');
        $Entity->setPassword($data['password']);
        $this->authservice->registerUser($Entity , new AdminRepo);
        $admin = User::where('email' , $Entity->getEmail())->first();
        $adminId = $admin->id;
        $adminData = $this->authservice->adminValidate($req);
        $adminData['user_id'] = $adminId;
        dd($adminData) ;
        $admin->admin()->create($adminData);
        return ;
    }


    public function AdminLogin(Request $request){
        $cred = $this->authservice->validate($request);
        $Entity = EntitiesFactory::createEntity($cred , 'admin');
        return $this->authservice->loginUser(new AdminRepo , $Entity);
    }


    public function SuperAdminLogin(Request $request){
        
        $cred = $this->authservice->validate($request);

        $Entity = EntitiesFactory::createEntity($cred , 'superadmin');
      
       return $this->authservice->loginUser(new AdminRepo , $Entity);

    }

    public function logout(Request $request) {
        
        return $this->authservice->logout($request);
    }
    
    // public function register(AuthRegisterReq $request , AuthRegisterMerchantReq $merReq , AuthRegisterCustomerReq $cusReq){
    //     $data = $request->validated();
    //     $data["password"] = bcrypt($data["password"]);
    //     $user = User::create($data);
    //     $data["token"] = $user->createToken("UserToken")->plainTextToken;
    //     $customerRole = Role::where("name" , "Customer")->first() ;
    //     $customerRoleId = $customerRole->id ;
    //     $merchantRole =Role::where("name" , "Merchant")->first() ;
    //     $merchantRoleId = $merchantRole->id ;
    //     if($user->role_id == $customerRoleId ){
    //         $customerData = $cusReq->validated();
    //         $customerData['user_id'] = $user->id ;
    //         $user->customer()->create($customerData);
    //         return response()->json($data, 201);
    //     }elseif ($user->role_id ==  $merchantRoleId) {
    //         $merchantData = $merReq->validated(); 
    //         $merchantData['user_id'] = $user->id ;
    //         $merchantData['img'] = $this->handleUpload($merReq , $this->fileService , null , 'Merchants');
    //         $user->merchant()->create($merchantData);
    //         return response()->json($data, 201);
    //     };

    // }


    
}
