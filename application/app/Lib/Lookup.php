<?php

namespace App\Lib;

use App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use function Termwind\ValueObjects\pr;

/**
 * Class Lookup
 * @package App\Lib
 */
class Lookup
{
    /** @var Lookup\Db */
    protected $dao = null;

    public function __construct(Lookup\Db $dao)
    {
        $this->dao = $dao;
    }

    /**
     * @param string $country1
     * @param string $country2
     * @throws ModelNotFoundException
     * @return array<string> path to that country
     */
    public function processing(string $country1, string $country2): array
    {
        $known = $this->dao->getAllCountries();

        if (!isset($known[$country1])) {
            throw new ModelNotFoundException('Unknown country of origin');
        }

        if (!isset($known[$country2])) {
            throw new ModelNotFoundException('Unknown country of destination');
        }

        if ($country1 == $country2) {
            return [$country1];
        }

        $borders = $this->knownBorders($known);
        $traceToCountry = [];

        // beware, it goes to recursion, but I do not want recursion, because efficiency calculations is bad
        // (cannot determine limits) and I want to find path with the least border hops

        $currentCountriesInStep = [];
        $currentCountriesInStep[$country1] = $borders[$country1];
        $traceToCountry[$country1] = [$country1];

        // not need to have never-ending cycle; there is only cca 200 countries, so 300 hops is a good limit (with reserve)
        for ($i=0; $i<300; $i++) {

            $nextCountriesInStep = [];
            foreach ($currentCountriesInStep as $countryCode => $countryNeighbours) {
                foreach ($countryNeighbours as $neighbour) {
                    if (!isset($traceToCountry[$neighbour]) && isset($borders[$neighbour])) {
                        // add trace to that country - current + new one
                        $traceToCountry[$neighbour] = array_merge($traceToCountry[$countryCode], [$neighbour]);
                        // add its neighbours to check them in next round
                        $nextCountriesInStep[$neighbour] = $borders[$neighbour];
                    }
                }
            }

//print_r(['step' => $i, 'c1' => $country1, 'c2' => $country2, 'curr' => $currentCountriesInStep, 'next' => $nextCountriesInStep, 'trace' => $traceToCountry]);
            if (isset($traceToCountry[$country2])) {
                // FOUND
                return $traceToCountry[$country2];
            }

            if (empty($nextCountriesInStep)) {
                // australia and other island-based countries - not need to check more
                // here it will end in cca 99% of cases - no more unknown neighbour country available to check
                break;
            }

            $currentCountriesInStep = $nextCountriesInStep;
        }

        return [];
    }

    /**
     * @param array<string, Models\CountryData> $knownCountries
     * @return array<string, array<string>>
     */
    protected function knownBorders(array $knownCountries): array
    {
        $parsed = [];
        foreach ($knownCountries as $code => $knownCountry) {
            $parsed[$code] = $this->borderCodes($knownCountry);
        }
        return $parsed;
    }

    /**
     * @param Models\CountryData $country
     * @return array<string>
     */
    protected function borderCodes(Models\CountryData $country): array
    {
        return $country->json_data['borders'];
    }
}
