<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('owner_id')
                    ->required()
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->preload()
              
                    ->createOptionForm([
                      Forms\Components\TextInput::make('name')
                          ->required()
                          ->maxLength(255),
                      Forms\Components\TextInput::make('email')
                          ->label('Email address')
                          ->email()
                          ->required()
                          ->maxLength(255),
                      Forms\Components\TextInput::make('phone')
                          ->label('Phone number')
                          ->tel()
                          ->required(),
                    ]),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options([
                      'cat' => 'Cat',
                      'dog' => 'Dog',
                      'rabbit' => 'Rabbit'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /**/
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('owner.name')->label('Owner')                    
                    ->sortable(),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePatients::route('/'),
        ];
    }
    
   
    public static function getRelations(): array {
      return [
        RelationManagers\TreatmentsRelationManager::class,
      ];
    }
}
