<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=0; $i <5 ; $i++) {
            $title=$faker->sentence(4);
            DB::table('articles')->insert([
                'category_id'=>rand(1,6),
                'title'=>$title,
                'content'=>$faker->paragraph(25),
                'image'=>$faker->imageUrl(800,400,'cats',true),
                'slug'=>Str::slug($title,'-'),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
