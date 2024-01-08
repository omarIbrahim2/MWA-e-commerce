<?php
namespace Core\Repositories;
use App\Models\Merchant;



class MerchantRepo extends UserRepo{

   public function getUsers($pages){}

   public function createMerchant($data){
      return Merchant::create($data);
   }
   public function update($data){}
   public function find($userId){}
   public function destroy($userId){}

}