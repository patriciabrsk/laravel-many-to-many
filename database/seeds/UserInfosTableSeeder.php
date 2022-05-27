<?php


use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\User;
use App\UserInfo;

class UserInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::pluck('id')->toArray();

        for ($i=0; $i < count($user_ids); $i++) {
            $newUser = new UserInfo();
            $newUser->user_id = $faker->unique()->randomElement($user_ids);
            $newUser->phone = $faker->phoneNumber();
            $newUser->address = $faker->streetAddress();
            $newUser->avatar = $faker->imageUrl(250,250);
            $newUser->save();
        }
        //
    }
}
