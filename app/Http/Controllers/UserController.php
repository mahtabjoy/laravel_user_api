<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Designation;

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
        //for storing user data with designation id from designation table
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required|string',
            'address' => 'required|string',
            'designation_id_fk' => 'required|string', // Assuming the user provides designation_name
        ]);

        // Find the designation by name
        $designation = Designation::where('designation_name', $request->input('designation_id_fk'))->first();

        // If the designation exists, use its ID, otherwise handle the case as needed
        $designation_id_fk = $designation ? $designation->id : null;

        $user = new Users();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_no = $request->input('phone_no');
        $user->address = $request->input('address');
        $user->designation_id_fk = $designation_id_fk;
        $user->save();

        // If the designation exists, sync it with the user
        if ($designation) {
            $user->designations()->sync([$designation->id]);
        }

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
            'designation_id_fk' => 'required|string',
        ]);
        // Find the designation by name
        $designation = Designation::where('designation_name', $request->input('designation_id_fk'))->first();

        // If the designation exists, use its ID, otherwise handle the case as needed
        $designation_id_fk = $designation ? $designation->id : null;

        // Update a specific user
        $user = Users::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_no = $request->input('phone_no');
        $user->address = $request->input('address');
        $user->designation_id_fk = $designation_id_fk;
        $user->save();

        // If the designation exists, sync it with the user
        if ($designation) {
            $user->designations()->sync([$designation->id]);
        }

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
