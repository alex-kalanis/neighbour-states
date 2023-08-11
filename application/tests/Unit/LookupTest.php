<?php

namespace Tests\Unit;

use App\Lib\Lookup;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LookupTest extends AbstractLocateDb
{
    /**
     * @param string $from
     * @param string $to
     * @param string[] $result
     * @dataProvider countryCodeProvider
     */
    public function testCountryCodes(string $from, string $to, array $result): void
    {
        $lib = new Lookup($this->getLib());
        $this->assertEquals($result, $lib->processing($from, $to));
    }

    public function countryCodeProvider(): array
    {
        return [
            ['CZE', 'ITA', ['CZE', 'AUT', 'ITA']],
            ['POL', 'ISR', ['POL', 'DEU', 'FRA', 'ESP', 'MAR', 'DZA', 'LBY', 'EGY', 'ISR']],
            ['SLO', 'SLO', ['SLO']],
        ];
    }

    public function testNoPath(): void
    {
        $lib = new Lookup($this->getLib());
        $this->assertEquals([], $lib->processing('URY', 'HRV'));
    }

    public function testNoCountryCodeFrom(): void
    {
        $lib = new Lookup($this->getLib());
        $this->expectException(ModelNotFoundException::class);
        $lib->processing('unknown', 'HRK');
    }

    public function testNoCountryCodeTo(): void
    {
        $lib = new Lookup($this->getLib());
        $this->expectException(ModelNotFoundException::class);
        $lib->processing('SLO', 'unknown');
    }
}
