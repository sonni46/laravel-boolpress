<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoris = ['HTML','CSS','JS','PHP','LARAVEL','VUE CLI'];

        $new_category = new Category();

        for ($i=0; $i < count($categoris) ; $i++) { 
            $new_category = new Category();
            $new_category->name = $categoris[$i];
            $new_category->slug = Str::slug($categoris[$i], '-');
            $new_category->save();
        }

    }
}
