@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard Overview</h1>
    <div class="date-range">
        <span class="btn" style="background: #e2e8f0; color: #475569;"><i class="fa-regular fa-calendar"></i> May 02, 2026</span>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-icon" style="background: #e0e7ff; color: #4338ca;">
            <i class="fa-solid fa-folder-open"></i>
        </div>
        <div class="stat-info">
            <h3>Total Projects</h3>
            <div class="number">{{ $stats['projects'] }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background: #fef3c7; color: #b45309;">
            <i class="fa-solid fa-briefcase"></i>
        </div>
        <div class="stat-info">
            <h3>Services Offered</h3>
            <div class="number">{{ $stats['services'] }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background: #fee2e2; color: #b91c1c;">
            <i class="fa-solid fa-star"></i>
        </div>
        <div class="stat-info">
            <h3>Testimonials</h3>
            <div class="number">{{ $stats['testimonials'] }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background: #dcfce7; color: #166534;">
            <i class="fa-solid fa-code"></i>
        </div>
        <div class="stat-info">
            <h3>Total Skills</h3>
            <div class="number">{{ $stats['skills'] }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background: #f0f9ff; color: #0369a1;">
            <i class="fa-solid fa-list-check"></i>
        </div>
        <div class="stat-info">
            <h3>Process Steps</h3>
            <div class="number">{{ $stats['processes'] }}</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="page-header" style="margin-bottom: 20px;">
        <h2 style="font-size: 18px; font-weight: 700;">System Overview</h2>
    </div>
    <p style="color: var(--text-muted); font-size: 14px;">Welcome to your custom portfolio admin panel. You can manage your projects, services, and profile information using the sidebar on the left.</p>
</div>
@endsection
