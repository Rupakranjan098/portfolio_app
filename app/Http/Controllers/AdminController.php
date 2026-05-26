<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'testimonials' => Testimonial::count(),
            'skills' => \App\Models\Skill::count(),
            'processes' => \App\Models\Process::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    // Projects
    public function projects()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function projectCreate()
    {
        return view('admin.projects.create');
    }

    public function projectStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'project_url' => 'nullable|url',
            'image_path' => 'required|image',
            'document_path' => 'nullable|file|mimes:pdf,doc,docx,zip|max:10240'
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('projects', 'public');
        }

        if ($request->hasFile('document_path')) {
            $data['document_path'] = $request->file('document_path')->store('project_docs', 'public');
        }

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function projectEdit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function projectUpdate(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'project_url' => 'nullable|url',
            'image_path' => 'nullable|image',
            'document_path' => 'nullable|file|mimes:pdf,doc,docx,zip|max:10240'
        ]);

        if ($request->hasFile('image_path')) {
            if ($project->image_path) Storage::disk('public')->delete($project->image_path);
            $data['image_path'] = $request->file('image_path')->store('projects', 'public');
        }

        if ($request->hasFile('document_path')) {
            if ($project->document_path) Storage::disk('public')->delete($project->document_path);
            $data['document_path'] = $request->file('document_path')->store('project_docs', 'public');
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function projectDestroy(Project $project)
    {
        if ($project->image_path) Storage::disk('public')->delete($project->image_path);
        if ($project->document_path) Storage::disk('public')->delete($project->document_path);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    // Services
    public function services()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function serviceCreate()
    {
        return view('admin.services.create');
    }

    public function serviceStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required'
        ]);

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function serviceEdit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function serviceUpdate(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required'
        ]);

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function serviceDestroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    // Testimonials
    public function testimonials()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function testimonialCreate()
    {
        return view('admin.testimonials.create');
    }

    public function testimonialStore(Request $request)
    {
        $data = $request->validate([
            'client_name' => 'required',
            'client_title' => 'required',
            'text' => 'required',
            'avatar_url' => 'nullable|image|url'
        ]);

        if ($request->hasFile('avatar_url')) {
            $data['avatar_url'] = $request->file('avatar_url')->store('avatars', 'public');
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function testimonialEdit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function testimonialUpdate(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'client_name' => 'required',
            'client_title' => 'required',
            'text' => 'required',
            'avatar_url' => 'nullable'
        ]);

        if ($request->hasFile('avatar_url')) {
            if ($testimonial->avatar_url && !str_starts_with($testimonial->avatar_url, 'http')) {
                Storage::disk('public')->delete($testimonial->avatar_url);
            }
            $data['avatar_url'] = $request->file('avatar_url')->store('avatars', 'public');
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function testimonialDestroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar_url && !str_starts_with($testimonial->avatar_url, 'http')) {
            Storage::disk('public')->delete($testimonial->avatar_url);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }

    // Profile
    public function profile()
    {
        $profile = Profile::first();
        return view('admin.profile', compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        $profile = Profile::first();
        $data = $request->validate([
            'name' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'location' => 'nullable',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'about_title' => 'nullable',
            'about_description' => 'nullable',
            'experience_years' => 'nullable',
            'projects_completed' => 'nullable',
            'happy_clients' => 'nullable',
            'awards_received' => 'nullable',
            'hero_image' => 'nullable|image',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
        ]);

        $data['available_for_freelance'] = $request->has('available_for_freelance');

        if ($request->hasFile('hero_image')) {
            if ($profile->hero_image && !str_starts_with($profile->hero_image, '/')) {
                Storage::disk('public')->delete($profile->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('profile', 'public');
        }

        if ($request->hasFile('cv_path')) {
            if ($profile->cv_path) {
                Storage::disk('public')->delete($profile->cv_path);
            }
            $data['cv_path'] = $request->file('cv_path')->store('cv', 'public');
        }

        $profile->update($data);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // Skills CRUD
    public function skillsIndex()
    {
        $skills = \App\Models\Skill::orderBy('order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function skillsCreate()
    {
        return view('admin.skills.form');
    }

    public function skillsStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'icon_class' => 'nullable',
            'icon_file' => 'nullable|image',
        ]);

        if ($request->hasFile('icon_file')) {
            $data['icon_class'] = $request->file('icon_file')->store('skills', 'public');
        }

        unset($data['icon_file']);

        \App\Models\Skill::create($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill added successfully.');
    }

    public function skillsEdit(\App\Models\Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function skillsUpdate(Request $request, \App\Models\Skill $skill)
    {
        $data = $request->validate([
            'name' => 'required',
            'icon_class' => 'nullable',
            'icon_file' => 'nullable|image',
        ]);

        if ($request->hasFile('icon_file')) {
            if (str_starts_with($skill->icon_class, 'skills/')) {
                Storage::disk('public')->delete($skill->icon_class);
            }
            $data['icon_class'] = $request->file('icon_file')->store('skills', 'public');
        }

        unset($data['icon_file']);

        $skill->update($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function skillsDestroy(\App\Models\Skill $skill)
    {
        if (str_starts_with($skill->icon_class, 'skills/')) {
            Storage::disk('public')->delete($skill->icon_class);
        }
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }

    // Process CRUD
    public function processesIndex()
    {
        $processes = \App\Models\Process::orderBy('step_number')->get();
        return view('admin.processes.index', compact('processes'));
    }

    public function processesCreate()
    {
        return view('admin.processes.form');
    }

    public function processesStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'nullable',
            'icon_file' => 'nullable|image',
            'step_number' => 'required|integer'
        ]);

        if ($request->hasFile('icon_file')) {
            $data['icon'] = $request->file('icon_file')->store('processes', 'public');
        }

        unset($data['icon_file']);

        \App\Models\Process::create($data);
        return redirect()->route('admin.processes.index')->with('success', 'Process step added successfully.');
    }

    public function processesEdit(\App\Models\Process $process)
    {
        return view('admin.processes.form', compact('process'));
    }

    public function processesUpdate(Request $request, \App\Models\Process $process)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'nullable',
            'icon_file' => 'nullable|image',
            'step_number' => 'required|integer'
        ]);

        if ($request->hasFile('icon_file')) {
            if (str_starts_with($process->icon, 'processes/')) {
                Storage::disk('public')->delete($process->icon);
            }
            $data['icon'] = $request->file('icon_file')->store('processes', 'public');
        }

        unset($data['icon_file']);

        $process->update($data);
        return redirect()->route('admin.processes.index')->with('success', 'Process step updated successfully.');
    }

    public function processesDestroy(\App\Models\Process $process)
    {
        if (str_starts_with($process->icon, 'processes/')) {
            Storage::disk('public')->delete($process->icon);
        }
        $process->delete();
        return redirect()->route('admin.processes.index')->with('success', 'Process step deleted successfully.');
    }

    public function documentation()
    {
        return view('admin.documentation');
    }
}
