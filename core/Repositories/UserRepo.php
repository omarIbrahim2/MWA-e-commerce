<?php
namespace Core\Repositories;
use App\Models\User;
use Core\Interfaces\UserInterface;
use Exception;

use function PHPUnit\Framework\throwException;

abstract class UserRepo implements UserInterface{

   abstract public function getUsers($pages);
    public function getUser($email){
        $user = User::where('email' , $email)->first();
   
        if (! $user) {
   
           throw new Exception('البيانات قد تكون خاطئة ..!!'  , 403);
        }
      
        return $user;
    }
     public function create($data){
        return User::create($data);
     }

    
    abstract public function find($userId);
    abstract public function update($data);
   abstract  public function destroy($userId);

}