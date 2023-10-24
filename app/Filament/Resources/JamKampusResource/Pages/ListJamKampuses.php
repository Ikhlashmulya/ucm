<?php

namespace App\Filament\Resources\JamKampusResource\Pages;

use App\Filament\Resources\JamKampusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJamKampuses extends ListRecords
{
    protected static string $resource = JamKampusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
