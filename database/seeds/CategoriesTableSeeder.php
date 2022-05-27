<?php


use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Category;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = ['Tech', 'Politics', 'Anime', 'Movies & TV', 'NFTS', 'Music', 'Travel', 'Food', 'Health', 'Design', 'Sports'];
        for ($i = 0; $i < count($categories) ; $i++) {
            $newCategory = new Category();
            $newCategory->name = $categories[$i];
            $newCategory->color = $faker->unique()->hexColor();
            $newCategory->save();
        }

    }
}
