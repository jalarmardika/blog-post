<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	Category::create([
    		'name' => 'Web Programming'
    	]);
    	Category::create([
    		'name' => 'Programming Tips'
    	]);
    	User::create([
    		'name' => 'Administrator',
    		'email' => 'admin@gmail.com',
    		'password' => bcrypt('password'),
    		'is_admin' => 1
    	]);
    	User::create([
    		'name' => 'Jalar Mardika',
    		'email' => 'jalarmardika@gmail.com',
    		'password' => bcrypt('jalar')
    	]);
        Post::factory(20)->create();
    }
}
