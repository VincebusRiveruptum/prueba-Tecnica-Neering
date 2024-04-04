<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    
    public function index(){
        try{
            $users = User::all();
    
            return response()->json([
                'content' => $users,
                'success' => 'true',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error fetching users: ' . $e->getMessage(),
                'success' => 'false',
            ]);
        }
    }

    public function getUser($id){
        try{
            $user = User::findOrFail($id);
    
            return response()->json([
                'content' => $user,
                'success' => 'true',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error fetching user: ' . $e->getMessage(),
                'success' => 'false',
            ]);
        }
    }

    // Index but ranged
    public function indexRanged($page, $perPage, $filter){
        try {
            $query = User::query();
            $totalUsers = $query->count();

            if ($filter !== null) {
                if ($filter == 'active') {
                    $query->where('active', true);
                } elseif ($filter == 'inactive') {
                    $query->where('active', false);
                }
            }

            $users = $query->paginate($perPage, ['*'], 'page', $page);
    
            return response()->json([
                'content' => $users,
                'total' => $totalUsers,
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching users: ' . $e->getMessage(),
                'success' => false,
            ]);
        }
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'profilepic' => 'nullable',
        ]);

        try{
            $newUser = new User();
            $newUser->name = $validated['name'];
            $newUser->email = $validated['email'];
            $newUser->password = Hash::make($validated['password']);
            $newUser->profilepic = $validated['profilepic'];

            $newUser->save();

            return response()->json([
                'message' => "User created successfully.",
                'success' => 'true'
            ], 200);

        }catch(\Exception $e){
            return response()->json([
                'message' => "Could not create user: " . $e->getMessage(),
                'success' => 'false'
            ], 400);
        }
    }

    public function destroy($id){
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => "User deleted successfully.",
                'success' => 'true'
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => "Could not delete user: " . $e->getMessage(),
                'success' => 'false'
            ], 400);
        }
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
            'profilepic' => 'nullable',
        ]);
        try{
            $user = User::findOrFail($id);
            $user->update($validated);

            return response()->json([
                'message' => "User updated successfully.",
                'success' => 'true'
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => "Could not update user: " . $e->getMessage(),
                'success' => 'false'
            ], 400);
        }
    }
}
