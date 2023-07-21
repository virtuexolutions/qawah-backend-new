<?php

use Illuminate\Database\Seeder;

class SubCategoryTableSeeder extends Seeder
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
			    'pkg_cat_id' => '1',
			    'title' 	 => 'gold',
			    'created_at' => \Carbon\Carbon::now(),
			    'updated_at' => \Carbon\Carbon::now(),
			],
			[
                'pkg_cat_id' => '2',
                'title' 	 => 'platinum',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
			],
			[
                'pkg_cat_id' => '3',
                'title' 	 => 'spotlight',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
			[
                'pkg_cat_id' => '3',
                'title' 	 => 'love-notes',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
			[
                'pkg_cat_id' => '3',
                'title' 	 => 'discrete-mode',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
		];

        DB::table('package_sub_category')->truncate();
        DB::table('package_sub_category')->insert( $admins );
        
    }
}
