<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Reservation;
use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('room_category_id')
                    ->label('Room Category')
                    ->options(RoomCategory::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('room_number')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_available')
                    ->label('Is Available')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room_number')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                    
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label('Available'),
                    
                // Nouvel indicateur d'état avec date de fin de réservation
                Tables\Columns\TextColumn::make('availability_status')
    ->label('Status')
    ->badge()
    ->getStateUsing(function (Room $record): string {
        $today = Carbon::today();
        
        // Si la chambre est marquée comme disponible
        if ($record->is_available) {
            // Vérifier s'il y a des réservations futures mais pas imminentes
            $futureReservation = Reservation::where('room_id', $record->id)
                ->where('status', '!=', 'cancelled')
                ->where('check_in_date', '>', $today->copy()->addDay())
                ->orderBy('check_in_date')
                ->first();
                
            if ($futureReservation) {
                return 'Libre jusqu\'au ' . Carbon::parse($futureReservation->check_in_date)->subDay()->format('d/m/Y');
            }
            
            return 'Libre';
        }
        
        // Si la chambre est occupée
        $activeReservation = Reservation::where('room_id', $record->id)
            ->where('status', '!=', 'cancelled')
            ->where('check_out_date', '>', $today)
            ->orderBy('check_out_date')
            ->first();
            
        if ($activeReservation) {
            return 'Occupée jusqu\'au ' . Carbon::parse($activeReservation->check_out_date)->format('d/m/Y');
        }
        
        return 'Indisponible';
    })
    ->color(function (string $state): string {
        if ($state === 'Libre') {
            return 'success';
        }
        
        if (str_contains($state, 'Libre jusqu\'au')) {
            return 'info';
        }
        
        if (str_contains($state, 'Occupée')) {
            return 'danger';
        }
        
        return 'warning';
    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
