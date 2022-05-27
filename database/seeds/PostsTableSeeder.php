<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Post;
use Illuminate\Support\Str;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // ? Prendo tutti i diversi id da User e li trasformo in un array
        $user_ids = User::pluck('id')->toArray();

        for ($i=0; $i < 200; $i++) {
            $newPost = new Post();
            $newPost->title = ucfirst($faker->realTextBetween(6, 16));
            $newPost->user_id = $faker->randomElement($user_ids);
            $newPost->content = $faker->realText(400);
            $newPost->image_url = "https://picsum.photos/id/$i/450/600";
            $newPost->slug = Str::slug($newPost->title, '-')."-$i";
            $newPost->save();
        }
    }
}
