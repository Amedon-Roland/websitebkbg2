<?php

namespace App\Filament\Resources\AccountingResource\Pages;

use App\Filament\Resources\AccountingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccounting extends ListRecords
{
    protected static string $resource = AccountingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('generate_report')
                ->label('Générer un rapport')
                ->icon('heroicon-o-document-chart-bar')
                ->color('primary')
                ->url(fn (): string => static::getResource()::getUrl('report')),
        ];
    }
}