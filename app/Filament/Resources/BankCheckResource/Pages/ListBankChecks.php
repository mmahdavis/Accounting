<?php

namespace App\Filament\Resources\BankCheckResource\Pages;

use App\Filament\Resources\BankCheckResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBankChecks extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = BankCheckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
