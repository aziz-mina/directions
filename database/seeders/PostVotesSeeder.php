<?php

namespace Database\Seeders;

use App\Models\PostVotes;
use Illuminate\Database\Seeder;

class PostVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostVotes::factory()->times(500)->create();
    }
}
