<?php

namespace Database\Seeders;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $data = [
            [
                'key' => "fcm",
                'module' => 'soical',
                'value' => 0,
                "created_at" => Carbon::now()

            ], [
                'key' => "sms",
                'module' => 'soical',
                'value' => 0,
                "created_at" => Carbon::now()

            ],

        ];
        Setting::insertOrIgnore($data);
    }
}