@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($skill) ? 'Edit Skill' : 'Add New Skill' }}</h1>
    <a href="{{ route('admin.skills.index') }}" class="btn btn-outline" style="border: 1px solid #e2e8f0;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <form action="{{ isset($skill) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Skill Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $skill->name ?? '') }}" placeholder="e.g. React.js" required>
            </div>
            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <label style="margin-bottom: 0;">Icon Class / URL</label>
                    <div style="display: flex; gap: 10px;">
                        <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" style="font-size: 11px; color: var(--primary); text-decoration: none;"><i class="fa-brands fa-font-awesome"></i> FontAwesome</a>
                        <a href="https://devicon.dev/" target="_blank" style="font-size: 11px; color: var(--primary); text-decoration: none;"><i class="fa-solid fa-code"></i> DevIcons</a>
                    </div>
                </div>
                <input type="text" class="form-control" name="icon_class" value="{{ old('icon_class', $skill->icon_class ?? '') }}" placeholder="e.g. fa-brands fa-react or https://...">
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>OR Upload Icon Image</label>
            <div style="display: flex; align-items: center; gap: 15px;">
                @if(isset($skill))
                    @php
                        $isStored = str_starts_with($skill->icon_class, 'skills/');
                        $iconUrl = $isStored ? asset('storage/' . $skill->icon_class) : $skill->icon_class;
                    @endphp
                    @if($isStored || str_starts_with($skill->icon_class, 'http') || str_starts_with($skill->icon_class, '/'))
                        <img src="{{ $iconUrl }}" 
                             alt="Current Icon" style="width: 40px; height: 40px; border-radius: 8px; background: #1e1e24; object-fit: contain; padding: 5px;">
                    @endif
                @endif
                <input type="file" class="form-control" name="icon_file" accept="image/*">
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-cloud-arrow-up"></i> {{ isset($skill) ? 'Update Skill' : 'Create Skill' }}
            </button>
        </div>
    </form>
</div>

<div class="card" style="margin-top: 30px; background: #f8fafc; border: 1px dashed #cbd5e1;">
    <h3 style="font-size: 16px; margin-bottom: 10px;"><i class="fa-solid fa-circle-info"></i> How to use Icons</h3>
    <p style="font-size: 14px; color: #64748b;">You can use FontAwesome classes (e.g., <code>fa-brands fa-react</code>, <code>fa-brands fa-laravel</code>) or any other icon library classes you've included in your frontend.</p>
</div>
@endsection
