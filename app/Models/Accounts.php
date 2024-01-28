<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Accounts extends Model
{
    use HasFactory;


    public $translatable = [
        'name',
        'type'
    ];

    /**
     * Get all of the transaction for the Accounts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get all of the bank_check for the Accounts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bank_checks(): HasMany
    {
        return $this->hasMany(BankCheck::class);
    }
}
