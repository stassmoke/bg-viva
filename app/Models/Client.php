<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Client
 * @package App\Models
 * @property int id
 * @property int user_id
 * @property int type
 * @property int legal_entity_id
 * @property int individual_id
 * @property string branch_code
 * @property string credit_meta
 * @property boolean is_contract_concluded
 * @property int contract_number
 * @property string contract_date
 * @property int contract_sum
 * @property float contract_percent
 * @property string created_at
 * @property string updated_at
 * @property Individual|null individual
 * @property LegalEntry|null legalEntry
 * @property User user
 * @property OtherBankCredit[]|Collection otherBankCredits
 */
class Client extends Model
{
    protected $casts = [
        'is_contract_concluded' => 'boolean',
    ];

    public const LEGAL_ENTRY_TYPE = 1;
    public const INDIVIDUAL_ENTREPRENEUR_TYPE = 2;
    public const INDIVIDUAL_TYPE = 3;

    /**
     * @return BelongsTo
     */
    public function individual(): BelongsTo
    {
        return $this->belongsTo(Individual::class,'individual_id','id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * @return BelongsTo
     */
    public function legalEntry(): BelongsTo
    {
        return $this->belongsTo(LegalEntry::class,'legal_entity_id','id');
    }

    /**
     * @return HasMany
     */
    public function otherBankCredits(): HasMany
    {
        return $this->hasMany(OtherBankCredit::class,'client_id','id');
    }
}
