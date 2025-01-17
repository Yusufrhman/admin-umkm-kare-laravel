<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = "Produk";


    // app/Filament/Resources/ProductResource.php

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp. '),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('umkm_id')
                    ->label('UMKM')
                    ->required()
                    ->options(function () {
                        $currentUserId = auth()->id();
                        return \App\Models\UMKM::where('user_id', $currentUserId)
                            ->pluck('umkm_name', 'id');
                    }),
                // Menambahkan Select untuk kategori dengan multiple options
                // Select::make('categories')
                //     ->label('Categories')
                //     ->multiple()
                //     ->required()
                //     ->options(function () {
                //         return Category::pluck('name', 'id');
                //     })
                //     ->relationship('categories', 'name')
                //     ->searchable(false),
                Repeater::make('images')
                    ->relationship()
                    ->schema([
                        Forms\Components\FileUpload::make('image_url')
                            ->image()
                            ->disk('public')
                            ->directory('product_images')
                            ->label('Additional Image')
                            ->required()
                            ->reactive(),
                    ])
                    ->columns(1)
                    ->createItemButtonLabel('Add New Image')
                    ->minItems(3)
                    ->maxItems(5),

            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    // ->money("")
                    ->numeric()
                    ->prefix("Rp. ")
                    ->sortable(),
                Tables\Columns\ImageColumn::make('main_image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('umkm.umkm_name')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
