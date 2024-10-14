<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();


        //Generate 15 clients with an image related to people
        for ($i = 0; $i < 5; $i++) {
            $imagePath = $this->generateAvatar($faker);

            Client::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'avatar' => $imagePath,
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }

    //Generate a random image URL (100x100) related to people, save it to storage and return the path
    //Example path: http://127.0.0.1:8000/storage/avatars/670c5944721b9.jpg
    private function generateAvatar($faker)
    {
        $imageUrl = $faker->imageUrl(100, 100, 'avatar', true);

        $imageContent = file_get_contents($imageUrl);

        $imageName = uniqid() . '.jpg';
        $path = 'avatars/' . $imageName;

        Storage::disk('public')->put($path, $imageContent);

        return $path;
    }
}
