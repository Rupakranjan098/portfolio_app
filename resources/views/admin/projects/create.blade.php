@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Add New Project</h1>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline" style="border: 1px solid #e2e8f0;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="e.g. E-commerce Website" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" class="form-control" name="category" value="{{ old('category') }}" placeholder="e.g. Web Development" required>
            </div>
            <div class="form-group">
                <label>Link to Service Card</label>
                <select class="form-control" name="service_id">
                    <option value="">-- None / Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 15px;">
            <div class="form-group">
                <label>Project URL (Optional)</label>
                <input type="url" class="form-control" name="project_url" value="{{ old('project_url') }}" placeholder="https://example.com">
            </div>
            <div class="form-group">
                <label>GitHub URL (Optional)</label>
                <input type="url" class="form-control" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/username/project">
            </div>
        </div>

        <div class="form-group">
            <label>Project Description (Displayed on card)</label>
            <textarea class="form-control" name="description" rows="3" placeholder="A brief description of the project.">{{ old('description') }}</textarea>
        </div>

        <!-- Custom Card Styles -->
        <h3 style="margin-top: 30px; margin-bottom: 15px; font-size: 1.1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">Card Styling & Customization</h3>
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Card Theme / Accent Color</label>
                <select class="form-control" name="card_theme">
                    <option value="purple" {{ old('card_theme') == 'purple' ? 'selected' : '' }}>Purple</option>
                    <option value="orange" {{ old('card_theme') == 'orange' ? 'selected' : '' }}>Orange</option>
                    <option value="green" {{ old('card_theme') == 'green' ? 'selected' : '' }}>Green</option>
                    <option value="blue" {{ old('card_theme') == 'blue' ? 'selected' : '' }}>Blue</option>
                </select>
            </div>
            <div class="form-group">
                <label>Card Icon Class (FontAwesome)</label>
                <input type="text" class="form-control" name="card_icon" value="{{ old('card_icon', 'fa-solid fa-cube') }}" placeholder="e.g. fa-solid fa-chart-pie">
            </div>
            <div class="form-group">
                <label>Card Pill Tag (e.g., UI/UX, Frontend)</label>
                <input type="text" class="form-control" name="card_tag" value="{{ old('card_tag', 'Dev') }}" placeholder="e.g. UI/UX">
            </div>
        </div>

        <h3 style="margin-top: 30px; margin-bottom: 15px; font-size: 1.1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">Media & Documents</h3>
        <div class="form-group">
            <label>Project Cover Image</label>
            <input type="file" class="form-control" name="image_path" required>
            <small style="color: var(--text-muted); margin-top: 5px; display: block;">Recommended size: 800x600px</small>
        </div>




        <!-- Hidden inputs or placeholder for featured project layouts if needed -->
        <input type="checkbox" name="is_featured" value="1" style="display:none">

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cloud-arrow-up"></i> Create Project</button>
        </div>
    </form>
</div>
@endsection
