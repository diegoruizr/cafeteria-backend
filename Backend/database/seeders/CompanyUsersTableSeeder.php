<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Company;
use App\User;

class CompanyUsersTableSeeder extends Seeder
{
    /**
     * Ejecutar los seeders de base de datos.
     *
     * @return void
     */
    public function run()
    {
        $user= User::find(1);
        $user->companies()->attach('1',['state'=>1]);

    }
}
