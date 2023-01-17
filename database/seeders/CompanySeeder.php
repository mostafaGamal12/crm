<?php

namespace Database\Seeders;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create( 
            [
                'name' => "fabrica-dev",
                'active' => 0,
                "created_at" => Carbon::now()

            ]);
        Company::create(
            [
                'name' => "fabrica-cs",
                'active' => 0,
                'parent_id' => 1,

                "created_at" => Carbon::now()

            ]
        );
            
    }
}