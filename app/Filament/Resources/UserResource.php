<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required()->disabledOn('edit'),
                Forms\Components\TextInput::make('current_password')->visibleOn('edit'),
                Forms\Components\TextInput::make('password')->password()->confirmed()->visibleOn('edit'),
                Forms\Components\TextInput::make('password_confirmation')->password()->visibleOn('edit'),
                Forms\Components\TextInput::make('password')->password()->confirmed()->required()->visibleOn('create'),
                Forms\Components\TextInput::make('password_confirmation')->password()->required()->visibleOn('create'),
                Forms\Components\Checkbox::make('is_active')->default(1),
                Forms\Components\Checkbox::make('is_super_admin')->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Active'),
                Tables\Columns\IconColumn::make('is_super_admin')->boolean()->label('Super'),
                Tables\Columns\TextColumn::make('updated_at')->date('M d, Y H:i:s')->label('Last Login')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
