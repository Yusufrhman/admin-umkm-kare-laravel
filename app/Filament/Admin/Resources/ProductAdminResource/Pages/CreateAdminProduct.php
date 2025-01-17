<?php

namespace App\Filament\Admin\Resources\ProductAdminResource\Pages;

use App\Filament\Admin\Resources\ProductAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdminProduct extends CreateRecord
{
    protected static string $resource = ProductAdminResource::class;
}
