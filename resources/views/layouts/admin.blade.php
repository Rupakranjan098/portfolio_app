<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-icon"><i class="fa-solid fa-gauge-high"></i></div>
                <span class="logo-text">Admin Panel</span>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="{{ Route::is('admin.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.index') }}"><i class="fa-solid fa-chart-pie"></i> Overview</a>
                    </li>
                    <li class="{{ Route::is('admin.projects.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-folder-open"></i> Projects</a>
                    </li>
                    <li class="{{ Route::is('admin.services.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.services.index') }}"><i class="fa-solid fa-briefcase"></i> Services</a>
                    </li>
                    <li class="{{ Route::is('admin.testimonials.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.testimonials.index') }}"><i class="fa-solid fa-star"></i> Testimonials</a>
                    </li>
                    <li class="{{ Route::is('admin.skills.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.skills.index') }}"><i class="fa-solid fa-code"></i> Skills</a>
                    </li>
                    <li class="{{ Route::is('admin.processes.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.processes.index') }}"><i class="fa-solid fa-list-check"></i> Process</a>
                    </li>
                    <li class="{{ Route::is('admin.profile') ? 'active' : '' }}">
                        <a href="{{ route('admin.profile') }}"><i class="fa-solid fa-user-gear"></i> Profile</a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Site</a>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <div class="user-info">
                    <img src="https://i.pravatar.cc/150?img=12" alt="User">
                    <div>
                        <span class="user-name">Admin User</span>
                        <span class="user-role">Super Admin</span>
                    </div>
                </div>
                <a href="#" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="top-header">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button class="sidebar-toggle" id="sidebar-toggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="search-bar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search anything...">
                    </div>
                </div>
                <div class="header-actions">
                    <button class="icon-btn" id="theme-toggle">
                        <i class="fa-regular fa-moon" id="theme-icon-dark"></i>
                        <i class="fa-regular fa-sun" id="theme-icon-light" style="display: none;"></i>
                    </button>
                    <button class="icon-btn"><i class="fa-regular fa-bell"></i><span class="badge"></span></button>
                </div>
            </header>

            <div class="content-body">
                @if(session('success'))
                    <div style="padding: 15px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="padding: 15px; background: #fee2e2; color: #991b1b; border-radius: 8px; margin-bottom: 20px;">
                        <ul style="list-style: none;">
                            @foreach($errors->all() as $error)
                                <li><i class="fa-solid fa-circle-exclamation"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeIconDark = document.getElementById('theme-icon-dark');
        const themeIconLight = document.getElementById('theme-icon-light');
        const html = document.documentElement;

        // Check for saved theme
        const savedTheme = localStorage.getItem('admin-theme') || 'dark';
        if (savedTheme === 'dark') {
            html.setAttribute('data-theme', 'dark');
            themeIconDark.style.display = 'none';
            themeIconLight.style.display = 'block';
        }

        themeToggle.addEventListener('click', () => {
            if (html.getAttribute('data-theme') === 'dark') {
                html.removeAttribute('data-theme');
                localStorage.setItem('admin-theme', 'light');
                themeIconDark.style.display = 'block';
                themeIconLight.style.display = 'none';
            } else {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('admin-theme', 'dark');
                themeIconDark.style.display = 'none';
                themeIconLight.style.display = 'block';
            }
        });

        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.querySelector('.sidebar');
        const adminWrapper = document.querySelector('.admin-wrapper');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            adminWrapper.classList.toggle('sidebar-active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 1024) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    adminWrapper.classList.remove('sidebar-active');
                }
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
