<?php

use Illuminate\Database\Seeder;
use App\Post;
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
        //
        DB::table('categories')->truncate();//apagar todos os dados da tabela

        DB::table('categories')->insert([
            [
                'title' => 'Uncategorized',
                'slug' => 'uncategorized',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Tips and Tricks',
                'slug' => 'tips-and-tricks',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Build Apps',
                'slug' => 'build-apps',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'News',
                'slug' => 'news',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Freebies',
                'slug' => 'freebies',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        //actualizar os dados da tabela posts
//        for ($post_id = 1; $post_id <= 36; $post_id++) {
        $categories = Category::pluck('id');
        foreach (Post::pluck('id') as $postId) {

            $categoryId = $categories[rand(0, $categories->count() - 1)];

            DB::table('posts')
                ->where('id', $postId)
                ->update(['category_id' => $categoryId]);
        }
    }
}
