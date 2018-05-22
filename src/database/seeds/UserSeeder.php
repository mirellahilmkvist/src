<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'password'     => Hash::make('123456'),
            'email'        => 'random@rand.nu',
            'org_nr'       => '123456789',
            'company_name' => 'Warner Brothers',
            'name'         => 'Mr Warner Brother'
        ]);
    }
}
