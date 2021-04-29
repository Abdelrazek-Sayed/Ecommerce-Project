<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'vat'     => '5',
            'shipping_charge'     => '10',
            'shopname'  => 'Zezo Shop',
            'email'   => 'zez0@gmail.com',
            'phone' => '010010100101',
            'address'   => 'cairo-egypt',
        ]);
    }
}
