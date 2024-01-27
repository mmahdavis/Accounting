<?php

namespace App\Filament\Resources\BankCheckResource\Pages;

use App\Filament\Resources\BankCheckResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBankChecks extends ListRecords
{
    protected static string $resource = BankCheckResource::class;

    protected static ?string $title = 'چک ها';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
