<?php
namespace Core\Repositories;
use App\Models\Customer;
use App\Models\User;

class CustomerRepo extends UserRepo{

   public function getUsers($pages){
      return  Customer::with("user")->paginate($pages);
   }

   public function createCustomer($data){
      return Customer::create($data);
   }
   public function find($userId){}
   public function update($data){}
   public function destroy($userId){}

}