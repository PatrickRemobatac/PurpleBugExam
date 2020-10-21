<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index(User $model)
    {
        return view('pages.user_management.role');
    }


    public function update_add(Request $request)
    {

        if($request->role_name == 'Administrator')
        {

            return response()->json([
                'status'      =>  'denied',
                'response'      =>  'You Cannot add the Administrator Role',
            ]);
        }
        else
        {

            $role = new Role();
            $role->role_name = $request->role_name;
            $role->description = $request->role_desc;
            $role->save();

            return response()->json([
                'response'      =>  'Role Successfully added!',
                'role_name' =>  $role->role_name,
                'role_desc' =>  $role->description,
                'role_created' =>  $role->created_at,
                'role_id' =>  $role->id,
                ]);
        }


    }

    public function update_role(Request $request)
    {

        if($request->role_name == 'Administrator')
        {

            return response()->json([
                'status'      =>  'denied',
                'response'      =>  'You Cannot Delete or Update the Administrator Role',
                ]);
        }
        else
        {

            $role = Role::find($request->id);
            $role->role_name = $request->role_name;
            $role->description = $request->role_desc;
            $role->update();


            return response()->json([
                'response'      =>  'Role Successfully updated!',
                'role_name' =>  $role->role_name,
                'role_desc' =>  $role->description]);
        }


    }

    public function delete_role(Request $request)
    {
        $role = Role::find($request->id);


        if($role->role_name == 'Administrator')
        {

            return response()->json([
                'status'      =>  'denied',
                'response'      =>  'You Cannot Delete or Update the Administrator Role',
            ]);
        }
        else
        {

            $role->delete();

            return response()->json([
                'response'      =>  'Role Successfully deleted!']);
        }



    }


}
