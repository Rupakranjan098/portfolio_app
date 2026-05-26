<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'Laravel', 'icon_class' => 'devicon-laravel-original colored'],
            ['name' => 'React Native', 'icon_class' => 'devicon-react-original colored'],
            ['name' => 'React JS', 'icon_class' => 'devicon-react-original colored'],
            ['name' => 'JavaScript', 'icon_class' => 'devicon-javascript-plain colored'],
            ['name' => 'PHP', 'icon_class' => 'devicon-php-plain colored'],
            ['name' => 'HTML5', 'icon_class' => 'devicon-html5-plain colored'],
            ['name' => 'CSS3', 'icon_class' => 'devicon-css3-plain colored'],
            ['name' => 'WordPress', 'icon_class' => 'devicon-wordpress-plain colored'],
            ['name' => 'Postman', 'icon_class' => 'devicon-postman-plain colored'],
            ['name' => 'Expo', 'icon_class' => 'devicon-expo-plain colored'],
        ];

        foreach ($skills as $index => $skill) {
            Skill::create(array_merge($skill, ['order' => $index]));
        }
    }
}
