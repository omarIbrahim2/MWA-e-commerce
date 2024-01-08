<?php
namespace Core\Factories;

use Core\Entities\AdminEntity;
use Core\Entities\CustomerEntity;
use Core\Entities\MerchantEntity;
use Core\Entities\SuperAdminEntity;

class EntitiesFactory{
    public static function createEntity($attributes , $entity ){
        if ($entity == 'admin') {
            return new AdminEntity($attributes);
        }
        if ($entity == 'customer') {
            return new CustomerEntity($attributes);
        }
        if ($entity == 'merchant') {
            return new MerchantEntity($attributes);
        }
        if ($entity == "superadmin"){
            return new SuperAdminEntity($attributes);
        }
    }
}