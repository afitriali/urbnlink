<?php

use Illuminate\Database\Seeder;
use App\Link\LinkType;

class LinkTypesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$link_types = [
			[
				'id' => 10,
				'name' => 'URL',
				'function' => 'forwardToUrl',
				'description' => 'Forward to a regular URL'
			],
			[
			'id' => 20,
			'name' => 'URBN Page',
			'function' => 'loadPage',
			'description' => 'Load an URBN Page'
			],
			[
			'id' => 30,
			'name' => 'WhatsApp',
			'function' => 'forwardToWhatsapp',
			'description' => 'Forward to WhatsApp number'
			]
		];

		foreach ($link_types as $type) {
			LinkType::updateOrCreate(['id' => $type['id']], $type);
		}
	}
}
