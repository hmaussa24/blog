<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'telefono' => '123',
            'tipo_user' => 'Administrador'
        ]);

        DB::table('categorias')->insert([
            'name' => 'Ciencia',
        ]);

        DB::table('categorias')->insert([
            'name' => 'Tecnologia',
        ]);

        DB::table('categorias')->insert([
            'name' => 'Cocina',
        ]);
    }
}
