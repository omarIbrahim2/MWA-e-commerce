<?php
namespace Core\Repositories;
use App\Models\Admin;



class AdminRepo extends UserRepo{

   public function getUsers($pages){

   }

   public function createAdmin($data){
      return Admin::create($data);
   }

   public function update($data){

   }

   public function find($userId){

   }

   public function destroy($userId){

   }

}
