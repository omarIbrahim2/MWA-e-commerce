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

    // public function register(AuthRegisterReq $request , AuthRegisterMerchantReq $merReq , AuthRegisterCustomerReq $cusReq){
    //     $data = $request->validated();
    //     $data["password"] = bcrypt($data["password"]);
    //     $user = User::create($data);
    //     $data["token"] = $user->createToken("UserToken")->plainTextToken;
    //     if($user->role_id == Role::where("name" , "Customer")->first->id ){
    //         $customerData = $cusReq->validated();
    //         Customer::create($customerData);
    //         return response()->json($data, 201);
    //     }elseif ($user->role_id == Role::where("name" , "Merchant")->first->id ) {
    //         $merchantData = $merReq->validated(); 
    //         $merchantData['img'] = $this->handleUpload($request , $this->fileService , null , 'Merchants');
    //         Merchant::create($merchantData);
    //         return response()->json($data, 201);
    //     };

    // }
}
