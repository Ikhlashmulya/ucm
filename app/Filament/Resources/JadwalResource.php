<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalResource\Pages;
use App\Filament\Resources\JadwalResource\RelationManagers;
use App\Models\Jadwal;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

/*
 * !TODO : Masih memikirkan Algoritmanya pusing 😉
 */

class JadwalResource extends Resource
{
    protected static ?string $model = Jadwal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 7;

    protected static ?string $label = "Jadwal";

    protected static ?string $navigationLabel = 'Jadwal';

    protected static ?string $navigationGroup = 'Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('dosen_id')
                    ->relationship('dosen', 'nama')
                    ->required(),
                Select::make('prodi_id')
                    ->relationship('prodi', 'nama_prodi')
                    ->required(),
                Select::make('mata_kuliah_id')
                    ->relationship('mataKuliah', 'nama_matkul')
                    ->required(),
                TextInput::make('semester')
                    ->numeric()
                    ->required(),
                TextInput::make('sks')
                    ->numeric()
                    ->required(),
                Select::make('ruangan_id')
                    ->relationship('ruangan', 'nama_ruangan')
                    ->required(),
                Select::make('hari')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu'
                    ]),
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
                //
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
            'index' => Pages\ListJadwals::route('/'),
            'create' => Pages\CreateJadwal::route('/create'),
            'edit' => Pages\EditJadwal::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel(): ?string
    {
        return 'Jadwal';
    }
}
