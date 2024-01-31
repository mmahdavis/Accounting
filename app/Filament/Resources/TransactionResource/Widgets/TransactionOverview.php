<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;

class TransactionOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 0;

    public function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        return [
            Stat::make(
                label: __('total_expose_transaction'),
                value: Number::format(Transaction::query()
                    ->when('برداشت', fn (Builder $query) => $query->where('type', 'برداشت'))
                    ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->sum('amount')) . " ريال",
            )
                ->chart(
                    Transaction::query()
                        ->when('برداشت', fn (Builder $query) => $query->where('type', 'برداشت'))
                        ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                        ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))->pluck('amount')->toArray()
                )
                ->color('success'),

            Stat::make(
                label: __('total_income_transaction'),
                value: Number::format(Transaction::query()
                    ->when('واریز', fn (Builder $query) => $query->where('type', 'واریز'))
                    ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->sum('amount')) . " ريال",
            )
                ->chart(
                    Transaction::query()
                        ->when('واریز', fn (Builder $query) => $query->where('type', 'واریز'))
                        ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                        ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))->pluck('amount')->toArray()
                )
                ->color('danger'),

            Stat::make(
                label: __('total_transaction'),
                value: Number::format(Transaction::query()
                    ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->sum('amount')) . " ريال",
            )
                ->chart(
                    Transaction::query()
                        ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                        ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))->pluck('amount')->toArray()
                )
                ->color('info'),
        ];
    }
}
