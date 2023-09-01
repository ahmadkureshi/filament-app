<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->minLength(5)
                    ->maxLength(255),
                Forms\Components\TextInput::make('student_id')
                    ->required()
                    ->minLength(8),
                Forms\Components\TextInput::make('address_1'),
                Forms\Components\TextInput::make('address_2'),
                Forms\Components\Select::make('standard_id')
                    ->required()
                    ->relationship('standard', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('standard.name')->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('start')
                    ->query(fn (Builder $query): Builder => $query->where('standard_id','1')),
                Tables\Filters\SelectFilter::make('standard_id')
                    ->options([
                        1 => 'Standard 1',
                        3 => 'Standard 3',
                        7 => 'Standard 7',
                    ])->label('Select the standard'),
                Tables\Filters\SelectFilter::make('All Standards')
                    ->relationship('standard', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
