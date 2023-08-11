<?php

namespace App\Lib\Lookup;

use App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class Db
 * @package App\Lib\Lookup
 */
class Db
{
    /**
     * @throws ModelNotFoundException
     * @return array<string, Models\CountryData>
     */
    public function getAllCountries(): array
    {
        $entries = Models\CountryData::get()->all();
        return array_combine(array_map(function (Models\CountryData $country) {
            return strtoupper($country->country_code);
        }, $entries), $entries);
    }
}
