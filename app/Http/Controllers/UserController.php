<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve all users
        $users = Users::all();
        return response()->json($users);
    }
    public function show($id)
    {
        // Retrieve a specific user
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function store(Request $request)
    {
//        return response()->json($request);
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required|string',
            'address' => 'required|string',
        ]);


        // Create a new user
        $user = new Users;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_no = $request->input('phone_no');
        $user->address = $request->input('address');

        $user->save();

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required|string',
            'address' => 'required|string',
        ]);

        // Update a specific user
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_no = $request->input('phone_no');
        $user->address = $request->input('address');

        $user->save();

        return response()->json($user,201);
    }

    public function destroy($id)
    {
        // Delete a specific user
        $user = Users::find($id);
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
