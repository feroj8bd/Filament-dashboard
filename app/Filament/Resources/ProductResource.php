<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Components\Number;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Textarea::make('description')
                    ->label('Description'),
                TextInput::make('price')
                    ->label('Price')
                    ->required(),
                // SpatieMediaLibraryFileUpload::make('image')
                //      ->collection('image'),
                FileUpload::make('image'),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug') // This field is hidden in the form
                    ->hidden()
                    ->default(fn ($record) => \Illuminate\Support\Str::slug($record->name ?? '')),
               TextInput::make('brand')
                    ->label('Brand')
                    ->required(),
               TextInput::make('model')
                    ->label('Model'),
                TextInput::make('color')
                    ->label('Color'),
                TextInput::make('size')
                    ->label('Size'),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->required(),
                TextInput::make('stock')
                    ->numeric(),
                TextInput::make('meta_title')
                    ->label('Meta Title')
            ]);
           
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                // TextColumn::make('description'),
                TextColumn::make('price'),
                TextColumn::make('sku'),
                TextColumn::make('brand'),
                // TextColumn::make('model'),
                // TextColumn::make('color'),
                // TextColumn::make('size'),
                // TextColumn::make('stock'),
                TextColumn::make('status'),
                ImageColumn::make('image')
                ->circular()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
                SelectFilter::make('brand')
                    ->options(
                        Product::query()
                            ->pluck('brand', 'brand')
                            ->toArray()
                    ),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                
                    ])
                    ->dropdownPlacement('top-start')
              
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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