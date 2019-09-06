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
		LinkType::create([
			'id' => 10,
			'name' => 'Regular URL',
			'function' => 'forwardToUrl',
			'description' => 'Forward to a regular URL'
		]);
		
		LinkType::create([
			'id' => 20,
			'name' => 'URBN Page',
			'function' => 'loadPage',
			'description' => 'Load an URBN Page'
		]);

		LinkType::create([
			'id' => 30,
			'name' => 'WhatsApp Number',
			'function' => 'forwardToWhatsapp',
			'description' => 'Forward to WhatsApp number'
		]);
    }
}
