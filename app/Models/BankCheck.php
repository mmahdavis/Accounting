<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class BankCheck extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'amount',
        'pey_date',
        'description',
        'check_number',
        'type'
    ];

    /**
     * Get the bank that owns the BankCheck
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * Get the account that owns the BankCheck
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Accounts::class);
    }
}
