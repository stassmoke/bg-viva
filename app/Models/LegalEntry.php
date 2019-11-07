<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LegalEntry
 * @package App\Models
 * @property int id
 * @property string name
 * @property int edrpou_code
 * @property string legal_address
 * @property string actual_address
 * @property string contact_person
 * @property string phone
 * @property string landline_phone
 * @property string activity
 * @property int net_profit_type
 * @property float carrying_amount
 * @property string carrying_date
 * @property int carrying_type
 * @property float payables
 * @property string payables_date
 * @property int payables_type
 * @property float receivables
 * @property string receivables_date
 * @property int receivables_type
 */
class LegalEntry extends Model
{
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
}
