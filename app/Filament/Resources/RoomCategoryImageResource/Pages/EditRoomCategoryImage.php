<?php

namespace App\Filament\Resources\RoomCategoryImageResource\Pages;

use App\Filament\Resources\RoomCategoryImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoomCategoryImage extends EditRecord
{
    protected static string $resource = RoomCategoryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}