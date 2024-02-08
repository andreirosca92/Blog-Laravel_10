<?php

namespace App\Filament\Resources;

use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Main Content')->Schema(
                    [
                    TextInput::make('title')
                    ->live()
                    ->required()->minLength(1)
                    ->maxLength(150)
                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                        // dd($operation);
                        if ($operation === 'edit') {
                            return;
                        }
                        $set('slug', Str::slug($state));
                    }),
                    TextInput::make('slug')->required()->unique(ignoreRecord: true)->minLength(1)->maxLength(150),
                    RichEditor::make('body')->required()->fileAttachmentsDirectory('posts/images')->columnSpanFull(),
                    ]
                )->columns(2),
                Section::make('Meta')->Schema(
                    [
                        FileUpload::make('image')->image()->directory('posts/thumbnails'),
                        DatePicker::make('published_at')->nullable(),
                        Checkbox::make('featured'),
                        Select::make('user_id')
                            ->relationship('author', 'name')
                            ->searchable()
                            ->required(),
                        Select::make('categories')
                            ->multiple()
                            ->relationship('categories', 'title')
                            ->searchable(),
                            
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ImageColumn::make('image'),
            TextColumn::make('title')->sortable()->searchable(),
            TextColumn::make('slug')->sortable()->searchable(),
            TextColumn::make('author.name')->sortable()->searchable(),
            TextColumn::make('published_at')->date('d-m-Y')->sortable()->searchable(),
            CheckboxColumn::make('featured'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
