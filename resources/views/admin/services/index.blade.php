@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Services</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Service</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>
                        <div style="width: 40px; height: 40px; background: var(--bg-main); color: var(--primary); display: flex; align-items: center; justify-content: center; border-radius: 8px; border: 1px solid var(--border-color);">
                            <i class="fa-solid {{ $service->icon }}"></i>
                        </div>
                    </td>
                    <td style="font-weight: 600;">{{ $service->title }}</td>
                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $service->description }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.services.edit', $service) }}" class="action-btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
