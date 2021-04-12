<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $users = $this->userRepository->getAllUser();
        $users = UserResource::collection($users);
        return response($users,201);
    }

    public function getUserById($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json([
                'error'=>'Don\'t have this user'
            ],404);
        }
        return response()->json($user::find($id),200);
    }

    public function createUser(Request $request){
        $user = User::create($request->all());
        return response($user,201);
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json([
                'error'=>'Don\'t have this user'
            ],404);
        }
        $user->update($request->all());
        return response()->json([
            'message'=>'updated succesfully'
        ]);
    }

    public function deleteUser(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json([
                'error'=>'Don\'t have this user'
            ],404);
        }
        $user->delete();
        return response()->json([
            'message'=>'deleted succesfully'
        ]);
    }

}
