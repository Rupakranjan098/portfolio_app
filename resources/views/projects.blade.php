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
</head>
<body>
    <nav class="navbar container">
        <div class="logo">
            <div class="logo-icon">{{ strtoupper(substr($profile->name, 0, 1)) . strtoupper(substr(strrchr($profile->name, " "), 1, 1)) }}</div>
            <span class="logo-text">{{ $profile->name }}</span>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="{{ url('/') }}#home" class="active">Home</a></li>
            <li><a href="{{ url('/') }}#about">About</a></li>
            <li><a href="{{ url('/') }}#services">Services</a></li>
            <li><a href="{{ url('/') }}#projects">Projects</a></li>
            <li><a href="{{ url('/') }}#contact">Contact</a></li>
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

    

    

    

    <section id="projects" class="projects container">
        <div class="section-header">
            <div>
                <div class="section-label"><span class="badge-dot"></span> My Work</div>
                <h2 class="section-title">Featured Projects</h2>
            </div>
            
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
                        <li><a href="{{ url('/') }}#home">Home</a></li>
                        <li><a href="{{ url('/') }}#about">About</a></li>
                        <li><a href="{{ url('/') }}#services">Services</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4 style="opacity:0">.</h4>
                    <ul>
                        <li><a href="{{ url('/') }}#projects">Projects</a></li>
                        <li><a href="{{ url('/') }}#contact">Contact</a></li>
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
