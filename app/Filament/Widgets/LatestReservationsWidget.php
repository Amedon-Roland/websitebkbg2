<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class LatestReservationsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    
    protected int|string|array $columnSpan = 'full';
    
    protected function getTableQuery(): Builder|Relation|null
    {
        return Reservation::latest()->take(5);
    }
    
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')
                ->label('Référence')
                ->formatStateUsing(fn ($state) => str_pad($state, 5, '0', STR_PAD_LEFT)),
                
            Tables\Columns\TextColumn::make('full_name')
                ->label('Client')
                ->searchable(['first_name', 'last_name']),
                
            Tables\Columns\TextColumn::make('check_in_date')
                ->label('Arrivée')
                ->date('d/m/Y'),
                
            Tables\Columns\TextColumn::make('check_out_date')
                ->label('Départ')
                ->date('d/m/Y'),
                
            // Remplacement de BadgeColumn::enum par la nouvelle syntaxe
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
                
            Tables\Columns\TextColumn::make('total_price')
                ->label('Montant')
                ->money('XAF'),
        ];
    }
    
    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->label('Voir')
                ->url(fn (Reservation $record): string => route('filament.admin.resources.reservations.edit', $record))
                ->icon('heroicon-o-eye'),
        ];
    }
}