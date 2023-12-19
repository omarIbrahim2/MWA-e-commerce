<?php
namespace Core\Repositories;
use App\Models\User;
use Core\Interfaces\UserInterface;


abstract class UserRepo implements UserInterface{

   abstract public function getUsers($pages);
    public function getUser($email){
        $user = User::where('email' , $email)->first();
        if (! $user) {
           return response()->json([
            'email' => "البيانات قد تكون غير صحيحة..!!",
           ], 403);
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