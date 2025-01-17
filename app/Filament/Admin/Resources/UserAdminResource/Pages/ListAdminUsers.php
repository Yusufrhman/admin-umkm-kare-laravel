<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserAdminResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;

class ListAdminUsers extends ListRecords
{
    protected static string $resource = UserAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label("Tambah Pengguna"), // Change the text of the "Create" button globally
        ];
    }
}
