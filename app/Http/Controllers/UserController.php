<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.user_management.users');
    }

    public function add_user(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
//            'role_id' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->save();


        return back()->withStatus(__('Successfully Registered a User.'));

    }

    public function update_user(Request $request)
    {

        $user = User::find($request->id);
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->role_id = $request->user_role;
        $user->update();


        return response()->json([
            'response'      =>  'User Successfully updated!',
            'user_name' =>  $user->name,
            'user_email' =>  $user->email,
            'user_role' =>  $user->role['role_name'],
            ]);

    }

    public function delete_user(Request $request)
    {
        $user = User::find($request->id);

        $user->delete();

        return response()->json([
            'response'      =>  'User Successfully deleted!']);

    }

}
