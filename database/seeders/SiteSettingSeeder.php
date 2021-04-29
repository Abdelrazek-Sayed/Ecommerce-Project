<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSetting::create([
            'phone_one'     => '+2748389384488',
            'phone_two'     => '0101001010001',
            'email'  => 'Ecommerce@gmail.com',
            'company_name'   => 'Ecomerce Co',
            'company_address' => '30-cairo-egypt',
            'facebook'   => 'www.facbook.com',
            'youtube'   => 'www.youtube.com',
            'twitter'   => 'www.twitter.com',
            'instagram'   => 'www.instagram.com',
        ]);
    }
}
