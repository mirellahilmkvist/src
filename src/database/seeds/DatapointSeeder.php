<?php

use App\Datapoint;
use Illuminate\Database\Seeder;

class DatapointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Datapoint::create([
            'round_id'       => '1',
            'is_direction'   => false,
            'title'          => 'En Harry Potter punkt',
            'text'           => 'Beskrivning av Harry Potter punkt',
            'point_pos_lat'  => '55.604981',
            'point_pos_long' => '13.003822000000014'
        ]);

        Datapoint::create([
            'round_id'       => '1',
            'is_direction'   => false,
            'title'          => 'En till Harry Potter punkt',
            'text'           => 'Beskrivning av nästa Harry Potter punkt',
            'point_pos_lat'  => '55.603938550188325',
            'point_pos_long' => '13.00458210485931'
        ]);

        Datapoint::create([
            'round_id'       => '1',
            'is_direction'   => false,
            'title'          => 'Ytterligare en Harry potter punkt',
            'text'           => 'Beskrivning av ytterligare en Harry Potter punkt',
            'point_pos_lat'  => '55.60032337552944',
            'point_pos_long' => '12.995841616230791'
        ]);

        Datapoint::create([
            'round_id'       => '2',
            'is_direction'   => false,
            'title'          => 'En Game of Thrones punkt',
            'text'           => 'Beskrivning av Game of Thrones punkt',
            'point_pos_lat'  => '55.20213238132',
            'point_pos_long' => '13.005697903809'
        ]);

        Datapoint::create([
            'round_id'       => '2',
            'is_direction'   => false,
            'title'          => 'En till Game of Thrones punkt',
            'text'           => 'Beskrivning av Game of Thrones punkt',
            'point_pos_lat'  => '55.30213238132',
            'point_pos_long' => '13.005697903809'
        ]);

        Datapoint::create([
            'round_id'       => '2',
            'is_direction'   => false,
            'title'          => 'Ytterligare en Game of Thrones punkt',
            'text'           => 'Beskrivning av Game of Thrones punkt',
            'point_pos_lat'  => '55.40213238132',
            'point_pos_long' => '13.005697903809'
        ]);

        Datapoint::create([
            'round_id'       => '2',
            'is_direction'   => false,
            'title'          => 'Ännu ytterligare en Game of Thrones punkt',
            'text'           => 'Beskrivning av Game of Thrones punkt',
            'point_pos_lat'  => '55.50213238132',
            'point_pos_long' => '13.005697903809'
        ]);
    }
}
