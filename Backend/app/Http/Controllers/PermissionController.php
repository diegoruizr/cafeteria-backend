<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class PermissionController extends Controller
{
    /**
     * Obtiene permisos relacionados
     *
     * @param Request $request
     * @return void
     */
    public function getPermissions()
    {
        $profile = new Profile();
        $profile = $profile->find(request()->header('profile'));
        $permissions = $profile->permissions()->where('is_group', 0)
                        ->where('permission_profiles.state',1)->get();
        if(count($permissions)==0){
            return response()->json(['status'=> 400,'message' => 'no tiene permisos']);
        }
        return response()->json(['status'=>200,'permissions' => $permissions]);
    }
}
