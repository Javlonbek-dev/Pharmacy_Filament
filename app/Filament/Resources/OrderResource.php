<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Order::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->persistFiltersInSession()
            ->filtersTriggerAction(function ($action) {
                return $action->button()->label('Filter');
            })
            ->columns([
                Tables\Columns\TextColumn::make('customer.user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(function ($state) {
                        return Status::from($state)->getColor();
                    }),

            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('received')
                        ->icon('heroicon-o-check-circle')
                        ->visible(function ($record) {
                            return $record->status === Status::Completed;
                        })
                        ->requiresConfirmation()
                        ->color('success')
                        ->action(function (Order $record) {
                            $record->received();
                        })->after(function () {
                            Notification::make()->success()->title('This order received successfully!')
                                ->duration(1000)
                                ->body('This order received successfully!')
                                ->send();
                        }),
                    Tables\Actions\Action::make('cancelled')
                        ->icon('heroicon-o-no-symbol')
                        ->requiresConfirmation()
                        ->color('danger')
                        ->action(function (Order $record) {
                            $record->cancelled();
                        })->after(function () {
                            Notification::make()->danger()->title('This order cancelled!')
                                ->duration(1000)
                                ->body('This order cancelled successfully!')
                                ->send();
                        })
                ]),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
