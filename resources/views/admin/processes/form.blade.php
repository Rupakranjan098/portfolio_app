@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($process) ? 'Edit Process Step' : 'Add New Process Step' }}</h1>
    <a href="{{ route('admin.processes.index') }}" class="btn btn-outline" style="border: 1px solid #e2e8f0;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <form action="{{ isset($process) ? route('admin.processes.update', $process) : route('admin.processes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Step Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $process->title ?? '') }}" placeholder="e.g. Discovery & Research" required>
            </div>
            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <label style="margin-bottom: 0;">Icon Class / URL</label>
                    <div style="display: flex; gap: 10px;">
                        <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" style="font-size: 11px; color: var(--primary); text-decoration: none;"><i class="fa-brands fa-font-awesome"></i> FontAwesome</a>
                    </div>
                </div>
                <input type="text" class="form-control" name="icon" value="{{ old('icon', $process->icon ?? '') }}" placeholder="e.g. fa-solid fa-magnifying-glass">
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>OR Upload Icon Image</label>
            <div style="display: flex; align-items: center; gap: 15px;">
                @if(isset($process) && (str_starts_with($process->icon, 'processes/') || str_starts_with($process->icon, 'http') || str_starts_with($process->icon, '/')))
                    <img src="{{ str_starts_with($process->icon, 'processes/') ? Storage::url($process->icon) : $process->icon }}" 
                         alt="Current Icon" style="width: 40px; height: 40px; border-radius: 50%; background: #1e1e24; object-fit: contain; padding: 8px; border: 1px solid var(--accent-color);">
                @endif
                <input type="file" class="form-control" name="icon_file" accept="image/*">
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Step Number</label>
            <input type="number" class="form-control" name="step_number" value="{{ old('step_number', $process->step_number ?? 1) }}" required>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="4" placeholder="Briefly describe what happens in this stage..." required>{{ old('description', $process->description ?? '') }}</textarea>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-cloud-arrow-up"></i> {{ isset($process) ? 'Update Step' : 'Create Step' }}
            </button>
        </div>
    </form>
</div>
@endsection
