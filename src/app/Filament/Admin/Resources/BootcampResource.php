<?php

namespace App\Filament\Admin\Resources;

use App\Models\Bootcamp;
use App\Filament\Admin\Resources\BootcampResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BootcampResource extends Resource
{
    protected static ?string $model = Bootcamp::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Bootcamp')
                    ->required(),

                Forms\Components\Select::make('branch_office_id')
                    ->label('Cabang')
                    ->relationship('branchOffice', 'nama')
                    ->searchable()
                    ->required(),


                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('branchOffice.nama')->label('Cabang'),
                Tables\Columns\TextColumn::make('tanggal_mulai')->label('Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai')->label('Selesai'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBootcamps::route('/'),
            'create' => Pages\CreateBootcamp::route('/create'),
            'edit' => Pages\EditBootcamp::route('/{record}/edit'),
        ];
    }
}
