<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomCategoryImageResource\Pages;
use App\Models\RoomCategory;
use App\Models\RoomCategoryImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoomCategoryImageResource extends Resource
{
    protected static ?string $model = RoomCategoryImage::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationLabel = 'Images des catégories';
    
    protected static ?string $navigationGroup = 'Hébergement';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('room_category_id')
                    ->label('Catégorie de chambre')
                    ->options(RoomCategory::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->directory('room-categories-gallery')
                    ->image()
                    ->required()
                    ->imageEditor()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('caption')
                    ->label('Légende')
                    ->maxLength(255),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('roomCategory.name')
                    ->label('Catégorie')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('caption')
                    ->label('Légende')
                    ->searchable(),
              
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('room_category_id')
                    ->label('Catégorie')
                    ->options(RoomCategory::all()->pluck('name', 'id'))
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
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
            'index' => Pages\ListRoomCategoryImages::route('/'),
            'create' => Pages\CreateRoomCategoryImage::route('/create'),
            'edit' => Pages\EditRoomCategoryImage::route('/{record}/edit'),
        ];
    }
}