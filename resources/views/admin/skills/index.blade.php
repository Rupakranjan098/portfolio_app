@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Skills</h1>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New Skill</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($skills as $skill)
                <tr>
                    <td>
                        <div style="width: 40px; height: 40px; background: #1e1e24; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: {{ $skill->color ?? '#fff' }}; overflow: hidden;">
                            @php
                                $isStored = str_starts_with($skill->icon_class, 'skills/');
                                $iconUrl = $isStored ? asset('storage/' . $skill->icon_class) : $skill->icon_class;
                            @endphp
                            @if(str_contains($skill->icon_class, '<i'))
                                {!! $skill->icon_class !!}
                            @elseif($isStored || str_starts_with($skill->icon_class, 'http') || str_starts_with($skill->icon_class, '/'))
                                <img src="{{ $iconUrl }}" alt="" style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
                            @else
                                <i class="{{ $skill->icon_class }}"></i>
                            @endif
                        </div>
                    </td>
                    <td style="font-weight: 600;">{{ $skill->name }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="action-btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
