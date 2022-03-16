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
                'status' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	 	[
    	 		'name' => 'Banglalink',
                'status' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	 	[
    	 		'name' => 'Grameenphone',
                'status' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	 	[
    	 		'name' => 'Robi',
                'status' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	 	[
    	 		'name' => 'Teletalk',
                'status' => '1',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
    	 	],
    	]);
    }
}
