<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $seeders = [
        ];
        if ('testing' === env('APP_ENV', 'local')) {
            $seeders[] = RecordsSeeder::class;
        }
        $this->call($seeders);
    }
}
