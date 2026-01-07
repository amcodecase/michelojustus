<section class="hero">
    <!-- Floating Decorative Elements -->
    <div class="hero-particles">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
        <div class="particle particle-5"></div>
        <div class="particle particle-6"></div>
    </div>
    
    <!-- Floating Geometric Shapes -->
    <div class="hero-shapes">
        <div class="shape shape-circle"></div>
        <div class="shape shape-square"></div>
        <div class="shape shape-triangle"></div>
    </div>
    
    <div class="container">
        <div class="hero-content">
            <!-- Typography-First Content Block -->
            <div class="hero-text gsap-slide-left">
                <div class="hero-label">
                    <span>
                        <lord-icon
                            src="https://cdn.lordicon.com/zzcjjfpz.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#ffffff,secondary:#8b5cf6"
                            style="width:16px;height:16px">
                        </lord-icon>
                        {{ $data['location'] }}
                    </span>
                    <span class="separator">•</span>
                    <span>
                        <lord-icon
                            src="https://cdn.lordicon.com/hrjifpbq.json"
                            trigger="loop"
                            delay="2500"
                            colors="primary:#ffffff,secondary:#ec4899"
                            style="width:16px;height:16px">
                        </lord-icon>
                        {{ $data['alias'] }}
                    </span>
                    <span class="separator">•</span>
                    <span class="code-demigod">
                        <lord-icon
                            src="https://cdn.lordicon.com/fhtaantg.json"
                            trigger="loop"
                            delay="3000"
                            colors="primary:#ffffff,secondary:#3b82f6"
                            style="width:16px;height:16px">
                        </lord-icon>
                        Code Demigod
                    </span>
                </div>
                
                <h1 x-text="mode === 'business' ? '{{ $data['business']['hero']['title'] }}' : '{{ $data['technical']['hero']['title'] }}'"></h1>
                
                <div class="hero-description">
                    <p 
                        x-text="mode === 'business' ? '{{ $data['business']['hero']['subtitle'] }}' : '{{ $data['technical']['hero']['subtitle'] }}'"
                    ></p>
                    
                    <p 
                        x-text="mode === 'business' ? '{{ $data['business']['hero']['description'] }}' : '{{ $data['technical']['hero']['description'] }}'"
                    ></p>
                </div>
                
                <p class="tagline">"{{ $data['tagline'] }}"</p>
                
                <!-- Signature -->
                <div class="hero-signature">
                    <img 
                        src="/images/gallery/signature.png" 
                        alt="Signature"
                        class="signature-img"
                        draggable="false"
                        oncontextmenu="return false;"
                        ondragstart="return false;"
                        onselectstart="return false;"
                        onmousedown="return false;">
                </div>
                
                <div class="hero-cta">
                    <a 
                        href="#services" 
                        class="btn btn-primary"
                    >
                        <lord-icon
                            src="https://cdn.lordicon.com/lomfljuq.json"
                            trigger="hover"
                            colors="primary:#1a1a2e,secondary:#10b981"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span x-text="mode === 'business' ? '{{ $data['business']['hero']['cta_primary'] }}' : '{{ $data['technical']['hero']['cta_primary'] }}'"></span>
                    </a>
                    <a 
                        href="#companies" 
                        class="btn btn-secondary"
                    >
                        <lord-icon
                            src="https://cdn.lordicon.com/cnpvyndp.json"
                            trigger="hover"
                            colors="primary:#ffffff,secondary:#10b981"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span x-text="mode === 'business' ? '{{ $data['business']['hero']['cta_secondary'] }}' : '{{ $data['technical']['hero']['cta_secondary'] }}'"></span>
                    </a>
                </div>
            </div>
            
            <!-- Asymmetric Visual Panel -->
            <div class="hero-visual gsap-scale">
                <!-- Primary Portrait: Dominant, Partially Cropped -->
                <div class="primary-portrait">
                    <img 
                        src="/images/gallery/img2.webp" 
                        srcset="/images/gallery/img2.webp 600w"
                        sizes="(max-width: 480px) 260px, (max-width: 968px) 340px, 420px"
                        alt="{{ $data['name'] }} - Software Engineer & ICT Educator"
                        width="600"
                        height="800"
                        decoding="async"
                        fetchpriority="high"
                        class="hero-img-transition"
                        onclick="openImageModal('/images/gallery/img2.webp', '2025 Devcon: AI Edition')">
                </div>
                
                <!-- Evidence Strip: Vertical Context Bar -->
                <div class="evidence-strip">
                    <img 
                        src="/images/gallery/img3.webp" 
                        alt="Professional context - System Developer"
                        width="200"
                        height="800"
                        decoding="async"
                        fetchpriority="high"
                        class="hero-img-transition"
                        onclick="openImageModal('/images/gallery/img3.webp', 'Professional Moment')">
                </div>
            </div>
        </div>
    </div>
</section>
