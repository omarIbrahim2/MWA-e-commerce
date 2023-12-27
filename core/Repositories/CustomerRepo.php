<?php
namespace Core\Repositories;
use App\Models\Customer;



class CustomerRepo extends UserRepo{

   public function getUsers($pages){}

   public function createCustomer($data){
      return Customer::create($data);
   }
   public function update($data){}
   public function find($userId){}
   public function destroy($userId){}

}