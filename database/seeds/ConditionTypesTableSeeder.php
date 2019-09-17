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
		$condition_types = [
			[
				'id' => 110,
				'name' => 'Below Visitor Limit',
				'function' => 'isBelowVisitorLimit',
				'description' => 'Number of visitor is below'
			]
		];

		foreach ($condition_types as $type) {
			ConditionType::updateOrCreate(['id' => $type['id']], $type);
		}
	}
}
