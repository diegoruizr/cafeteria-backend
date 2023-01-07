<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Company;
use App\User;
class CompaniesTableSeeder extends Seeder
{
     /**
     * Ejecutar los seeders de base de datos.
     *
     * @return void
     */
    public function run()
    {
        $company= new Company();
        $company->name = "Cafeteria Konecta";
        $company->nit= 111111111;
        $company->state=1;
        $company->telephone=123456789;
        $company->address="";
        $company->created_by = 1;
        $company->save();
    }
}
