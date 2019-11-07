<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Individual
 * @package App\Models
 * @property int id
 * @property string fio
 * @property string ipn
 * @property string registration_address
 * @property string residence_address
 * @property string contact_phone
 * @property string work_place
 * @property string work_place_phone
 * @property float average_monthly_income
 * @property float another_income
 * @property int is_married
 * @property int dependents_count
 * @property int is_have_guarantor
 * @property int guarantor_id
 * @property Guarantor guarantor
 * @property RealEstate[]|Collection realEstates
 * @property Movables[]|Collection movables
 */
class Individual extends Model
{
    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    /**
     * @return BelongsTo
     */
    public function guarantor(): BelongsTo
    {
        return $this->belongsTo(Guarantor::class,'guarantor_id','id');
    }

    /**
     * @return HasMany
     */
    public function realEstates(): HasMany
    {
        return $this->hasMany(RealEstate::class,'individual_id','id');
    }

    /**
     * @return HasMany
     */
    public function movables(): HasMany
    {
        return $this->hasMany(Movables::class,'individual_id','id');
    }
}
