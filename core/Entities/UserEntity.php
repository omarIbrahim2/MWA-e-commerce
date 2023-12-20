<?php
namespace Core\Entities;

use App\Models\User;
use App\Traits\HandleUpload;
use Core\Services\FileService;
use Illuminate\Support\Facades\Hash;

abstract class UserEntity{
    use HandleUpload;
    protected $schema = array() , $status = false , $path ;
    protected $ROLE_ID = 0;
    public function __construct($attributes)
    {
        $keysAttributes = array_keys($attributes);
        array_map(function($key , $value){
            $this->schema[$key] = $value;
        } , $keysAttributes , $attributes);

    }

    public function changeStatus(){
        if($this->status == true){
            $this->status = false;
        }else{
            $this->status = true;
        }
        $this->schema['status'] = $this->status;
    }
    
    public function setPassword($password){
        $hashedPassword = Hash::make($password);
        $this->schema['password'] = $hashedPassword;
    }

    public function UploadImage( FileService $fileService ,$request){
        $imagePath =  $this->handleUpload($request , $fileService , null , $this->path);
        $this->schema['image'] = $imagePath;
    }

    public function setImage($ImageName){
        $this->schema['image'] = $ImageName;
    }

    public function setToken($user , $userName) {
       return $user->createToken("$userName Token")->plainTextToken;
    }

    public function getAttributes(){
        return $this->schema;
    }
  
    public function getEmail(){
        return $this->schema['email'];
    }
  
    public function getPassword()
    {
        return $this->schema['password'];
    }


    public function getRoleId(){

        return $this->ROLE_ID;
    }




}