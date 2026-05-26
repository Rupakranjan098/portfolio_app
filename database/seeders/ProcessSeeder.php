<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Process;

class ProcessSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            ['title' => 'Understand', 'description' => 'I analyze your requirements.', 'icon' => 'fa-regular fa-lightbulb', 'step_number' => 1],
            ['title' => 'Design', 'description' => 'I wireframe and design the solution.', 'icon' => 'fa-solid fa-pen-nib', 'step_number' => 2],
            ['title' => 'Develop', 'description' => 'I build clean and responsive code.', 'icon' => 'fa-solid fa-code', 'step_number' => 3],
            ['title' => 'Test', 'description' => 'I test for quality and performance.', 'icon' => 'fa-solid fa-flask', 'step_number' => 4],
            ['title' => 'Launch', 'description' => 'I deliver and deploy the final product.', 'icon' => 'fa-solid fa-rocket', 'step_number' => 5],
        ];

        foreach ($steps as $step) {
            Process::create($step);
        }
    }
}
