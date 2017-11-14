<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB:table('devices')->insert([
            'name' => 'Joe\'s phone',
            'mac' => 'ac:cf:85:ca:f8:72',
            'is_in' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
