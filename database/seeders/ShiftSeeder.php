<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //shift create

       // create a shift
       \App\Models\Shift::create([
        'company_id' => 1,
        'name' => 'Shift Pagi',
        'clock_in_time' => '08:00:00',
        'clock_out_time' => '16:00:00',
    ]);

    \App\Models\Shift::create([
        'company_id' => 1,
        'name' => 'Shift Sore',
        'clock_in_time' => '16:00:00',
        'clock_out_time' => '00:00:00',
    ]);
    }
}
