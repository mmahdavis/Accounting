<?php

namespace App\Filament\Resources\BankCheckResource\Pages;

use App\Filament\Resources\BankCheckResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBankCheck extends CreateRecord
{
    protected static string $resource = BankCheckResource::class;

    use CreateRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
