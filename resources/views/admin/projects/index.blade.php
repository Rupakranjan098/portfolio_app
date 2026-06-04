@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New Project</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Service Card</th>
                    <th>Doc</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>
                        @php
                            $imageUrl = $project->image_path;
                            if (!str_starts_with($imageUrl, 'http') && !str_starts_with($imageUrl, '/')) {
                                $imageUrl = asset('storage/' . $imageUrl);
                            }
                        @endphp
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $project->title }}" 
                             style="width: 80px; height: 50px; object-fit: cover; border-radius: 6px;">
                    </td>
                    <td style="font-weight: 600;">{{ $project->title }}</td>
                    <td><span style="padding: 4px 10px; background: var(--bg-main); border-radius: 20px; font-size: 12px; color: var(--text-muted); border: 1px solid var(--border-color);">{{ $project->category }}</span></td>
                    <td>
                        @if($project->service)
                            <span style="padding: 4px 10px; background: rgba(228, 110, 30, 0.1); border-radius: 20px; font-size: 12px; color: var(--primary); border: 1px solid rgba(228, 110, 30, 0.2);">
                                <i class="fa-solid {{ $project->service->icon }}"></i> {{ $project->service->title }}
                            </span>
                        @else
                            <span style="color: var(--text-muted); font-size: 12px; font-style: italic;">None</span>
                        @endif
                    </td>
                    <td>
                        @if($project->document_path)
                            <a href="{{ Storage::url($project->document_path) }}" target="_blank" style="color: #ff6b01; font-size: 18px;" title="View Document">
                                <i class="fa-solid fa-file-pdf"></i>
                            </a>
                        @else
                            <span style="color: #e2e8f0;"><i class="fa-solid fa-file-circle-xmark"></i></span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="action-btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
