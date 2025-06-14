<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BranchOfficeResource\Pages;
use App\Models\BranchOffice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;

class BranchOfficeResource extends Resource
{
    protected static ?string $model = BranchOffice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Organisasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Cabang')
                    ->required(),

                TextInput::make('alamat')
                    ->label('Alamat Cabang')
                    ->nullable(),

                Select::make('user_id')
                    ->label('Penanggung Jawab / Manajer')
                    ->relationship(
                        name: 'manager',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => 
                            $query->whereHas('roles', fn ($q) => $q->where('name', 'manajer'))
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('departments')
                    ->label('Departemen yang Tersedia')
                    ->multiple()
                    ->relationship('departments', 'nama_departemen')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Cabang'),

                TextColumn::make('alamat')
                    ->label('Alamat'),

                TextColumn::make('manager.name')
                    ->label('Manajer'),

                BadgeColumn::make('departments.nama_departemen')
                    ->label('Departemen')
                    ->separator(','),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranchOffices::route('/'),
            'create' => Pages\CreateBranchOffice::route('/create'),
            'edit' => Pages\EditBranchOffice::route('/{record}/edit'),
        ];
    }
}
