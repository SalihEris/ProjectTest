<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('person_id')
                    ->label('Person')
                    ->options(
                        Person::all()->pluck('first_name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(10),

                Forms\Components\Select::make('employee_type')
                    ->label('Employee Type')
                    ->options([
                        'Assistant' => 'Assistant',
                        'Dental Hygienist' => 'Dental Hygienist',
                        'Dentist' => 'Dentist',
                        'Practice Management' => 'Practice Management',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('specialization')
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->required(),

                Forms\Components\Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }
        public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('person.first_name')
                    ->label('Employee Name'),

                Tables\Columns\TextColumn::make('id')
                    ->label('Employee Id'),

                Tables\Columns\TextColumn::make('person_id')
                    ->numeric()
                    ->label('Person Id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('number')
                    ->label('Employee Number')
                    ->searchable(),

                Tables\Columns\TextColumn::make('employee_type'),

                Tables\Columns\TextColumn::make('specialization')
                    ->label('Specialization')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
