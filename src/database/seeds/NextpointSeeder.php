<?php

use App\NextDatapoint;
use Illuminate\Database\Seeder;

class NextpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NextDatapoint::create([
            'datapoint_id' => '1',
            'next_datapoint_id' => '2'
        ]);

        NextDatapoint::create([
            'datapoint_id' => '1',
            'next_datapoint_id' => '4'
        ]);
    }
}
