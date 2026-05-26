@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Testimonial</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <img src="{{ str_starts_with($testimonial->avatar_url, 'http') ? $testimonial->avatar_url : Storage::url($testimonial->avatar_url) }}" 
                                 alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <div style="font-weight: 600;">{{ $testimonial->client_name }}</div>
                                <div style="font-size: 12px; color: var(--text-muted);">{{ $testimonial->client_title }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="max-width: 400px; font-style: italic; font-size: 13px;">"{{ Str::limit($testimonial->text, 100) }}"</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="action-btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
