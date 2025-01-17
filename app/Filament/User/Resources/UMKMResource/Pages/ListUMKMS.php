<?php

namespace App\Filament\User\Resources\UMKMResource\Pages;

use App\Filament\User\Resources\UMKMResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\UMKM;
use Illuminate\Database\Eloquent\Builder;

class ListUMKMS extends ListRecords
{
    protected static string $resource = UMKMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label("Tambah UMKM"),
        ];
    }

    // Menambahkan filter berdasarkan role_id
    protected function getTableQuery(): Builder
    {
        if (auth()->user()->role_id === 3) {
            // Jika bukan admin, tampilkan UMKM yang hanya dimiliki oleh user yang sedang login
            return UMKM::query()->where('user_id', auth()->id()); // Filter berdasarkan user_id
        }
        // Jika role_id = 1 atau 2, tampilkan semua UMKM
        return UMKM::query(); // Tampilkan semua data UMKM

    }
}

