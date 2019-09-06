<?php

use Illuminate\Database\Seeder;
use App\Link\ConditionType;

class ConditionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		ConditionType::create([
			'id' => 110,
			'name' => 'Below Visitor Limit',
			'function' => 'isBelowVisitorLimit',
			'description' => 'Number of visitor is below'
		]);
    }
}
