<?php

namespace App\Filament\Resources\AccountsResource\Pages;

use App\Filament\Resources\AccountsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccounts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = AccountsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
