@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($service) ? 'Edit Service' : 'Add New Service' }}</h1>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline" style="border: 1px solid #e2e8f0;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Service Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $service->title ?? '') }}" placeholder="e.g. Mobile Development">
            </div>
            <div class="form-group">
                <label>FontAwesome Icon Class</label>
                <input type="text" class="form-control" name="icon" value="{{ old('icon', $service->icon ?? 'fa-code') }}" placeholder="e.g. fa-mobile-screen">
                <small style="color: var(--text-muted);">Use classes from FontAwesome 6 (e.g. fa-code, fa-laptop, fa-mobile-screen)</small>
            </div>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" placeholder="Briefly describe your service...">{{ old('description', $service->description ?? '') }}</textarea>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> {{ isset($service) ? 'Update Service' : 'Create Service' }}</button>
        </div>
    </form>
</div>
@endsection
