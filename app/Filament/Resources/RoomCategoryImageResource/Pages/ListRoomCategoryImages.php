<?php

namespace App\Filament\Resources\RoomCategoryImageResource\Pages;

use App\Filament\Resources\RoomCategoryImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoomCategoryImages extends ListRecords
{
    protected static string $resource = RoomCategoryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}