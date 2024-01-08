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
use Core\Repositories\CustomerRepo;
use Core\Repositories\MerchantRepo;

class AuthController extends Controller
{
    use HandleUpload;
    private $productRepo , $fileService  , $authservice;
    public function __construct( FileService $fileService , AuthService $authService){
        $this->fileService = $fileService ;
        $this->authservice = $authService;
        
    }

    //Registering

    public function adminRegister( AuthRegisterReq $request ){
       return $this->authservice->Registering($request , 'admin' , 'admin' , new AdminRepo);
    }

    public function customerRegister( AuthRegisterReq $request ){
        return $this->authservice->Registering($request , 'customer' , 'customer' , new CustomerRepo);
    }

    public function merchantRegister( AuthRegisterMerchantReq $request , FileService $fileService ){
        return $this->authservice->merchantRegistering($request , 'merchant' , 'merchant' , new MerchantRepo , $fileService);
    }

    // Logining
    public function AdminLogin(Request $request){
        $cred = $this->authservice->validate($request);
        $Entity = EntitiesFactory::createEntity($cred , 'admin');
        return $this->authservice->loginUser(new AdminRepo , $Entity);
    }

    public function customerLogin(Request $request){
        $cred = $this->authservice->validate($request);
        $Entity = EntitiesFactory::createEntity($cred , 'customer');
        return $this->authservice->loginUser(new CustomerRepo , $Entity);
    }

    public function merchantLogin(Request $request){
        $cred = $this->authservice->validate($request);
        $Entity = EntitiesFactory::createEntity($cred , 'merchant');
        return $this->authservice->loginUser(new MerchantRepo , $Entity);
    }

    public function SuperAdminLogin(Request $request){
        
        $cred = $this->authservice->validate($request);

        $Entity = EntitiesFactory::createEntity($cred , 'superadmin');
      
       return $this->authservice->loginUser(new AdminRepo , $Entity);

    }

    //Loging out

    public function logout(Request $request) {
        
        return $this->authservice->logout($request);
    }
    
}
