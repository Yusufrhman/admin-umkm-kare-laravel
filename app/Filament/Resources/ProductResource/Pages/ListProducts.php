<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder
    {
        if (auth()->user()->role_id === 3) {
            // Jika role_id adalah 3, tampilkan produk yang terkait dengan UMKM milik user yang sedang login
            return Product::query()
                ->whereHas('umkm', function (Builder $query) {
                    $query->where('user_id', auth()->id()); // Filter UMKM yang dimiliki oleh user yang sedang login
                });
        }

        // Jika role_id adalah 1 atau 2 (misalnya admin), tampilkan semua produk
        return Product::query();
    }
}
