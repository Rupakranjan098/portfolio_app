<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                FileUpload::make('image_path')
                    ->image()
                    ->required(),
                TextInput::make('project_url')
                    ->url()
                    ->label('Project URL'),
                TextInput::make('github_url')
                    ->url()
                    ->label('GitHub URL'),
                FileUpload::make('additional_images')
                    ->multiple()
                    ->image()
                    ->label('Additional Design/Gallery Images'),
            ]);
    }
}
