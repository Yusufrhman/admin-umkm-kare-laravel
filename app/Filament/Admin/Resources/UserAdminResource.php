<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
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

class UserAdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';
    protected static ?string $slug = 'pengguna';

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
                        $userRoleId = auth()->user()->role_id;

                        if ($userRoleId == 1) {
                            return \App\Models\Role::whereIn('id', [2, 3])->pluck('role_name', 'id');
                        }

                        if ($userRoleId == 2) {
                            return \App\Models\Role::where('id', 3)->pluck('role_name', 'id');
                        }

                        return [];
                    })
                    ->required()
                    ->searchable()
                    ->rules([
                        function () {
                            return function ($attribute, $value, $fail) {
                                $userRoleId = auth()->user()->role_id;

                                // Cegah siapa pun memilih role_id 1
                                if ($value == 1) {
                                    $fail('Anda tidak diizinkan memilih peran ini.');
                                }

                                // Jika yang login bukan role_id 1, hanya boleh memilih role_id 3
                                if ($userRoleId != 1 && $value != 3) {
                                    $fail('Anda tidak diizinkan memilih peran ini.');
                                }
                                return;
                            };
                        }
                    ]),
                Forms\Components\Select::make('status')
                    ->label('Status')
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
            ->emptyStateHeading('Belum ada Pengguna')
            ->modifyQueryUsing(function (Builder $query) {
                $userRoleId = auth()->user()->role_id;

                if ($userRoleId == 1) {
                    return $query->whereIn('role_id', [2, 3]);
                    ;
                }

                if ($userRoleId == 2) {
                    return $query->where('role_id', 3);
                }

                return $query->whereRaw('1=0');
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
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->color(fn($state) => $state ? 'success' : 'danger'),
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
            'index' => Pages\ListAdminUsers::route('/'),
            'create' => Pages\CreateAdminUser::route('/create'),
            'edit' => Pages\EditAdminUser::route('/{record}/edit'),
        ];
    }
}
