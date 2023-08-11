<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class CountryData
 * @package App\Models
 * @property int $id
 * @property string $country_code
 * @property mixed $json_data
 * @property string $created_at
 * @property string $updated_at
 *
 * Technically the neighbours aren't necessary for this version of lookup, just data in json
 * - the lookup structure here is build for each query; it's less stressful on DB
 */
class CountryData extends Model
{
    use HasFactory;

    protected $table = 'country_data';

    protected $fillable = [
        'id',
        'country_code',
        'json_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'json_data' => 'array',
    ];

    /**
     * @return BelongsToMany<CountryData>
     */
    public function neighbourCountries()
    {
        return $this->belongsToMany(CountryData::class, 'country_data_pivot', 'current_country_id', 'neighbour_country_id');
    }

    public static function resetNeighbours(): void
    {
        // clear pivot
//        $cd = new CountryData();
//        $cd->neighbourCountries()->truncate();

        // now get data and make that MxN relations
        $full = CountryData::get()->all();

        $byKey = array_combine(array_map(function (CountryData $data) {
            return $data->country_code;
        }, $full), $full);

        // now pair and save
        foreach ($byKey as $country) {
            /** @var CountryData $country */
            $wanted = [];
            foreach ($country->json_data['borders'] as $neighbourCode) {
                if (isset($byKey[$neighbourCode])) {
                    $wanted[] = $byKey[$neighbourCode];
                }
            }
            if (!empty($wanted)) {
                $country->neighbourCountries()->saveMany($wanted);
            }
        }
    }
}
