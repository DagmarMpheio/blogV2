<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset a tabela post
        DB::table('posts')->truncate();//apagar todos os dados da tabela

        //gerar 36 posts

        $posts = [];
        $faker = Factory::create();
//        $date = Carbon::create(2020, 10, 13, 10);
        $date = Carbon::now()->modify('-1 year');//um ano atras

        for ($i = 1; $i <= 36; $i++) {
            $image = "Post_Image_" . rand(1, 5) . ".jpg";
            /*$date = date("Y-m-d H:i:s", strtotime("2020-10-12 09:00:00 +{$i} days"));*/
            $date->addDays(10);
            $publishedDate = clone($date);

            $posts[] = [
                'author_id' => rand(1, 3),
                'title' => $faker->sentence(rand(8, 12)),
                'slug' => $faker->slug(),
                'excerpt' => $faker->text(rand(250, 300)),
                'body' => $faker->paragraphs(rand(10, 15), true),
                'image' => rand(0, 1) == 1 ? $image : NULL,
                'created_at' => clone($date),
                'updated_at' => clone($date),
                'published_at' => $i < 30 ? $publishedDate : (rand(0, 1) == 0 ? NULL : $publishedDate->addDays(4)),
                'view_count' => rand(1, 10) * 10
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
