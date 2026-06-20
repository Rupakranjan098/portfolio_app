<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Profile;

Route::get('/', function () {
    return view('welcome', [
        'profile' => \App\Models\Profile::first(),
        'projects' => \App\Models\Project::all(),
        'services' => \App\Models\Service::with('projects')->get(),
        'testimonials' => \App\Models\Testimonial::all(),
        'skills' => \App\Models\Skill::orderBy('order')->get(),
        'processes' => \App\Models\Process::orderBy('step_number')->get()
    ]);
});

Route::get('/projects', function () {
    return view('projects', [
        'profile' => \App\Models\Profile::first(),
        'projects' => \App\Models\Project::all()
    ]);
})->name('projects');

Route::get('/services', function () {
    return view('services', [
        'profile' => \App\Models\Profile::first(),
        'services' => \App\Models\Service::with('projects')->get()
    ]);
})->name('services');

// Auth Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Custom Admin Dashboard Routes
Route::prefix('custom-admin')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    
    // Projects CRUD
    Route::get('/projects', [App\Http\Controllers\AdminController::class, 'projects'])->name('admin.projects.index');
    Route::get('/projects/create', [App\Http\Controllers\AdminController::class, 'projectCreate'])->name('admin.projects.create');
    Route::post('/projects', [App\Http\Controllers\AdminController::class, 'projectStore'])->name('admin.projects.store');
    Route::get('/projects/{project}/edit', [App\Http\Controllers\AdminController::class, 'projectEdit'])->name('admin.projects.edit');
    Route::post('/projects/{project}', [App\Http\Controllers\AdminController::class, 'projectUpdate'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [App\Http\Controllers\AdminController::class, 'projectDestroy'])->name('admin.projects.destroy');

    // Services CRUD
    Route::get('/services', [App\Http\Controllers\AdminController::class, 'services'])->name('admin.services.index');
    Route::get('/services/create', [App\Http\Controllers\AdminController::class, 'serviceCreate'])->name('admin.services.create');
    Route::post('/services', [App\Http\Controllers\AdminController::class, 'serviceStore'])->name('admin.services.store');
    Route::get('/services/{service}/edit', [App\Http\Controllers\AdminController::class, 'serviceEdit'])->name('admin.services.edit');
    Route::post('/services/{service}', [App\Http\Controllers\AdminController::class, 'serviceUpdate'])->name('admin.services.update');
    Route::delete('/services/{service}', [App\Http\Controllers\AdminController::class, 'serviceDestroy'])->name('admin.services.destroy');

    // Testimonials CRUD
    Route::get('/testimonials', [App\Http\Controllers\AdminController::class, 'testimonials'])->name('admin.testimonials.index');
    Route::get('/testimonials/create', [App\Http\Controllers\AdminController::class, 'testimonialCreate'])->name('admin.testimonials.create');
    Route::post('/testimonials', [App\Http\Controllers\AdminController::class, 'testimonialStore'])->name('admin.testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [App\Http\Controllers\AdminController::class, 'testimonialEdit'])->name('admin.testimonials.edit');
    Route::post('/testimonials/{testimonial}', [App\Http\Controllers\AdminController::class, 'testimonialUpdate'])->name('admin.testimonials.update');
    Route::delete('/testimonials/{testimonial}', [App\Http\Controllers\AdminController::class, 'testimonialDestroy'])->name('admin.testimonials.destroy');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [App\Http\Controllers\AdminController::class, 'profileUpdate'])->name('admin.profile.update');

    // Skills CRUD
    Route::get('/skills', [App\Http\Controllers\AdminController::class, 'skillsIndex'])->name('admin.skills.index');
    Route::get('/skills/create', [App\Http\Controllers\AdminController::class, 'skillsCreate'])->name('admin.skills.create');
    Route::post('/skills', [App\Http\Controllers\AdminController::class, 'skillsStore'])->name('admin.skills.store');
    Route::get('/skills/{skill}/edit', [App\Http\Controllers\AdminController::class, 'skillsEdit'])->name('admin.skills.edit');
    Route::post('/skills/{skill}', [App\Http\Controllers\AdminController::class, 'skillsUpdate'])->name('admin.skills.update');
    Route::delete('/skills/{skill}', [App\Http\Controllers\AdminController::class, 'skillsDestroy'])->name('admin.skills.destroy');

    // Processes CRUD
    Route::get('/processes', [App\Http\Controllers\AdminController::class, 'processesIndex'])->name('admin.processes.index');
    Route::get('/processes/create', [App\Http\Controllers\AdminController::class, 'processesCreate'])->name('admin.processes.create');
    Route::post('/processes', [App\Http\Controllers\AdminController::class, 'processesStore'])->name('admin.processes.store');
    Route::get('/processes/{process}/edit', [App\Http\Controllers\AdminController::class, 'processesEdit'])->name('admin.processes.edit');
    Route::post('/processes/{process}', [App\Http\Controllers\AdminController::class, 'processesUpdate'])->name('admin.processes.update');
    Route::delete('/processes/{process}', [App\Http\Controllers\AdminController::class, 'processesDestroy'])->name('admin.processes.destroy');
});

// Temporary route to run migrations on production
Route::get('/run-migrations', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return 'Migrations run successfully:<br><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        return 'Error running migrations: ' . $e->getMessage();
    }
});

Route::get('/debug-php', function () {
    return [
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
        'memory_limit' => ini_get('memory_limit'),
        'loaded_ini' => php_ini_loaded_file(),
    ];
});
