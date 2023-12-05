<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Movie;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $users = [
            [
                'first_name' => 'client',
                'last_name' => 'client',
                'email' => 'client@example.com',
                'user_type' => 'client',
                'password' => bcrypt('123456'),
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }

        // $admins = [
        //     [
        //         'first_name' => 'admin',
        //         'last_name' => 'admin',
        //         'email' => 'admin@example.com',
        //         'password' => 'adminadmin',
        //     ]
        // ];

        // foreach ($admins as $key => $admin) {
        //     Admin::create($admin);
        // }


        $movies = [
            [
                'title' => 'Rush',
                'director' => 'John Doe',
                'genre' => 'Action',
                'description' => 'Story about Nikki Lauda and James Hunt.',
                'year_release' => '2013',
                'image' => '../../resources/images/rush_2013.jpg',
                'trailer_link' => 'https://www.youtube.com/embed/lzNbGH1oZJc',
            ]
        ];

        foreach ($movies as $key => $movie) {
            Movie::create($movie);
        }
    }
}
