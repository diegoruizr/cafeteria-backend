<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\User;
use App\Profile;
use App\Person;
use App\PersonLicensePlate;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Webmaster
        $user = User::find(1);
        $profile = Profile::find(1);
        $person = new Person();
        $person->user_id = $user->id;
        $person->identification = 3333333333;
        $person->name = $user->name;
        $person->state = 1;
        $person->profile()->associate($profile);
        $person->created_by = 1;
        $person->updated_by = null;
        $person->save();
    }
}
