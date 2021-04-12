<?php

namespace App\Repositories;

use App\User;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }
    public function getUserById($id){
        $user = User::find($id);
        return $user;
    }
    public function getAllUser(){
        $users = User::paginate(10);
        return $users;
    }
}
