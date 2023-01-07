<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed de las aplicaciones de la base de datos.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(CompanyUsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(PermissionProfilesTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
}
