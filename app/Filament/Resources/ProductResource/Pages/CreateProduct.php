<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Filament\Forms\Components\TextInput;
class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    

}
TextInput::make('name')
    ->label('Name')
    ->placeholder('Enter the name of the product')
    ->required();  