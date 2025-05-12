<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Gestion des réservations';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Section::make('Détails du client')
                            ->schema([
                                Forms\Components\Select::make('title')
                                    ->label('Civilité')
                                    ->options([
                                        'M.' => 'Monsieur',
                                        'Mme' => 'Madame',
                                        'Mlle' => 'Mademoiselle',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('first_name')
                                    ->label('Prénom')
                                    ->required()
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('last_name')
                                    ->label('Nom')
                                    ->required()
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Téléphone')
                                    ->tel()
                                    ->required(),
                                Forms\Components\TextInput::make('address')
                                    ->label('Adresse')
                                    ->maxLength(255),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Détails de la réservation')
                            ->schema([
                                Forms\Components\Select::make('room_category_id')
                                    ->label('Catégorie de chambre')
                                    ->options(RoomCategory::all()->pluck('name', 'id'))
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('room_id', null)),
                                Forms\Components\Select::make('room_id')
                                    ->label('Chambre')
                                    ->options(function (callable $get) {
                                        $categoryId = $get('room_category_id');
                                        if (!$categoryId) return [];
                                        return Room::where('room_category_id', $categoryId)
                                            ->where('is_available', true)
                                            ->pluck('room_number', 'id');
                                    })
                                    ->required(),
                                Forms\Components\TextInput::make('guests')
                                    ->label('Nombre de personnes')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(5)
                                    ->required(),
                                Forms\Components\DatePicker::make('check_in_date')
                                    ->label('Date d\'arrivée')
                                    ->required()
                                    ->minDate(now()),
                                Forms\Components\DatePicker::make('check_out_date')
                                    ->label('Date de départ')
                                    ->required()
                                    ->minDate(function (callable $get) {
                                        $checkIn = $get('check_in_date');
                                        return $checkIn ? \Carbon\Carbon::parse($checkIn)->addDay() : now();
                                    }),
                                Forms\Components\Select::make('payment_method')
                                    ->label('Méthode de paiement')
                                    ->options([
                                        'credit_card' => 'Carte de crédit',
                                        'bank_transfer' => 'Virement bancaire',
                                        'cash' => 'Espèces',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('status')
                                    ->label('Statut')
                                    ->options([
                                        'pending' => 'En attente',
                                        'confirmed' => 'Confirmée',
                                        'cancelled' => 'Annulée',
                                        'completed' => 'Terminée',
                                    ])
                                    ->default('pending')
                                    ->required(),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Options supplémentaires')
                            ->schema([
                                Forms\Components\Textarea::make('special_requests')
                                    ->label('Demandes spéciales')
                                    ->maxLength(1000)
                                    ->columnSpan(2),
                                Forms\Components\Checkbox::make('breakfast')
                                    ->label('Petit-déjeuner inclus'),
                                Forms\Components\Checkbox::make('late_checkout')
                                    ->label('Départ tardif'),
                                Forms\Components\Checkbox::make('airport_transfer')
                                    ->label('Transfert aéroport'),
                            ])
                            ->columns(2),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Référence')
                    ->formatStateUsing(fn ($state) => str_pad($state, 5, '0', STR_PAD_LEFT))
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('Client')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return "{$record->title} {$record->first_name} {$record->last_name}";
                    }),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('room.room_number')
                    ->label('N° Chambre')
                    ->sortable(),
                TextColumn::make('roomCategory.name')
                    ->label('Type de chambre')
                    ->sortable(),
                TextColumn::make('check_in_date')
                    ->label('Arrivée')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('check_out_date')
                    ->label('Départ')
                    ->date('d/m/Y')
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
                IconColumn::make('breakfast')
                    ->label('PDJ')
                    ->boolean(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'confirmed' => 'Confirmée',
                        'cancelled' => 'Annulée',
                        'completed' => 'Terminée',
                    ]),
                Tables\Filters\Filter::make('check_in_date')
                    ->label('Arrivée entre')
                    ->form([
                        Forms\Components\DatePicker::make('check_in_from')
                            ->label('Du'),
                        Forms\Components\DatePicker::make('check_in_until')
                            ->label('Au'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['check_in_from'],
                                fn($q, $date) => $q->whereDate('check_in_date', '>=', $date))
                            ->when($data['check_in_until'],
                                fn($q, $date) => $q->whereDate('check_in_date', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('confirm')
                    ->label('Confirmer')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (Reservation $record) {
                        $record->status = 'confirmed';
                        $record->save();
                    })
                    ->visible(fn (Reservation $record) => $record->status === 'pending'),
                Tables\Actions\Action::make('cancel')
                    ->label('Annuler')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(function (Reservation $record) {
                        $record->status = 'cancelled';
                        $record->save();
                    })
                    ->visible(fn (Reservation $record) => $record->status === 'pending' || $record->status === 'confirmed'),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('confirm_selected')
                    ->label('Confirmer la sélection')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                        $records->each(function ($record) {
                            if ($record->status === 'pending') {
                                $record->status = 'confirmed';
                                $record->save();
                            }
                        });
                    }),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }    
}
