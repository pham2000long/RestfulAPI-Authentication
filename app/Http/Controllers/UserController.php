<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(),200);
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
