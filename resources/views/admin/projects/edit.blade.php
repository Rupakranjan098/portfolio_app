@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Project</h1>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline" style="border: 1px solid #e2e8f0;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $project->title) }}" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" class="form-control" name="category" value="{{ old('category', $project->category) }}" required>
            </div>
            <div class="form-group">
                <label>Link to Service Card</label>
                <select class="form-control" name="service_id">
                    <option value="">-- None / Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id', $project->service_id) == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 15px;">
            <div class="form-group">
                <label>Project URL (Optional)</label>
                <input type="url" class="form-control" name="project_url" value="{{ old('project_url', $project->project_url) }}">
            </div>
            <div class="form-group">
                <label>GitHub URL (Optional)</label>
                <input type="url" class="form-control" name="github_url" value="{{ old('github_url', $project->github_url) }}">
            </div>
        </div>

        <div class="form-group">
            <label>Project Description (Displayed on card)</label>
            <textarea class="form-control" name="description" rows="3" placeholder="A brief description of the project.">{{ old('description', $project->description) }}</textarea>
        </div>

        <!-- Custom Card Styles -->
        <h3 style="margin-top: 30px; margin-bottom: 15px; font-size: 1.1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">Card Styling & Customization</h3>
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Card Theme / Accent Color</label>
                <select class="form-control" name="card_theme">
                    <option value="purple" {{ old('card_theme', $project->card_theme) == 'purple' ? 'selected' : '' }}>Purple</option>
                    <option value="orange" {{ old('card_theme', $project->card_theme) == 'orange' ? 'selected' : '' }}>Orange</option>
                    <option value="green" {{ old('card_theme', $project->card_theme) == 'green' ? 'selected' : '' }}>Green</option>
                    <option value="blue" {{ old('card_theme', $project->card_theme) == 'blue' ? 'selected' : '' }}>Blue</option>
                </select>
            </div>
            <div class="form-group">
                <label>Card Icon Class (FontAwesome)</label>
                <input type="text" class="form-control" name="card_icon" value="{{ old('card_icon', $project->card_icon) }}" placeholder="e.g. fa-solid fa-chart-pie">
            </div>
            <div class="form-group">
                <label>Card Pill Tag (e.g., UI/UX, Frontend)</label>
                <input type="text" class="form-control" name="card_tag" value="{{ old('card_tag', $project->card_tag) }}" placeholder="e.g. UI/UX">
            </div>
        </div>

        <h3 style="margin-top: 30px; margin-bottom: 15px; font-size: 1.1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">Media & Documents</h3>
        <div class="form-group">
            <label>Project Cover Image (Leave blank to keep current)</label>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 10px;">
                <img src="{{ str_starts_with($project->image_path, '/') ? $project->image_path : Storage::url($project->image_path) }}" 
                     alt="Current" style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                <input type="file" class="form-control" name="image_path">
            </div>
        </div>




        <!-- Hidden inputs or placeholder for featured project layouts if needed -->
        <input type="checkbox" name="is_featured" value="1" style="display:none" {{ $project->is_featured ? 'checked' : '' }}>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Save Changes</button>
        </div>
    </form>
</div>
@endsection
