<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AvailabilityResource\Pages;
use App\Models\Availability;
use App\Models\Employee;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AvailabilityResource extends Resource
{
    protected static ?string $model = Availability::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->label('Employee')
                    ->options(Employee::all()->pluck('number', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\DatePicker::make('date_from')
                    ->label('Start Date')
                    ->required()
                    ->rules('date_format:Y-m-d'),

                Forms\Components\DatePicker::make('date_to')
                    ->label('End Date')
                    ->required()
                    ->rules('date_format:Y-m-d'),

                Forms\Components\TimePicker::make('time_from')
                    ->label('Start Time')
                    ->required()
                    ->rules(['date_format:H:i:s']),

                Forms\Components\TimePicker::make('time_to')
                    ->label('End Time')
                    ->required()
                    ->rules(['date_format:H:i:s']),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Present' => 'Present',
                        'Absent' => 'Absent',
                        'On Leave' => 'On Leave',
                        'Sick' => 'Sick',
                    ])
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),

                Forms\Components\Textarea::make('note')
                    ->label('Note')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.id')
                    ->label('Employee Id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('employee.number')
                    ->label('Employee Number')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_from')
                    ->label('Start Date')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_to')
                    ->label('End Date')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time_from')
                    ->label('Start Time')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time_to')
                    ->label('End Time')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
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
            'index' => Pages\ListAvailabilities::route('/'),
            'create' => Pages\CreateAvailability::route('/create'),
            'edit' => Pages\EditAvailability::route('/{record}/edit'),
        ];
    }
}
