<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Customer;
use App\Models\Merchant;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;
use App\Http\Requests\AuthRequests\AuthRegisterReq;
use App\Http\Requests\AuthRequests\AuthRegisterCustomerReq;
use App\Http\Requests\AuthRequests\AuthRegisterMerchantReq;

class AuthController extends Controller
{
    use HandleUpload;
    private $productRepo , $fileService ;
    public function __construct( FileService $fileService ){
        $this->fileService = $fileService ;
    }

    public function register(AuthRegisterReq $request , AuthRegisterMerchantReq $merReq , AuthRegisterCustomerReq $cusReq){
        $data = $request->validated();
        $data["password"] = bcrypt($data["password"]);
        $user = User::create($data);
        $data["token"] = $user->createToken("UserToken")->plainTextToken;
        $customerRole = Role::where("name" , "Customer")->first() ;
        $customerRoleId = $customerRole->id ;
        $merchantRole =Role::where("name" , "Merchant")->first() ;
        $merchantRoleId = $merchantRole->id ;
        if($user->role_id == $customerRoleId ){
            $customerData = $cusReq->validated();
            $customerData['user_id'] = $user->id ;
            $user->customer()->create($customerData);
            return response()->json($data, 201);
        }elseif ($user->role_id ==  $merchantRoleId) {
            $merchantData = $merReq->validated(); 
            $merchantData['user_id'] = $user->id ;
            $merchantData['img'] = $this->handleUpload($merReq , $this->fileService , null , 'Merchants');
            $user->merchant()->create($merchantData);
            return response()->json($data, 201);
        };

    }
}
