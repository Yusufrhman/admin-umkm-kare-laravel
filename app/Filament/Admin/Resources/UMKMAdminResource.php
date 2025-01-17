<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UMKMAdminResource\Pages;
use App\Models\UMKM;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UMKMAdminResource extends Resource
{
    protected static ?string $model = UMKM::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    public static function getNavigationLabel(): string
    {
        // Cek jika role_id adalah 3, label akan "UMKM Saya", jika tidak tampilkan "UMKM"
        if (auth()->user()->role_id === 3) {
            return "UMKM Saya";
        }
        return "UMKM"; // Default untuk selain role_id 3
    }

    public static function getModelLabel(): string
    {
        return "UMKM";
    }
    protected static ?string $slug = 'UMKM';


    public static function getPluralModelLabel(): string
    {
        return 'Daftar UMKM'; // Plural label
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('umkm_name')
                    ->label("Nama UMKM")
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label("Deskripsi")
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('main_image')
                    ->label("Gambar")
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('nomer_wa')
                    ->label("Nomor Whatsapp")
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('instagram')
                    ->maxLength(255)
                    ->default(null)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada UMKM')
            ->columns([
                Tables\Columns\TextColumn::make('umkm_name')
                    ->label("Nama UMKM")
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomer_wa')
                    ->label("Nomor Whatsapp")
                    ->searchable(),
                Tables\Columns\TextColumn::make('instagram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Pemilik")
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListAdminUMKMS::route('/'),
            'create' => Pages\CreateAdminUMKM::route('/create'),
            'edit' => Pages\EditAdminUMKM::route('/{record}/edit'),
        ];
    }
}
