<?php

namespace Database\Seeders;
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
     /**
     * Ejecutar los seeders de base de datos.
     *
     * @return void
     */
    public function run()
    {

        $user= new User();
        $user->name = "WebMaster";
        $user->email="webmaster@gmail.com";
        $user->activation_token="";
        $user->active=1;
        $user->password = bcrypt("cafeteria");
        $user->state=1;
        $user->save();
    }
}
