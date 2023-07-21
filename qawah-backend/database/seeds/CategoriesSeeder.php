<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admins = [
		    [
			    'title' => 'gold',
			    'slug' 	 => 'gold',
			    'created_at' => \Carbon\Carbon::now(),
			    'updated_at' => \Carbon\Carbon::now(),
			],
			[
                'title' => 'platinum',
                'slug' 	 => 'platinum',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
			],
			[
                'title' => 'premium',
                'slug' 	 => 'premium',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'month to month',
                'slug' 	 => 'month_month_month',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
			]
		];

        // DB::table('packages_catogeries')->truncate();
        DB::table('packages_catogeries')->insert( $admins );
        
    }
}
