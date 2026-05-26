@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Workflow Process</h1>
    <a href="{{ route('admin.processes.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Process Step</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Step #</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($processes as $process)
                <tr>
                    <td style="font-weight: 700; color: var(--accent-color);">0{{ $process->step_number }}</td>
                    <td>
                        <div style="width: 40px; height: 40px; background: #1e1e24; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-color); border: 1px solid var(--accent-color); overflow: hidden;">
                            @if(str_starts_with($process->icon, 'http') || str_starts_with($process->icon, '/') || str_starts_with($process->icon, 'processes/'))
                                <img src="{{ str_starts_with($process->icon, 'processes/') ? Storage::url($process->icon) : $process->icon }}" alt="" style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
                            @else
                                <i class="{{ $process->icon }}"></i>
                            @endif
                        </div>
                    </td>
                    <td style="font-weight: 600;">{{ $process->title }}</td>
                    <td style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $process->description }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.processes.edit', $process) }}" class="action-btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.processes.destroy', $process) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
