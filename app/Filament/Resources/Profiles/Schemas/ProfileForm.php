<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('subtitle')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('hero_image')
                    ->image(),
                Toggle::make('available_for_freelance')
                    ->required(),
                TextInput::make('cv_path'),
                TextInput::make('github_url')
                    ->url()
                    ->label('GitHub URL'),
                TextInput::make('linkedin_url')
                    ->url()
                    ->label('LinkedIn URL'),
                TextInput::make('twitter_url')
                    ->url()
                    ->label('Twitter URL'),
                TextInput::make('website_url')
                    ->url()
                    ->label('Website URL'),
            ]);
    }
}
