<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Bank extends Model
{
    use HasFactory;


    public $translatable = [
        'bank_name',
        'balance',
        'name',
        'card_number',
        'last_transaction_date',
    ];

    /**
     * Get all of the bank_checks for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bank_checks(): HasMany
    {
        return $this->hasMany(BankCheck::class);
    }
}
