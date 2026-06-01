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

        <div class="form-group">
            <label>Project URL (Optional)</label>
            <input type="url" class="form-control" name="project_url" value="{{ old('project_url') }}" placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label>Project Image</label>
            <input type="file" class="form-control" name="image_path" required>
            <small style="color: var(--text-muted); margin-top: 5px; display: block;">Recommended size: 800x600px</small>
        </div>

        <div class="form-group">
            <label>Project Document (Optional PDF/Word/ZIP)</label>
            <input type="file" class="form-control" name="document_path">
            <small style="color: var(--text-muted); margin-top: 5px; display: block;">Max size: 10MB</small>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cloud-arrow-up"></i> Create Project</button>
        </div>
    </form>
</div>
@endsection
