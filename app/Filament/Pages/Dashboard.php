<?php

namespace App\Filament\Pages;

use App\Filament\Resources\TransactionResource\Widgets\TransactionOverview;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('startDate')
                            ->jalali()
                            ->label(__('start_date')),
                        DatePicker::make('endDate')
                            ->jalali()
                            ->label(__('end_date')),
                    ])
                    ->columns(2),

            ]);
    }

    public function getWidgets(): array
    {
        return [
            TransactionOverview::class,
        ];
    }
}
