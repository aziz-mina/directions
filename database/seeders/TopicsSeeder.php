<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;


class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create(['name' => 'Programming']);
        Topic::create(['name' => 'Technology']);
        Topic::create(['name' => 'Sports']);
        Topic::create(['name' => 'Engineering']);
        Topic::create(['name' => 'Arts']);
        Topic::create(['name' => 'News']);
        Topic::create(['name' => 'Religions']);
        Topic::create(['name' => 'Crypto']);
        Topic::create(['name' => 'Fashon']);
        Topic::create(['name' => 'Music']);
        Topic::create(['name' => 'Hardware']);
        Topic::create(['name' => 'Science']);
        Topic::create(['name' => 'TV']);
        Topic::create(['name' => 'Gamming']);
        Topic::create(['name' => 'Learning']);
        Topic::create(['name' => 'Memes']);
        Topic::create(['name' => 'Food']);
        Topic::create(['name' => 'Freelancing']);
        Topic::create(['name' => 'Relationships']);
    }
}
