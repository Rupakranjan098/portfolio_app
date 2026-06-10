<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name }} | {{ $profile->subtitle }}</title>
    <meta name="description" content="Portfolio of {{ $profile->name }}, a passionate {{ $profile->subtitle }} creating beautiful and intuitive digital experiences.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/app.jsx'])
</head>
<body>
    <nav class="navbar container">
        <div class="logo">
            <div class="logo-icon">{{ strtoupper(substr($profile->name, 0, 1)) . strtoupper(substr(strrchr($profile->name, " "), 1, 1)) }}</div>
            <span class="logo-text">{{ $profile->name }}</span>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ $profile->cv_path ? Storage::url($profile->cv_path) : '#' }}" class="btn btn-outline cv-btn">Download CV <i class="fa-solid fa-download"></i></a>
            <button class="theme-toggle-btn" id="theme-toggle">
                <i class="fa-regular fa-moon" id="theme-icon-dark" style="display: none;"></i>
                <i class="fa-regular fa-sun" id="theme-icon-light"></i>
            </button>
            <button class="menu-toggle" id="menu-toggle">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
        </div>
    </nav>

    <header id="home" class="hero container">
        <div class="hero-content">
            <div class="badge"><i class="fa-solid fa-hand-wave"></i> Hello, I'm</div>
            <h1 class="hero-title">{{ $profile->name }}</h1>
            <h2 class="hero-subtitle">{{ $profile->subtitle }}</h2>
            <p class="hero-desc">{{ $profile->description }}</p>
            <div class="hero-btns">
                <a href="#projects" class="btn btn-primary">View My Work <i class="fa-solid fa-arrow-right"></i></a>
                <a href="#contact" class="btn btn-outline-border">Contact Me <i class="fa-regular fa-envelope"></i></a>
            </div>
            <div class="social-links">
                <span>Follow Me</span>
                @if($profile->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a> @endif
                @if($profile->github_url) <a href="{{ $profile->github_url }}" target="_blank"><i class="fa-brands fa-github"></i></a> @endif
                @if($profile->twitter_url) <a href="{{ $profile->twitter_url }}" target="_blank"><i class="fa-brands fa-twitter"></i></a> @endif
                @if($profile->website_url) <a href="{{ $profile->website_url }}" target="_blank"><i class="fa-solid fa-globe"></i></a> @endif
            </div>
        </div>
        <div class="hero-image">
            @if($profile->available_for_freelance)
            <div class="status-badge">
                <span class="status-dot"></span> Available for<br/><strong>Freelance</strong>
            </div>
            @endif
            @php
                $heroImgUrl = $profile->hero_image;
                if (!str_starts_with($heroImgUrl, 'http') && !str_starts_with($heroImgUrl, '/')) {
                    $heroImgUrl = asset('storage/' . $heroImgUrl);
                }
            @endphp
            <img src="{{ $heroImgUrl }}" alt="{{ $profile->name }} 3D avatar">
            <div class="decoration-dots"></div>
        </div>
    </header>

    <div id="react-root" class="container"></div>

    <section id="about" class="about container">
        <div class="about-grid">
            <div class="about-text">
                <div class="section-label">About Me</div>
                <h2 class="section-title">{{ $profile->about_title }}</h2>
                <p class="section-desc">{{ $profile->about_description }}</p>
                <a href="#" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="about-stats">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-regular fa-face-smile"></i></div>
                    <div class="stat-number">{{ $profile->experience_years }}</div>
                    <div class="stat-text">Years Experience</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="stat-number">{{ $profile->projects_completed }}</div>
                    <div class="stat-text">Projects Completed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-number">{{ $profile->happy_clients }}</div>
                    <div class="stat-text">Happy Clients</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-award"></i></div>
                    <div class="stat-number">{{ $profile->awards_received }}</div>
                    <div class="stat-text">Awards Received</div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services container">
        <div class="section-header">
            <div>
                <div class="section-label">What I Do</div>
                <h2 class="section-title">My Services</h2>
            </div>
            <a href="#" class="view-all">View All Services <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="services-grid">
            @foreach($services as $service)
            <div class="service-card">
                <div class="service-icon"><i class="fa-solid {{ $service->icon }}"></i></div>
                <div class="service-info">
                    <h3 class="service-title">{{ $service->title }}</h3>
                    <p class="service-desc">{{ $service->description }}</p>
                    
                    @if($service->projects->count() > 0)
                    <div class="service-projects-badges">
                        @foreach($service->projects->take(3) as $proj)
                            <span class="project-pill-tag">
                                <i class="fa-solid fa-cube"></i> {{ $proj->title }}
                            </span>
                        @endforeach
                        @if($service->projects->count() > 3)
                            <span class="project-pill-tag count">+{{ $service->projects->count() - 3 }} more</span>
                        @endif
                    </div>
                    @endif

                    @if($service->projects->count() > 0)
                        <a href="javascript:void(0)" class="learn-more view-service-projects-btn" data-service-title="{{ $service->title }}" data-projects="{{ json_encode($service->projects) }}">View Work <i class="fa-solid fa-arrow-right"></i></a>
                    @else
                        <a href="#contact" class="learn-more">Inquire Work <i class="fa-solid fa-arrow-right"></i></a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section id="projects" class="projects container">
        <div class="section-header">
            <div>
                <div class="section-label"><span class="badge-dot"></span> My Work</div>
                <h2 class="section-title">Featured Projects</h2>
            </div>
            <a href="#" class="view-all">View All Projects <span class="view-all-circle"><i class="fa-solid fa-arrow-right"></i></span></a>
        </div>
        <div class="projects-grid">
            @foreach($projects as $project)
            @php
                $themeClass = 'theme-' . ($project->card_theme ?: 'purple');
                $iconClass = $project->card_icon ?: 'fa-solid fa-cube';
                $tagText = $project->card_tag ?: 'Dev';

                $imageUrl = $project->image_path;
                if (!str_starts_with($imageUrl, 'http') && !str_starts_with($imageUrl, '/')) {
                    $imageUrl = asset('storage/' . $imageUrl);
                }
            @endphp
            <div class="premium-project-card {{ $themeClass }}">
                @php
                    $hasGallery = $project->additional_images && count($project->additional_images) > 0;
                    $galleryJson = '';
                    if ($hasGallery) {
                        $galleryUrls = [];
                        foreach ($project->additional_images as $img) {
                            $galleryUrls[] = str_starts_with($img, 'http') || str_starts_with($img, '/') ? $img : asset('storage/' . $img);
                        }
                        $galleryJson = json_encode($galleryUrls);
                    }
                @endphp

                @if($hasGallery)
                <a href="javascript:void(0)" class="premium-project-link view-project-gallery-btn" 
                   data-project-title="{{ $project->title }}"
                   data-main-image="{{ $imageUrl }}"
                   data-additional-images="{{ $galleryJson }}">
                @elseif($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank" class="premium-project-link">
                @endif
                <div class="premium-project-img-wrapper">
                    <img src="{{ $imageUrl }}" alt="{{ $project->title }}">
                    <div class="premium-project-icon">
                        <i class="{{ $iconClass }}"></i>
                    </div>
                </div>
                @if($hasGallery || $project->project_url)
                </a>
                @endif
                <div class="premium-project-info">
                    @if($project->project_url)
                    <a href="{{ $project->project_url }}" target="_blank" class="premium-project-title-link">
                    @endif
                    <h3 class="premium-project-title">{{ $project->title }}</h3>
                    @if($project->project_url)
                    </a>
                    @endif
                    <span class="premium-project-category">{{ $project->category }}</span>
                    @if($project->description)
                        <p class="premium-project-desc">{{ $project->description }}</p>
                    @endif
                    <div class="premium-project-footer">
                        <span class="premium-tag">{{ $tagText }}</span>
                        <div class="premium-project-actions">
                            @if($hasGallery)
                            <a href="javascript:void(0)" class="premium-action-btn gallery-btn view-project-gallery-btn" 
                               data-project-title="{{ $project->title }}"
                               data-main-image="{{ $imageUrl }}"
                               data-additional-images="{{ $galleryJson }}"
                               title="View Design Gallery">
                                <i class="fa-solid fa-images"></i>
                            </a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="premium-action-btn github-btn" title="GitHub Repository">
                                <i class="fa-brands fa-github"></i>
                            </a>
                            @endif
                            @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" class="premium-action-btn live-btn" title="Live Site">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="skills-process-section container">
        <div class="skills-container">
            <div class="section-label">My Skills</div>
            <h2 class="section-title">Tools I Work With</h2>
            <div class="skills-list">
                @foreach($skills as $skill)
                <div class="skill-box">
                    @php
                        $isStored = str_starts_with($skill->icon_class, 'skills/');
                        $iconUrl = $isStored ? asset('storage/' . $skill->icon_class) : $skill->icon_class;
                    @endphp
                    @if(str_contains($skill->icon_class, '<i'))
                        {!! $skill->icon_class !!}
                    @elseif($isStored || str_starts_with($skill->icon_class, 'http') || str_starts_with($skill->icon_class, '/'))
                        <img src="{{ $iconUrl }}" alt="{{ $skill->name }}">
                    @else
                        <i class="{{ $skill->icon_class }}" @if($skill->color) style="color: {{ $skill->color }};" @endif></i>
                    @endif
                    <span>{{ $skill->name }}</span>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="process-container">
            <div class="section-label">My Process</div>
            <h2 class="section-title">How I Work</h2>
            <div class="process-timeline">
                @foreach($processes as $process)
                <div class="process-item">
                    <div class="step-number">{{ str_pad($process->step_number, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="step-circle" style="overflow: hidden;">
                        @if(str_starts_with($process->icon, 'http') || str_starts_with($process->icon, '/') || str_starts_with($process->icon, 'processes/'))
                            <img src="{{ str_starts_with($process->icon, 'processes/') ? asset('storage/' . $process->icon) : $process->icon }}" alt="" style="width: 100%; height: 100%; object-fit: contain; padding: 10px;">
                        @else
                            <i class="{{ $process->icon }}"></i>
                        @endif
                    </div>
                    <div class="process-card">
                        <h4>{{ $process->title }}</h4>
                        <p>{{ $process->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <footer id="contact" class="footer container">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="logo">
                    <div class="logo-icon">{{ strtoupper(substr($profile->name, 0, 1)) . strtoupper(substr(strrchr($profile->name, " "), 1, 1)) }}</div>
                    <span class="logo-text">{{ $profile->name }}</span>
                </div>
                <p class="footer-desc">Crafting digital experiences that make a difference.</p>
            </div>
            <div class="footer-links">
                <div class="link-group">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4 style="opacity:0">.</h4>
                    <ul>
                        <li><a href="#projects">Projects</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>Connect</h4>
                    <ul>
                        @if($profile->email) <li><a href="mailto:{{ $profile->email }}">Email Me</a></li> @endif
                        @if($profile->linkedin_url) <li><a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer">LinkedIn</a></li> @endif
                        @if($profile->github_url) <li><a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer">GitHub</a></li> @endif
                    </ul>
                </div>
            </div>
            <div class="footer-social">
                <h4>Let's Connect</h4>
                <div class="social-links">
                    @if($profile->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin-in"></i></a> @endif
                    @if($profile->github_url) <a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-github"></i></a> @endif
                    @if($profile->twitter_url) <a href="{{ $profile->twitter_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i></a> @endif
                    @if($profile->website_url) <a href="{{ $profile->website_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-globe"></i></a> @endif
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $profile->name }}. All rights reserved.</p>
        </div>
    </footer>
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeIconDark = document.getElementById('theme-icon-dark');
        const themeIconLight = document.getElementById('theme-icon-light');
        const html = document.documentElement;
        const menuToggle = document.getElementById('menu-toggle');
        const navLinks = document.getElementById('nav-links');

        // Check for saved theme
        const savedTheme = localStorage.getItem('portfolio-theme') || 'dark';
        if (savedTheme === 'light') {
            html.setAttribute('data-theme', 'light');
            themeIconDark.style.display = 'block';
            themeIconLight.style.display = 'none';
        }

        themeToggle.addEventListener('click', () => {
            if (html.getAttribute('data-theme') === 'light') {
                html.removeAttribute('data-theme');
                localStorage.setItem('portfolio-theme', 'dark');
                themeIconDark.style.display = 'none';
                themeIconLight.style.display = 'block';
            } else {
                html.setAttribute('data-theme', 'light');
                localStorage.setItem('portfolio-theme', 'light');
                themeIconDark.style.display = 'block';
                themeIconLight.style.display = 'none';
            }
        });

        // Mobile Menu Toggle
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            menuToggle.classList.toggle('active');
            
            const icon = menuToggle.querySelector('i');
            if (navLinks.classList.contains('active')) {
                icon.classList.remove('fa-bars-staggered');
                icon.classList.add('fa-xmark');
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars-staggered');
            }
        });

        // Close menu when clicking a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                menuToggle.classList.remove('active');
                const icon = menuToggle.querySelector('i');
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars-staggered');
            });
        });

        // Active Link on Scroll
        const sections = document.querySelectorAll('section, header');
        const navItems = document.querySelectorAll('.nav-links a');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href').slice(1) === current) {
                    item.classList.add('active');
                }
            });
        });

        // Statistics Counter Animation
        const statsSection = document.querySelector('.about-stats');
        const statNumbers = document.querySelectorAll('.stat-number');

        const animateCounters = () => {
            statNumbers.forEach(el => {
                const text = el.innerText.trim();
                const match = text.match(/^([^\d]*?)(\d+)([^\d]*)$/);
                if (!match) return;

                const prefix = match[1];
                const target = parseInt(match[2], 10);
                const suffix = match[3];

                el.innerText = prefix + '0' + suffix;

                let currentVal = 0;
                const duration = 1500; // Animation duration in ms
                const startTime = performance.now();

                const updateCounter = (currentTime) => {
                    const elapsedTime = currentTime - startTime;
                    if (elapsedTime >= duration) {
                        el.innerText = text;
                        return;
                    }

                    const progress = elapsedTime / duration;
                    const easeProgress = progress * (2 - progress); // Ease out quad
                    currentVal = Math.floor(easeProgress * target);
                    el.innerText = prefix + currentVal + suffix;
                    requestAnimationFrame(updateCounter);
                };

                requestAnimationFrame(updateCounter);
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        if (statsSection) {
            observer.observe(statsSection);
        }
    </script>

    <!-- Modern Projects Modal -->
    <div id="service-projects-modal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <button class="modal-close-btn" id="modal-close-btn">&times;</button>
            <h2 id="modal-service-title" class="modal-title">Service Projects</h2>
            <div id="modal-projects-grid" class="modal-projects-grid">
                <!-- Dynamic project cards go here -->
            </div>
        </div>
    </div>

    <script>
        // Modal logic
        const modal = document.getElementById('service-projects-modal');
        const modalTitle = document.getElementById('modal-service-title');
        const modalGrid = document.getElementById('modal-projects-grid');
        const modalCloseBtn = document.getElementById('modal-close-btn');

        document.querySelectorAll('.view-service-projects-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const title = btn.getAttribute('data-service-title');
                const projects = JSON.parse(btn.getAttribute('data-projects'));

                modalTitle.innerText = `${title} Projects`;
                modalGrid.innerHTML = '';

                projects.forEach(project => {
                    const projectCard = document.createElement('div');
                    projectCard.className = 'modal-project-card';

                    const baseUrl = "{{ asset('') }}";
                    const imageUrl = project.image_path.startsWith('http') || project.image_path.startsWith('/') 
                        ? project.image_path 
                        : `${baseUrl}storage/${project.image_path}`;
                    
                    let linkHtml = '';
                    if (project.project_url) {
                        linkHtml += `<a href="${project.project_url}" target="_blank" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Site</a>`;
                    }
                    if (project.github_url) {
                        linkHtml += `<a href="${project.github_url}" target="_blank" class="btn btn-outline btn-sm" style="border: 1px solid var(--border-color);"><i class="fa-brands fa-github"></i> GitHub</a>`;
                    }
                    if (project.document_path) {
                        const docUrl = `${baseUrl}storage/${project.document_path}`;
                        linkHtml += `<a href="${docUrl}" target="_blank" class="btn btn-outline btn-sm" style="border: 1px solid var(--border-color);"><i class="fa-solid fa-file-pdf"></i> View Doc</a>`;
                    }

                    projectCard.innerHTML = `
                        <div class="modal-project-img">
                            <img src="${imageUrl}" alt="${project.title}">
                        </div>
                        <div class="modal-project-info">
                            <h3>${project.title}</h3>
                            <span class="modal-project-category">${project.category}</span>
                            <div class="modal-project-actions">
                                ${linkHtml}
                            </div>
                        </div>
                    `;
                    modalGrid.appendChild(projectCard);
                });

                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden'; // Disable scroll background
            });
        });

        const closeModal = () => {
            modal.style.display = 'none';
            document.body.style.overflow = ''; // Restore scroll
        };

        modalCloseBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                closeModal();
            }
        });
    </script>

    <!-- Project Gallery Lightbox Modal -->
    <div id="project-gallery-modal" class="modal-overlay" style="display: none;">
        <div class="modal-content gallery-modal-content">
            <button class="modal-close-btn" id="gallery-close-btn">&times;</button>
            <h2 id="gallery-project-title" class="modal-title">Project Designs</h2>
            <div class="gallery-slider-wrapper">
                <button class="slider-btn prev-btn" id="slider-prev-btn"><i class="fa-solid fa-chevron-left"></i></button>
                <div class="gallery-slider-image-container">
                    <img id="gallery-active-image" src="" alt="Active Gallery Image">
                </div>
                <button class="slider-btn next-btn" id="slider-next-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
            <div id="gallery-thumbnails" class="gallery-thumbnails">
                <!-- Thumbnail images go here -->
            </div>
        </div>
    </div>

    <script>
        // Project Gallery Lightbox Logic
        const galleryModal = document.getElementById('project-gallery-modal');
        const galleryTitle = document.getElementById('gallery-project-title');
        const activeImage = document.getElementById('gallery-active-image');
        const galleryCloseBtn = document.getElementById('gallery-close-btn');
        const thumbnailsContainer = document.getElementById('gallery-thumbnails');
        const prevBtn = document.getElementById('slider-prev-btn');
        const nextBtn = document.getElementById('slider-next-btn');

        let galleryImages = [];
        let currentImageIndex = 0;

        const showImage = (index) => {
            currentImageIndex = index;
            activeImage.style.opacity = 0;
            setTimeout(() => {
                activeImage.src = galleryImages[currentImageIndex];
                activeImage.style.opacity = 1;
            }, 150);

            // Update active thumbnail
            document.querySelectorAll('.gallery-thumbnail').forEach((thumb, idx) => {
                if (idx === currentImageIndex) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        };

        document.querySelectorAll('.view-project-gallery-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                const title = btn.getAttribute('data-project-title');
                const mainImg = btn.getAttribute('data-main-image');
                const additional = JSON.parse(btn.getAttribute('data-additional-images') || '[]');

                galleryImages = [mainImg, ...additional];
                galleryTitle.innerText = `${title} - Design Gallery`;
                
                // Render thumbnails
                thumbnailsContainer.innerHTML = '';
                galleryImages.forEach((imgUrl, idx) => {
                    const thumb = document.createElement('img');
                    thumb.src = imgUrl;
                    thumb.className = 'gallery-thumbnail';
                    thumb.addEventListener('click', () => showImage(idx));
                    thumbnailsContainer.appendChild(thumb);
                });

                showImage(0);
                galleryModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        });

        const closeGalleryModal = () => {
            galleryModal.style.display = 'none';
            document.body.style.overflow = '';
        };

        galleryCloseBtn.addEventListener('click', closeGalleryModal);
        galleryModal.addEventListener('click', (e) => {
            if (e.target === galleryModal) {
                closeGalleryModal();
            }
        });

        prevBtn.addEventListener('click', () => {
            let nextIdx = currentImageIndex - 1;
            if (nextIdx < 0) nextIdx = galleryImages.length - 1;
            showImage(nextIdx);
        });

        nextBtn.addEventListener('click', () => {
            let nextIdx = currentImageIndex + 1;
            if (nextIdx >= galleryImages.length) nextIdx = 0;
            showImage(nextIdx);
        });

        document.addEventListener('keydown', (e) => {
            if (galleryModal.style.display === 'flex') {
                if (e.key === 'Escape') closeGalleryModal();
                if (e.key === 'ArrowLeft') prevBtn.click();
                if (e.key === 'ArrowRight') nextBtn.click();
            }
        });
    </script>
</body>
</html>
