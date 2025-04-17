<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('website_settings')->insert([
    'website_name'=>'Pos Sytem',
    'header_logo'=>'Pos',
    'website_phone'=>'01910089319',
    'website_address'=>'chuadanga',
    'website_email'=>'mrtitonsquare@gmail.com',
    'currency'=>'$',
      ]);
    }
}
