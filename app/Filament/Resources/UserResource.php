<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';


    protected static ?string $navigationLabel = "Pengguna";

    public static function getModelLabel(): string
    {
        return 'Pengguna'; // Singular label
    }

    public static function getPluralModelLabel(): string
    {
        return 'Daftar Pengguna'; // Plural label
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama') // Label in Bahasa Indonesia
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('Kata Sandi')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create')
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_telp')
                    ->label('No. Telepon')
                    ->tel()
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Select::make('role_id')
                    ->label('Pilih Peran')
                    ->options(function () {
                        // Menampilkan role_id 2 dan 3 dari tabel roles
                        return \App\Models\Role::whereIn('id', [2, 3])->pluck('role_name', 'id');
                    })
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('status')
                    ->label('status')
                    ->options([
                        true => 'Aktif',
                        false => 'Tidak Aktif',
                    ])
                    ->required()
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('role_id', '!=', 1);
            })
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('no_telp')
                    ->label('No. Telepon')
                    ->searchable(),
                TextColumn::make('role.role_name')
                    ->label('Peran'),
                BooleanColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle') // Ikon hijau untuk "Aktif"
                    ->falseIcon('heroicon-o-x-circle')  // Ikon merah untuk "Tidak Aktif"
                    ->color(fn($state) => $state ? 'success' : 'danger'), // Warna hijau jika aktif, merah jika tidak aktif
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
