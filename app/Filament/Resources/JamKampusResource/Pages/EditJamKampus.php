<?php

namespace App\Filament\Resources\JamKampusResource\Pages;

use App\Filament\Resources\JamKampusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJamKampus extends EditRecord
{
    protected static string $resource = JamKampusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
