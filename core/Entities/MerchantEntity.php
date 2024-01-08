<?php
namespace Core\Entities;

class MerchantEntity extends UserEntity{
    protected $ROLE_ID = 4;
    public function __construct($attributes)
    {
        // $this->schema['name'] = $attributes['name'];
         $this->schema['email'] = $attributes['email'];
         $this->schema['password'] = $attributes['password'];
        // $this->schema['phone'] = $attributes['phone'];
        // $this->schema['address'] = $attributes['address'];
        //$this->schema['img'] = $attributes['img'];
        $this->path = 'Merchants';
    }
}