<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomCategoryResource\Pages;
use App\Models\RoomCategory;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;

class RoomCategoryResource extends Resource
{
    protected static ?string $model = RoomCategory::class;

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description'),
                Forms\Components\FileUpload::make('image')
                    ->directory('room-categories')
                    ->image()
                    ->label('Image principale'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('price')->money('XAF'), // Utiliser XAF pour FCFA
                Tables\Columns\TextColumn::make('capacity'),
                Tables\Columns\TextColumn::make('available_rooms')
                    ->label('Chambres disponibles')
                    ->getStateUsing(function (RoomCategory $record): int {
                        return $record->rooms()->where('is_available', true)->count();
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
            \App\Filament\Resources\RoomCategoryResource\RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoomCategories::route('/'),
            'create' => Pages\CreateRoomCategory::route('/create'),
            'edit' => Pages\EditRoomCategory::route('/{record}/edit'),
        ];
    }
}
