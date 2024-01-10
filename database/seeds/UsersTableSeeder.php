<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset a tabela users
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();//apagar todos os dados da tabela

        $faker = Factory::create();//dados falsos(aleatorios)

        //gerar 3 usuarios
        DB::table('users')->insert([
            [
                'email' => 'dagmarmpheiu@gmail.com',
                'name' => 'Dagmar Mpheio',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'dagmar-mpheio',
                'bio' => $faker->text(rand(250, 300))
            ],
            [
                'email' => 'janedoe@test.com',
                'name' => 'Jane Doe',
                'password' => bcrypt('secret00'),
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'jane-doe',
                'bio' => $faker->text(rand(250, 300))
            ],
            [
                'email' => 'anamiguel@test.com',
                'name' => 'Ana Miguel',
                'password' => bcrypt('secret00'),
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'ana-miguel',
                'bio' => $faker->text(rand(250, 300))
            ]
        ]);
    }
}
