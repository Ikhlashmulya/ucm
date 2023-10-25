<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JamKampusResource\Pages;
use App\Filament\Resources\JamKampusResource\RelationManagers;
use App\Models\JamKampus;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JamKampusResource extends Resource
{
    protected static ?string $model = JamKampus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 0;

    protected static ?string $label = "Jam Kampus";

    protected static ?string $navigationLabel = 'Jam Kampus';

    protected static ?string $navigationGroup = 'Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TimePicker::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->required(),
                TimePicker::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jam_mulai')
                    ->label('Jam Mulai'),
                TextColumn::make('jam_selesai')
                    ->label('Jam Selesai')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListJamKampuses::route('/'),
            'create' => Pages\CreateJamKampus::route('/create'),
            'edit' => Pages\EditJamKampus::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel(): ?string
    {
        return 'Jam Kampus';
    }
}
