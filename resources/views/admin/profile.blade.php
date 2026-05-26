@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Portfolio Profile</h1>
    <button type="submit" form="profile-form" class="btn btn-primary"><i class="fa-solid fa-save"></i> Save Changes</button>
</div>

<div class="card">
    <form id="profile-form" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" value="{{ $profile->name }}">
            </div>
            <div class="form-group">
                <label>Job Title / Subtitle</label>
                <input type="text" class="form-control" name="subtitle" value="{{ $profile->subtitle }}">
            </div>
        </div>

        <div class="form-group" style="margin-top: 15px;">
            <label>Short Hero Description</label>
            <textarea class="form-control" name="description" rows="2">{{ $profile->description }}</textarea>
        </div>

        <h3 style="font-size: 18px; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">About Section</h3>
        <div class="form-group">
            <label>About Title</label>
            <input type="text" class="form-control" name="about_title" value="{{ $profile->about_title }}">
        </div>
        <div class="form-group">
            <label>About Description</label>
            <textarea class="form-control" name="about_description" rows="4">{{ $profile->about_description }}</textarea>
        </div>

        <h3 style="font-size: 18px; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Contact & Location</h3>
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" class="form-control" name="email" value="{{ $profile->email }}">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="phone" value="{{ $profile->phone }}">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" name="location" value="{{ $profile->location }}">
            </div>
        </div>

        <h3 style="font-size: 18px; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Social Links</h3>
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="url" class="form-control" name="linkedin_url" value="{{ $profile->linkedin_url }}">
            </div>
            <div class="form-group">
                <label>GitHub URL</label>
                <input type="url" class="form-control" name="github_url" value="{{ $profile->github_url }}">
            </div>
        </div>
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 15px;">
            <div class="form-group">
                <label>Twitter/X URL</label>
                <input type="url" class="form-control" name="twitter_url" value="{{ $profile->twitter_url }}">
            </div>
            <div class="form-group">
                <label>Website URL</label>
                <input type="url" class="form-control" name="website_url" value="{{ $profile->website_url }}">
            </div>
        </div>

        <h3 style="font-size: 18px; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Statistics</h3>
        <div class="form-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <div class="form-group">
                <label>Years Experience</label>
                <input type="text" class="form-control" name="experience_years" value="{{ $profile->experience_years }}">
            </div>
            <div class="form-group">
                <label>Projects Completed</label>
                <input type="text" class="form-control" name="projects_completed" value="{{ $profile->projects_completed }}">
            </div>
            <div class="form-group">
                <label>Happy Clients</label>
                <input type="text" class="form-control" name="happy_clients" value="{{ $profile->happy_clients }}">
            </div>
            <div class="form-group">
                <label>Awards Received</label>
                <input type="text" class="form-control" name="awards_received" value="{{ $profile->awards_received }}">
            </div>
        </div>

        <h3 style="font-size: 18px; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Media & Assets</h3>
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Hero Image</label>
                <div style="display: flex; align-items: center; gap: 15px; margin-top: 5px;">
                    <img src="{{ str_starts_with($profile->hero_image, '/') ? $profile->hero_image : Storage::url($profile->hero_image) }}" 
                         alt="Hero" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border-color);">
                    <input type="file" class="form-control" name="hero_image">
                </div>
            </div>
            <div class="form-group">
                <label>Availability</label>
                <div style="display: flex; align-items: center; gap: 10px; padding: 10px 0;">
                    <input type="checkbox" name="available_for_freelance" id="available_for_freelance" {{ $profile->available_for_freelance ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                    <label for="available_for_freelance" style="margin-bottom: 0; cursor: pointer;">Available for Freelance</label>
                </div>
            </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label>Upload CV (PDF, DOC, DOCX)</label>
            <div style="display: flex; align-items: center; gap: 15px;">
                @if($profile->cv_path)
                    <div style="padding: 8px 15px; background: var(--bg-main); border-radius: 8px; border: 1px solid var(--border-color); font-size: 13px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i> Current CV Uploaded
                    </div>
                @endif
                <input type="file" class="form-control" name="cv_path">
            </div>
        </div>
    </form>
</div>
@endsection
