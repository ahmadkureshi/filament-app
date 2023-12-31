<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuardiansRelationManager extends RelationManager
{
    protected static string $relationship = 'guardians';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('relation_type')
                    ->options([
                        'Father' => 'Father',
                        'Mother' => 'Mother',
                        'Brother' => 'Brother',
                        'Sister' => 'Sister',
                    ])->label('Select the relation type'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('contact_number'),
                Tables\Columns\TextColumn::make('relation_type'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('relation_type')
                    ->options([
                        'Father' => 'Father',
                        'Mother' => 'Mother',
                        'Brother' => 'Brother',
                        'Sister' => 'Sister',
                    ])->label('Select the relation type'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
