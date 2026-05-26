<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_name')
                    ->required(),
                TextInput::make('client_title')
                    ->required(),
                Textarea::make('text')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('avatar_url')
                    ->url(),
            ]);
    }
}
