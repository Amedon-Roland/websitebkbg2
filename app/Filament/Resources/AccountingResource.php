<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountingResource\Pages;
use App\Models\Reservation;
use App\Models\RoomCategory;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\DB;

class AccountingResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $navigationGroup = 'Finances';

    protected static ?string $navigationLabel = 'Comptabilité';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('start_date')
                    ->label('Date de début')
                    ->default(fn () => Carbon::now()->startOfMonth())
                    ->required(),
                    
                Forms\Components\DatePicker::make('end_date')
                    ->label('Date de fin')
                    ->default(fn () => Carbon::now()->endOfMonth())
                    ->required(),
                    
                Forms\Components\Select::make('status')
                    ->label('Statut des réservations')
                    ->options([
                        'all' => 'Toutes',
                        'confirmed' => 'Confirmées',
                        'completed' => 'Terminées',
                        'pending' => 'En attente',
                        'cancelled' => 'Annulées',
                    ])
                    ->default('confirmed')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Référence')
                    ->formatStateUsing(fn ($state) => str_pad($state, 5, '0', STR_PAD_LEFT))
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Client')
                    ->searchable(['first_name', 'last_name']),
                    
                Tables\Columns\TextColumn::make('roomCategory.name')
                    ->label('Type de chambre')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('check_in_date')
                    ->label('Date d\'arrivée')
                    ->date('d/m/Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('check_out_date')
                    ->label('Date de départ')
                    ->date('d/m/Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('nights')
                    ->label('Nuitées')
                    ->getStateUsing(fn (Reservation $record): int => $record->check_in_date->diffInDays($record->check_out_date)),
                    
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Montant total')
                    ->money('XAF')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'En attente',
                        'confirmed' => 'Confirmée',
                        'cancelled' => 'Annulée',
                        'completed' => 'Terminée',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'primary',
                        default => 'secondary',
                    }),
            ])
            ->filters([
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Période du'),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('au'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('check_in_date', '>=', $date),
                            )
                            ->when(
                                $data['end_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('check_out_date', '<=', $date),
                            );
                    }),
                    
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'confirmed' => 'Confirmée',
                        'cancelled' => 'Annulée',
                        'completed' => 'Terminée',
                    ]),
            ])
            ->actions([
                // Actions individuelles (si nécessaire)
            ])
            ->bulkActions([
                // Actions groupées (si nécessaire)
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
            'index' => Pages\ListAccounting::route('/'),
            'report' => Pages\GenerateReport::route('/report'),
        ];
    }
}