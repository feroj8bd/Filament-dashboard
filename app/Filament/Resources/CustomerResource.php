<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone'),
                Forms\Components\TextInput::make('address')
                    ->label('Address')
                    ->required(),
                    
                Forms\Components\Select::make('division')
                    // ->multiple()
                    ->label('Division')
                    ->options([
                        'dhaka' => 'Dhaka',
                        'mymensingh' => 'Mymensingh',
                        'rajshahi' => 'Rajshahi',
                    ])
                    ->required(),
                Forms\Components\Select::make('district')
                    ->label('District')
                    ->options([
                        'dhaka' => 'Dhaka Inside',
                        'mymensingh Sadar' => 'Mymensingh Sadar',
                        'rajshahi Sadar' => 'Rajshahi Sadar',
                    ])
                    // ->native(false)
                    ->required(),
                
                Forms\Components\Select::make('area')
                    ->label('Area')
                    ->options([
                        'dhaka' => 'Dhaka Inside',
                        'mymensingh ' => 'Mymensingh Sadar',
                        'rajshahi mamur para' => 'Rajshahi mamur para',
                    ])
                    ->required(),
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Sl No')
                    ->rowIndex(),
                TextColumn::make('name'),
                    // ->searchable(),
                // TextColumn::make('description'),
                TextColumn::make('email')
                    ->label('Email'),
                TextColumn::make('phone')
                    ->label('Phone'),
                TextColumn::make('address')
                    ->label('Address')
                    ->formatStateUsing(function ($state, $record) {
                        return "{$record->address}, {$record->area}, {$record->district}, {$record->division}";
                    }),
                
                    
            ])
            ->filters([
                //
            ])
            ->actions([
                 Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
                    ->dropdownPlacement('top-start')
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}