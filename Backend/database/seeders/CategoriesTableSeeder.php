<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category= new Category();
        $category->name = "Bebidas";
        $category->state=1;
        $category->created_by = 1;
        $category->updated_by = null;
        $category->save();

        $category= new Category();
        $category->name = "Panaderia";
        $category->state=1;
        $category->created_by = 1;
        $category->updated_by = null;
        $category->save();

        $category= new Category();
        $category->name = "Postres";
        $category->state=1;
        $category->created_by = 1;
        $category->updated_by = null;
        $category->save();
    }
}
