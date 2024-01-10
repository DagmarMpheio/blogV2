<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;


class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //apagar tudo da tabela tags
        DB::table('tags')->truncate();//apagar todos os dados da tabela
        //apagar tudo da tabela post_tag
        DB::table('post_tag')->truncate();//apagar todos os dados da tabela

        $php = new Tag();
        $php->name = "PHP";
        $php->slug = "php";
        $php->save();

        $laravel = new Tag();
        $laravel->name = "Laravel";
        $laravel->slug = "laravel";
        $laravel->save();

        $symphony = new Tag();
        $symphony->name = "Symphony";
        $symphony->slug = "symphony";
        $symphony->save();

        $codeigniter = new Tag();
        $codeigniter->name = "Codeigniter";
        $codeigniter->slug = "codeigniter";
        $codeigniter->save();

        $yii = new Tag();
        $yii->name = "Yii";
        $yii->slug = "yii";
        $yii->save();

        $ruby = new Tag();
        $ruby->name = "Ruby on Rails";
        $ruby->slug = "ruby-on-rails";
        $ruby->save();

        $jquery = new Tag();
        $jquery->name = "jQuery";
        $jquery->slug = "jquery";
        $jquery->save();

        $vue = new Tag();
        $vue->name = "Vue Js";
        $vue->slug = "vue-js";
        $vue->save();

        $react = new Tag();
        $react->name = "React Js";
        $react->slug = "react-js";
        $react->save();

        $tags = [
            $php->id,
            $laravel->id,
            $symphony->id,
            $vue->id,
        ];
        //relacionar tags com posts
        foreach (Post::all() as $post) {
            shuffle($tags);
            for ($i = 0; $i < rand(0, count($tags) - 1); $i++) {
                $post->tags()->detach($tags[$i]);
                $post->tags()->attach($tags[$i]);
            }
        }

    }
}
