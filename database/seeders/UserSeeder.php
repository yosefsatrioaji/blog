<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Yosef Satrio Aji',
            'email' => 'yosef260501@gmail.com',
            'slug' => 'yosefsatrioaji',
            'profile_pict' => 'yosef.jpg',
            'summary' => 'I am Yosef Satrio Aji, a third-year student of computer engineering at Diponegoro University. Have skilled in the field of web development especially on the backend side. I also have an interest in cloud platforms like AWS, Google Cloud, etc.',
            'verif' => true,
            'password' => bcrypt('IniPasswordYa123!')
        ]);

        $superadmin->assignRole('super admin');
        $superadmin->userProfile()->create([
            'instagram' => 'yosefsatrio26',
            'github' => 'yosefsatrioaji',
            'website' => 'yosefsa.xyz'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@yosefsa.xyz',
            'slug' => 'admin',
            'password' => bcrypt('IniPasswordAdmin123!')
        ]);

        $admin->assignRole('admin');

        $visitor = User::create([
            'name' => 'Visitor',
            'email' => 'visitor@yosefsa.xyz',
            'slug' => 'visitor',
            'password' => bcrypt('IniPasswordVisitor123!')
        ]);

        $visitor->assignRole('visitor');

        $visitor = User::create([
            'name' => 'Writer',
            'email' => 'writer@yosefsa.xyz',
            'slug' => 'writer',
            'password' => bcrypt('IniPasswordWriter123!')
        ]);

        $visitor->assignRole('writer');
    }
}
