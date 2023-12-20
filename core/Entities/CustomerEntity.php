<?php
namespace Core\Entities;

class CustomerEntity extends UserEntity{

    protected $ROLE_ID = 3;
    public function __construct($attributes)
    {
        $this->schema['user_id'] = $attributes['user_id'];
        $this->path = 'Customers';
    }
}