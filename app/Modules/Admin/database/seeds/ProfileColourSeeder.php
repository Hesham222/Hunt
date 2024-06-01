<?php

use Illuminate\Database\Seeder;
use Admin\Models\ProfileColour;

class ProfileColourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfileColour::create(['accountType' => 'Individuals' , 'colour' => '#0000ff']);
        ProfileColour::create(['accountType' => 'Brokers' , 'colour' => '#00ff00']);
        ProfileColour::create(['accountType' => 'Developers' , 'colour' => '#c8a2c8']);
    }
}
