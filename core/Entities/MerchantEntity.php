<?php
namespace Core\Entities;

class MerchantEntity extends UserEntity{
    protected $ROLE_ID = 4;
    public function __construct($attributes)
    {
        $this->schema['user_id'] = $attributes['user_id'];
        $this->path = 'Merchants';
    }
}