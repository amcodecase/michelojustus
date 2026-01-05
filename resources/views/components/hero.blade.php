<section class="hero">
    <div class="container">
        <div class="hero-content">
            <!-- Typography-First Content Block -->
            <div class="hero-text gsap-slide-left">
                <div class="hero-label">
                    <span><i class="fa-solid fa-location-dot"></i> {{ $data['location'] }}</span>
                    <span class="separator">•</span>
                    <span><i class="fa-solid fa-user"></i> {{ $data['alias'] }}</span>
                    <span class="separator">•</span>
                    <span class="code-demigod"><i class="fa-solid fa-code"></i> Code Demigod</span>
                </div>
                
                <h1 x-text="mode === 'business' ? '{{ $data['business']['hero']['title'] }}' : '{{ $data['technical']['hero']['title'] }}'"></h1>
                
                <p class="tagline">"{{ $data['tagline'] }}"</p>
                
                <div class="hero-description">
                    <p 
                        x-text="mode === 'business' ? '{{ $data['business']['hero']['subtitle'] }}' : '{{ $data['technical']['hero']['subtitle'] }}'"
                    ></p>
                    
                    <p 
                        x-text="mode === 'business' ? '{{ $data['business']['hero']['description'] }}' : '{{ $data['technical']['hero']['description'] }}'"
                    ></p>
                </div>
                
                <div class="hero-cta">
                    <a 
                        href="#services" 
                        class="btn btn-primary"
                        x-text="mode === 'business' ? '{{ $data['business']['hero']['cta_primary'] }}' : '{{ $data['technical']['hero']['cta_primary'] }}'"
                    ></a>
                    <a 
                        href="#companies" 
                        class="btn btn-secondary"
                        x-text="mode === 'business' ? '{{ $data['business']['hero']['cta_secondary'] }}' : '{{ $data['technical']['hero']['cta_secondary'] }}'"
                    ></a>
                </div>
            </div>
            
            <!-- Asymmetric Visual Panel -->
            <div class="hero-visual gsap-scale">
                <!-- Primary Portrait: Dominant, Partially Cropped -->
                <div class="primary-portrait">
                    <img 
                        src="/images/gallery/img2.jpg" 
                        srcset="/images/gallery/img2.jpg 600w"
                        sizes="(max-width: 480px) 260px, (max-width: 968px) 340px, 420px"
                        alt="{{ $data['name'] }} - Software Engineer & ICT Educator"
                        width="600"
                        height="800"
                        decoding="async"
                        fetchpriority="high"
                        onclick="openImageModal('/images/gallery/img2.jpg', 'Primary Portrait')">
                </div>
                
                <!-- Evidence Strip: Vertical Context Bar -->
                <div class="evidence-strip">
                    <img 
                        src="/images/gallery/img3.jpg" 
                        srcset="/images/gallery/img3.jpg 200w"
                        sizes="(max-width: 480px) 60px, 80px"
                        alt="Professional context - System Developer"
                        width="200"
                        height="800"
                        loading="lazy"
                        decoding="async"
                        onclick="openImageModal('/images/gallery/img3.jpg', 'System Developer')">
                </div>
            </div>
        </div>
    </div>
</section>
