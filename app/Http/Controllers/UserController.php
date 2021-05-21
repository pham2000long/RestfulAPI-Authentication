<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $users = $this->userRepository->getAll();
        return response($users,201);
    }

    public function getUserById($id){
        $user = $this->userRepository->find($id);
        if(is_null($user)){
            return response()->json([
                'error'=>'Don\'t have this user'
            ],404);
        }
        return response()->json($user,200);
    }

    public function createUser(Request $request){
        $data = $request->all();
        $user = $this->userRepository->create($data);
        return response($user,201);
    }

    public function updateUser(Request $request, $id){
        $data = $request->all();
        $user = $this->userRepository->find($id);
        if(is_null($user)){
            return response()->json([
                'error'=>'Don\'t have this user'
            ],404);
        }

        $user = $this->userRepository->update($id, $data);

        if($user){
            return response()->json([
                'message'=>'updated succesfully'
            ]);
        }
        return response()->json([
            'error'=>'Not updated'
        ],404);

    }

    public function deleteUser($id){

        $user = $this->userRepository->find($id);
        if(is_null($user)){
            return response()->json([
                'error'=>'Don\'t have this user'
            ],404);
        }
        $user = $this->userRepository->find($id);
        return response()->json([
            'success'=>'Deleted Successful'
        ],404);
    }

}
