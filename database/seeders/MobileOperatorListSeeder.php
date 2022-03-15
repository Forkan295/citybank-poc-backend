<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MobileOperatorListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('mobile_operators')->truncate();

    	DB::table('mobile_operators')->insert([
    	 	[
    	 		'name' => 'Airtel',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	 	[
    	 		'name' => 'Banglalink',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	 	[
    	 		'name' => 'Grameenphone',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	 	[
    	 		'name' => 'Robi',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	 	[
    	 		'name' => 'Teletalk',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	]);
    }
}
