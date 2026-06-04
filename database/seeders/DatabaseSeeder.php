<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Profile;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );

        Profile::create([
            'name' => 'Rupak Ranjan Mohanta',
            'subtitle' => 'React Native developer',
            'description' => 'I design and build beautiful, user-friendly web experiences that make an impact.',
            'hero_image' => 'hero_character_1777704026776.png',
            'available_for_freelance' => true,
            'email' => 'rupak@example.com',
            'linkedin_url' => 'https://linkedin.com/in/rupak',
            'github_url' => 'https://github.com/rupak',
            'about_title' => "I'm a passionate designer who loves creating.",
            'about_description' => "I specialize in UI/UX design and frontend development. I enjoy turning complex problems into simple, beautiful and intuitive designs.",
            'experience_years' => '3+',
            'projects_completed' => '50+',
            'happy_clients' => '30+',
            'awards_received' => '10+',
        ]);

        Project::create([
            'title' => 'TaskFlow Dashboard',
            'category' => 'UI/UX Design',
            'description' => 'A modern dashboard interface for task management and team collaboration.',
            'card_theme' => 'purple',
            'card_icon' => 'fa-solid fa-chart-pie',
            'card_tag' => 'UI/UX',
            'image_path' => 'project_dashboard_1777704042616.png'
        ]);
        Project::create([
            'title' => 'Agency Website',
            'category' => 'Frontend Development',
            'description' => 'Clean and responsive agency website built for a digital studio.',
            'card_theme' => 'orange',
            'card_icon' => 'fa-solid fa-globe',
            'card_tag' => 'Frontend',
            'image_path' => 'project_agency_1777704055843.png'
        ]);
        Project::create([
            'title' => 'E-Commerce Store',
            'category' => 'UI/UX & Development',
            'description' => 'Full-featured online store with product listings and cart functionality.',
            'card_theme' => 'green',
            'card_icon' => 'fa-solid fa-cart-shopping',
            'card_tag' => 'Full Stack',
            'image_path' => 'project_ecommerce_1777704074943.png'
        ]);
        Project::create([
            'title' => 'Personal Portfolio',
            'category' => 'UI/UX & Development',
            'description' => 'Personal portfolio showcasing my work, skills, and experience.',
            'card_theme' => 'blue',
            'card_icon' => 'fa-solid fa-user',
            'card_tag' => 'Frontend',
            'image_path' => 'project_portfolio_1777704102718.png'
        ]);

        Service::create([
            'title' => 'UI/UX Design',
            'description' => 'Designing intuitive and engaging user experiences that users love.',
            'icon' => 'fa-desktop'
        ]);
        Service::create([
            'title' => 'Frontend Development',
            'description' => 'Building responsive and high-performance websites.',
            'icon' => 'fa-code'
        ]);
        Service::create([
            'title' => 'Branding',
            'description' => 'Creating unique brand identities that stand out.',
            'icon' => 'fa-pen-nib'
        ]);
        Service::create([
            'title' => 'Illustration',
            'description' => 'Crafting clean and modern illustrations for websites.',
            'icon' => 'fa-image'
        ]);

        \App\Models\Skill::create(['name' => 'Figma', 'icon_class' => 'fa-brands fa-figma', 'order' => 1]);
        \App\Models\Skill::create(['name' => 'HTML5', 'icon_class' => 'fa-brands fa-html5', 'color' => '#E34F26', 'order' => 2]);
        \App\Models\Skill::create(['name' => 'CSS3', 'icon_class' => 'fa-brands fa-css3-alt', 'color' => '#1572B6', 'order' => 3]);
        \App\Models\Skill::create(['name' => 'JavaScript', 'icon_class' => 'fa-brands fa-js', 'color' => '#F7DF1E', 'order' => 4]);
        \App\Models\Skill::create(['name' => 'React', 'icon_class' => 'fa-brands fa-react', 'color' => '#61DAFB', 'order' => 5]);
        \App\Models\Skill::create(['name' => 'Tailwind', 'icon_class' => 'fa-solid fa-wind', 'color' => '#38B2AC', 'order' => 6]);
        \App\Models\Skill::create(['name' => 'Git', 'icon_class' => 'fa-brands fa-git-alt', 'color' => '#F05032', 'order' => 7]);

        \App\Models\Process::create([
            'title' => 'Understand',
            'description' => 'I analyze your requirements.',
            'icon' => 'fa-regular fa-lightbulb',
            'step_number' => 1
        ]);
        \App\Models\Process::create([
            'title' => 'Design',
            'description' => 'I wireframe and design the solution.',
            'icon' => 'fa-solid fa-pen-nib',
            'step_number' => 2
        ]);
        \App\Models\Process::create([
            'title' => 'Develop',
            'description' => 'I build clean and responsive code.',
            'icon' => 'fa-solid fa-code',
            'step_number' => 3
        ]);
        \App\Models\Process::create([
            'title' => 'Test',
            'description' => 'I test for quality and performance.',
            'icon' => 'fa-solid fa-vial',
            'step_number' => 4
        ]);
        \App\Models\Process::create([
            'title' => 'Launch',
            'description' => 'I deliver and deploy the final product.',
            'icon' => 'fa-solid fa-rocket',
            'step_number' => 5
        ]);

        Testimonial::create([
            'client_name' => 'Rohit Verma',
            'client_title' => 'CEO, TechNova',
            'text' => 'Rupak is a highly skilled designer who delivered beyond our expectations. Highly recommended!',
            'avatar_url' => 'https://i.pravatar.cc/150?img=11'
        ]);
        Testimonial::create([
            'client_name' => 'Priya Singh',
            'client_title' => 'Founder, Shopfly',
            'text' => 'Great communication, fast delivery and outstanding quality. Will definitely work with him again.',
            'avatar_url' => 'https://i.pravatar.cc/150?img=5'
        ]);
        Testimonial::create([
            'client_name' => 'Arjun Mehta',
            'client_title' => 'Marketing Head, GrowthX',
            'text' => 'Amazing work on our website redesign. The attention to detail was incredible.',
            'avatar_url' => 'https://i.pravatar.cc/150?img=68'
        ]);
    }
}
