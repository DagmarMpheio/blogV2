<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //apagar tudo da tabela roles
        DB::table('roles')->truncate();//apagar todos os dados da tabela

        //Create Admin role
        $admin = new Role();
        $admin->name = "admin";
        $admin->display_name = "Admin";
        $admin->save();

        //Create Editor role
        $editor = new Role();
        $editor->name = "editor";
        $editor->display_name = "Editor";
        $editor->save();

        //Create Author role
        $author = new Role();
        $author->name = "author";
        $author->display_name = "Autor";
        $author->save();

        /*atribuir os cargos*/
        //primeiro usuario com administrador
        $user1 = User::find(1);
        $user1->detachRole($admin);//retirar cargo existente
        $user1->attachRole($admin);//add cargo


        //segundo usuario com editor
        $user2 = User::find(2);
        $user2->detachRole($editor);//retirar cargo existente
        $user2->attachRole($editor);//add cargo


        //terceiro usuario com autor
        $user3 = User::find(3);
        $user3->detachRole($author);//retirar cargo existente
        $user3->attachRole($author);//add cargo


    }
}
