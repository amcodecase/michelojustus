<!DOCTYPE html>
<html lang="en" x-data="{ mode: 'business' }" x-cloak>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Michelo M Justus - Software Engineer, Systems Developer & ICT Educator specializing in Laravel, Django, Next.js, and DevOps">
    <meta name="theme-color" content="#1a1a2e">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Michelo Justus">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/icon-192.png">
    <link rel="apple-touch-icon" href="/images/icon-192.png">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/style.css?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">Michelo M Justus</div>
            <div class="mode-toggle">
                <button 
                    @click="mode = 'business'" 
                    :class="{ 'active': mode === 'business' }"
                >
                    Business
                </button>
                <button 
                    @click="mode = 'technical'" 
                    :class="{ 'active': mode === 'technical' }"
                >
                    Technical
                </button>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Image Modal -->
    <div class="image-modal" id="imageModal" onclick="event.target === this && closeImageModal()">
        <button class="image-modal-close" onclick="closeImageModal()">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <button class="modal-nav modal-nav-prev" onclick="navigateModal(-1)">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="modal-nav modal-nav-next" onclick="navigateModal(1)">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
        <div class="modal-content-wrapper" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="Full size image">
            <p id="modalCaption" class="modal-caption"></p>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Michelo M Justus</h3>
                    <p>Software Engineer, Systems Developer & ICT Educator</p>
                </div>
                
                <div class="footer-section">
                    <h3>Navigation</h3>
                    <ul class="footer-links">
                        <li><a href="#services">Services</a></li>
                        <li><a href="#companies">Experience</a></li>
                        <li><a href="#achievements">Achievements</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Connect</h3>
                    <div class="footer-social">
                        <a href="https://www.linkedin.com/in/amcodecase" target="_blank" rel="noopener noreferrer" title="LinkedIn">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                        <a href="https://wa.me/260770822430" target="_blank" rel="noopener noreferrer" title="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="#" title="Location: Zambia">
                            <i class="fa-solid fa-location-dot"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Michelo M Justus. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        // Image Modal Functions
        const galleryImages = [
            { src: '/images/gallery/img2.jpg', title: 'What you do in the dark...' },
            { src: '/images/gallery/img1.jpg', title: '...will always come to light' },
            { src: '/images/gallery/img3.jpg', title: 'Me as a System Developer' },
            { src: '/images/gallery/img4.jpg', title: 'Playing chess at ZUFIAW 2025' },
            { src: '/images/gallery/img5.jpg', title: 'During my internship' }
        ];
        let currentImageIndex = 0;

        function openImageModal(imageSrc, title) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');
            
            // Find current image index
            currentImageIndex = galleryImages.findIndex(img => img.src === imageSrc);
            if (currentImageIndex === -1) currentImageIndex = 0;
            
            modalImage.src = imageSrc;
            modalCaption.textContent = title || '';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function navigateModal(direction) {
            currentImageIndex = (currentImageIndex + direction + galleryImages.length) % galleryImages.length;
            const currentImage = galleryImages[currentImageIndex];
            
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');
            
            modalImage.style.opacity = '0';
            modalCaption.style.opacity = '0';
            
            setTimeout(() => {
                modalImage.src = currentImage.src;
                modalCaption.textContent = currentImage.title;
                modalImage.style.opacity = '1';
                modalCaption.style.opacity = '1';
            }, 200);
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // PWA Install Prompt
        let deferredPrompt;
        const installBanner = document.createElement('div');
        installBanner.className = 'pwa-install-banner';
        installBanner.innerHTML = `
            <div class="pwa-banner-content">
                <div class="pwa-banner-text">
                    <i class="fa-solid fa-download"></i>
                    <span>Install this app for a better experience!</span>
                </div>
                <div class="pwa-banner-actions">
                    <button class="pwa-install-btn" id="installBtn">Install</button>
                    <button class="pwa-close-btn" id="closeBtn">&times;</button>
                </div>
            </div>
        `;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            
            // Check if user has dismissed the banner before
            const dismissed = localStorage.getItem('pwa-dismissed');
            if (!dismissed) {
                document.body.appendChild(installBanner);
                setTimeout(() => installBanner.classList.add('show'), 100);
            }
        });

        document.addEventListener('click', (e) => {
            if (e.target.id === 'installBtn') {
                if (deferredPrompt) {
                    deferredPrompt.prompt();
                    deferredPrompt.userChoice.then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            console.log('User accepted the install prompt');
                            installBanner.remove();
                        }
                        deferredPrompt = null;
                    });
                }
            }
            
            if (e.target.id === 'closeBtn') {
                installBanner.classList.remove('show');
                setTimeout(() => installBanner.remove(), 300);
                // Show again after 24 hours
                const tomorrow = new Date();
                tomorrow.setHours(tomorrow.getHours() + 24);
                localStorage.setItem('pwa-dismissed', tomorrow.getTime());
            }
        });

        // Check if dismissed time has passed
        const dismissedTime = localStorage.getItem('pwa-dismissed');
        if (dismissedTime && new Date().getTime() > parseInt(dismissedTime)) {
            localStorage.removeItem('pwa-dismissed');
        }

        // Register service worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('ServiceWorker registered:', registration);
                    })
                    .catch((error) => {
                        console.log('ServiceWorker registration failed:', error);
                    });
            });
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            gsap.registerPlugin(ScrollTrigger);
            
            // Animate elements on scroll
            gsap.utils.toArray('.gsap-fade-in').forEach((elem) => {
                gsap.to(elem, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: elem,
                        start: 'top 85%',
                        toggleActions: 'play none none none'
                    }
                });
            });
            
            gsap.utils.toArray('.gsap-slide-left').forEach((elem) => {
                gsap.to(elem, {
                    opacity: 1,
                    x: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: elem,
                        start: 'top 85%',
                        toggleActions: 'play none none none'
                    }
                });
            });
            
            gsap.utils.toArray('.gsap-slide-right').forEach((elem) => {
                gsap.to(elem, {
                    opacity: 1,
                    x: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: elem,
                        start: 'top 85%',
                        toggleActions: 'play none none none'
                    }
                });
            });
            
            gsap.utils.toArray('.gsap-scale').forEach((elem) => {
                gsap.to(elem, {
                    opacity: 1,
                    scale: 1,
                    duration: 0.6,
                    ease: 'back.out(1.2)',
                    scrollTrigger: {
                        trigger: elem,
                        start: 'top 85%',
                        toggleActions: 'play none none none'
                    }
                });
            });
            
            // Mode switch animation
            document.addEventListener('alpine:initialized', () => {
                const modeButtons = document.querySelectorAll('.mode-toggle button');
                modeButtons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        gsap.from('main section', {
                            opacity: 0.7,
                            duration: 0.3,
                            ease: 'power1.inOut'
                        });
                    });
                });
            });
        });
    </script>
</body>
</html>
