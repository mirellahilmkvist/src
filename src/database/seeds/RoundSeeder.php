<?php

use App\Round;
use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Round::create([
            'user_id'        => 1,
            'title'          => 'Harry potter',
            'author'         => 'JK Rowling',
            'genre'          => 'Science-fiction',
            'description'    => 'En Harry potter berättelse',
//            'image' => 'jeje',  // TODO This may not be needed
            'city'           => 'Stockholm',
            // 'image'          => 'no image for you!',
            'start_pos_lat'  => '749',
            'start_pos_long' => '749'
        ]);

        Round::create([
            'user_id'        => 1,
            'title'          => 'Game of Thrones',
            'author'         => 'George RR Martin',
            'genre'          => 'Science-fiction',
            'description'    => 'En Game of Thrones berättelse',
//            'image' => 'jeje',  // TODO This may not be needed
            'city'           => 'Malmö',
            // 'image'          => 'no image for you!',
            'start_pos_lat'  => '777',
            'start_pos_long' => '777'
        ]);

    }
}