<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;

class RecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $countryData = [
            [
                'id' => 1,
                'country_code' => 'CZE',
                'json_data' => '{"borders": ["AUT","DEU","POL","SVK"]}',
            ],
            [
                'id' => 2,
                'country_code' => 'AUT',
                'json_data' => '{"borders": ["CZE","DEU","HUN","ITA","LIE","SVK","SVN","CHE"]}',
            ],
            [
                'id' => 3,
                'country_code' => 'DEU',
                'json_data' => '{"borders": ["AUT","BEL","CZE","DNK","FRA","LUX","NLD","POL","CHE"]}',
            ],
            [
                'id' => 4,
                'country_code' => 'POL',
                'json_data' => '{"borders": ["BLR","CZE","DEU","LTU","RUS","SVK","UKR"]}',
            ],
            [
                'id' => 5,
                'country_code' => 'SVK',
                'json_data' => '{"borders": ["AUT","CZE","HUN","POL","UKR"]}',
            ],
            [
                'id' => 6,
                'country_code' => 'HUN',
                'json_data' => '{"borders": ["AUT","HRV","ROU","SRB","SVK","SVN","UKR"]}',
            ],
            [
                'id' => 7,
                'country_code' => 'ITA',
                'json_data' => '{"borders": ["AUT","FRA","SMR","SVN","CHE","VAT"]}',
            ],
            [
                'id' => 8,
                'country_code' => 'CHE',
                'json_data' => '{"borders": ["AUT","FRA","ITA","LIE","DEU"]}',
            ],
            [
                'id' => 9,
                'country_code' => 'FRA',
                'json_data' => '{"borders": ["AND","BEL","DEU","ITA","LUX","MCO","ESP","CHE"]}',
            ],
            [
                'id' => 10,
                'country_code' => 'SLO',
                'json_data' => '{"borders": ["AUT","HRV","ITA","HUN"]}',
            ],
            [
                'id' => 11,
                'country_code' => 'ESP',
                'json_data' => '{"borders": ["AND","FRA","GIB","PRT","MAR"]}',
            ],
            [
                'id' => 12,
                'country_code' => 'AND',
                'json_data' => '{"borders": ["FRA","ESP"]}',
            ],
            [
                'id' => 13,
                'country_code' => 'PRT',
                'json_data' => '{"borders": ["ESP"]}',
            ],
            [
                'id' => 14,
                'country_code' => 'HRV',
                'json_data' => '{"borders": ["BIH","HUN","MNE","SRB","SVN"]}',
            ],
            [
                'id' => 15,
                'country_code' => 'MAR',
                'json_data' => '{"borders": ["DZA","ESH","ESP"]}',
            ],
            [
                'id' => 16,
                'country_code' => 'DZA',
                'json_data' => '{"borders": ["TUN","LBY","NER","ESH","MRT","MLI","MAR"]}',
            ],
            [
                'id' => 17,
                'country_code' => 'TUN',
                'json_data' => '{"borders": ["DZA","LBY"]}',
            ],
            [
                'id' => 18,
                'country_code' => 'LBY',
                'json_data' => '{"borders": ["DZA","TCD","EGY","NER","SDN","TUN"]}',
            ],
            [
                'id' => 19,
                'country_code' => 'EGY',
                'json_data' => '{"borders": ["ISR","LBY","PSE","SDN"]}',
            ],
            [
                'id' => 20,
                'country_code' => 'ISR',
                'json_data' => '{"borders": ["EGY","JOR","LBN","PSE","SYR"]}',
            ],
            [
                'id' => 21,
                'country_code' => 'ARG',
                'json_data' => '{"borders": ["BOL","BRA","CHL","PRY","URY"]}',
            ],
            [
                'id' => 22,
                'country_code' => 'CHL',
                'json_data' => '{"borders": ["ARG","BOL","PER"]}',
            ],
            [
                'id' => 23,
                'country_code' => 'URY',
                'json_data' => '{"borders": ["ARG","BRA"]}',
            ],
            [
                'id' => 24,
                'country_code' => 'PRY',
                'json_data' => '{"borders": ["ARG","BOL","BRA"]}',
            ],
            [
                'id' => 25,
                'country_code' => 'BRA',
                'json_data' => '{"borders": ["ARG","BOL","COL","GUF","GUY","PRY","PER","SUR","URY","VEN"]}',
            ],
            [
                'id' => 26,
                'country_code' => 'BOL',
                'json_data' => '{"borders": ["ARG","BRA","CHL","PRY","PER"]}',
            ],
            [
                'id' => 30,
                'country_code' => 'AUS',
                'json_data' => '{"borders": []}',
            ],
        ];
        Models\CountryData::insert($countryData);
        Models\CountryData::resetNeighbours();
    }
}
