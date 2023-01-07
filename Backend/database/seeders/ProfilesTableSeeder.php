<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Profile;
class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile();
        $profile->name = "KONECTA";
        $profile->description = "Administrador";
        $profile->level = 1;
        $profile->code = 1;
        $profile->state = 1;
        $profile->created_by = 1;
        $profile->updated_by = null;
        $profile->save();

    }
}
