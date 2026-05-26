@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Project</h1>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline" style="border: 1px solid #e2e8f0;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $project->title) }}">
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" class="form-control" name="category" value="{{ old('category', $project->category) }}">
            </div>
        </div>

        <div class="form-group">
            <label>Project URL (Optional)</label>
            <input type="url" class="form-control" name="project_url" value="{{ old('project_url', $project->project_url) }}">
        </div>

        <div class="form-group">
            <label>Project Image (Leave blank to keep current)</label>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 10px;">
                <img src="{{ str_starts_with($project->image_path, '/') ? $project->image_path : Storage::url($project->image_path) }}" 
                     alt="Current" style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                <input type="file" class="form-control" name="image_path">
            </div>
        </div>

        <div class="form-group">
            <label>Project Document (Leave blank to keep current)</label>
            @if($project->document_path)
                <div style="margin-bottom: 10px;">
                    <a href="{{ Storage::url($project->document_path) }}" target="_blank" class="btn btn-outline" style="font-size: 13px; padding: 5px 12px;">
                        <i class="fa-solid fa-file-lines"></i> View Current Document
                    </a>
                </div>
            @endif
            <input type="file" class="form-control" name="document_path">
            <small style="color: var(--text-muted); margin-top: 5px; display: block;">PDF, Word, or ZIP. Max size: 10MB</small>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Save Changes</button>
        </div>
    </form>
</div>
@endsection
