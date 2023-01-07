<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Profile;
use App\Permission;

class PermissionProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Webmaster
        $profile= Profile::find(1);
        $permissions = Permission::get();
        foreach ($permissions as $permission) {
            $profile->permissions()->attach($permission->id,['state'=>1, 'created_by'=>1]);
        }
    }
}
