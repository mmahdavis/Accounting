<?php

namespace App\Filament\Resources;

use App\Filament\Exports\TransactionExporter;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Filament\Resources\TransactionResource\Widgets\TransactionOverview;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class TransactionResource extends Resource
{

    protected static ?string $model = Transaction::class;

    protected static ?string $navigationLabel = 'تراکنش ها';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('account_id')
                    ->relationship('account', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label(__('name')),
                        Select::make('type')
                            ->multiple()
                            ->options([
                                'مشتری' => 'مشتری',
                                'تولید کننده' => 'تولید کننده',
                                'کارمند' => 'کارمند',
                                'صاحبان سهام' => 'صاحبان سهام',
                                'هزینه' => 'هزینه',
                            ])
                            ->required()
                            ->label(__('type'))
                    ])
                    ->required()
                    ->label(__('account')),
                Select::make('bank_id')
                    ->relationship('bank', 'bank_name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('bank_name')
                            ->required()
                            ->maxLength(255)
                            ->label(__('bank')),
                        TextInput::make('balance')
                            ->numeric()
                            ->required()
                            ->label(__('balance'))
                    ])
                    ->required()
                    ->label(__('bank')),
                DatePicker::make('pay_date')
                    ->jalali()
                    ->required()
                    ->maxDate(now())
                    ->label(__('pay_date')),
                Select::make('type')
                    ->options([
                        'واریز' => 'واریز',
                        'برداشت' => 'برداشت'
                    ])
                    ->default('برداشت')
                    ->required()
                    ->label(__('type')),
                TextInput::make('amount')
                    ->numeric()
                    ->suffix('ريال')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->required()
                    ->label(__('amount')),
                TextInput::make('tax')
                    ->numeric()
                    ->suffix('ريال')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->required()
                    ->label(__('tax')),
                Textarea::make('description')
                    ->autosize()
                    ->columnSpan('full')
                    ->label(__('description'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('account.name')
                    ->searchable()
                    ->label(__('account')),
                TextColumn::make('pay_date')
                    ->sortable()
                    ->label(__('pay_date')),
                TextColumn::make('type')
                    ->label(__('type')),
                TextColumn::make('amount')
                    ->summarize(Sum::make())
                    ->searchable()
                    ->label(__('amount')),
                TextColumn::make('tax')
                    ->summarize(Sum::make())
                    ->label(__('tax')),
                TextColumn::make('bank.bank_name')
                    ->label(__('bank')),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'واریز' => 'واریز',
                        'برداشت' => 'برداشت'
                    ])
                    ->label(__('type')),
                SelectFilter::make('bank')
                    ->relationship('bank', 'bank_name')
                    ->searchable()
                    ->preload()
                    ->label(__('bank')),
                QueryBuilder::make()
                    ->constraints([
                        DateConstraint::make('pay_date')
                            ->label(__('pay_date')),
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(TransactionExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(TransactionExporter::class),
                ]),
            ])
            ->groups([
                'account.name',
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TransactionOverview::class,
        ];
    }
}
