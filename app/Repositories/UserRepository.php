<?php

namespace App\Repositories;

use App\User;
//use Your Model
use App\Repositories\UserRepositoryInterface;
use App\Http\Resources\UserResource;


/**
 * Class UserRepository.
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function getAll(){
        $users = UserResource::collection(User::paginate(10));
        return $users;
    }

    public function find($id){
        $user = new UserResource(User::find($id));
        return $user;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
