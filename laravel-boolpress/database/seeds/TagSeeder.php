<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['FrontEnd Dev','BackEnd Dev','MVC','Models','Seeders'];

        $new_category = new Tag();

        // for ($i=0; $i < count($categoris) ; $i++) { 
        //     $new_category = new Tag();
        //     $new_category->name = $categoris[$i];
        //     $new_category->slug = Str::slug($categoris[$i], '-');
        //     $new_category->save();
        // }

        foreach ($tags as $tag) {
                $new_category = new Tag();
                $new_category->name = $tag;
                $new_category->slug = Str::slug($tag, '-');
                $new_category->save();
        }
    }
}
