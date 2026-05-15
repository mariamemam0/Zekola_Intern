<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(),200);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user,201);

    }

    public function show(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'message' => 'User not found'
            ],404);
        }

        return response()->json($user,200);
    }


    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'message' => 'User not found'
            ],404);
        }
        $user->update($request->all());
        return response()->json($user,200);

    }

    public function destroy(string $id)
    {

        $user = User::find($id);
        $user->delete();
    }
}
