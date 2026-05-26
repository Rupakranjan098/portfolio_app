@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($testimonial) ? 'Edit Testimonial' : 'Add New Testimonial' }}</h1>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline" style="border: 1px solid #e2e8f0;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Client Name</label>
                <input type="text" class="form-control" name="client_name" value="{{ old('client_name', $testimonial->client_name ?? '') }}" placeholder="e.g. Jane Doe">
            </div>
            <div class="form-group">
                <label>Client Title / Company</label>
                <input type="text" class="form-control" name="client_title" value="{{ old('client_title', $testimonial->client_title ?? '') }}" placeholder="e.g. CEO, Startup Inc.">
            </div>
        </div>

        <div class="form-group">
            <label>Testimonial Text</label>
            <textarea class="form-control" name="text" placeholder="What did the client say?">{{ old('text', $testimonial->text ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Client Avatar</label>
            <div style="display: flex; align-items: center; gap: 20px; margin-top: 5px;">
                @if(isset($testimonial))
                <img src="{{ str_starts_with($testimonial->avatar_url, 'http') ? $testimonial->avatar_url : Storage::url($testimonial->avatar_url) }}" 
                     alt="Current" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid #e2e8f0;">
                @endif
                <input type="file" class="form-control" name="avatar_url">
            </div>
            <small style="color: var(--text-muted); margin-top: 5px; display: block;">Upload an image or leave blank.</small>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> {{ isset($testimonial) ? 'Update Testimonial' : 'Create Testimonial' }}</button>
        </div>
    </form>
</div>
@endsection
