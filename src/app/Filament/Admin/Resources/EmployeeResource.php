<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Organisasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->label('Akun User')
                ->relationship('user', 'name') // Mengambil dari relasi ke model User
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('nama')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('telepon')->label('No. Telepon'),
            DatePicker::make('tanggal_lahir')->label('Tanggal Lahir'),
            FileUpload::make('foto')->image()->directory('pegawai'),

            TextInput::make('jabatan')->label('Jabatan / Posisi')->required(),

            Select::make('branch_office_id')
                ->label('Cabang')
                ->relationship('branchOffice', 'nama')
                ->required(),

            Select::make('department_id')
                ->label('Departemen')
                ->relationship('department', 'nama_departemen')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Akun'),
                TextColumn::make('nama')->searchable(),
                TextColumn::make('email'),
                TextColumn::make('jabatan'),
                TextColumn::make('department.nama_departemen')->label('Departemen'),
                TextColumn::make('branchOffice.nama')->label('Cabang'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
