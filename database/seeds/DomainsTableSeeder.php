<?php

use Illuminate\Database\Seeder;
use App\Domain;

class DomainsTableSeeder extends Seeder
{
    public function run()
    {
        $domains = [
            [
                'id' => 1,
                'name' => env('DEFAULT_SHORT_DOMAIN'),
                'verified_at' => now()
            ],
            [
                'id' => 2,
                'name' => env('PROJECT_DOMAIN'),
                'verified_at' => now()
            ]
        ];

        foreach ($domains as $domain) {
            Domain::updateOrCreate(['id' => $domain['id']], $domain);
        }
    }
}
