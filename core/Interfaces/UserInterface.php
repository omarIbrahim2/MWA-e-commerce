<?php
namespace Core\Interfaces;

interface UserInterface{
    public function getUsers($pages);
    public function getUser($email);
    public function create($data);
    public function find($userId);
    public function update($data);
    public function destroy($userId);

}