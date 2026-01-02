<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text gsap-slide-left">
                <h1 x-text="mode === 'business' ? '{{ $data['business']['hero']['title'] }}' : '{{ $data['technical']['hero']['title'] }}'"></h1>
                
                <p class="tagline">"{{ $data['tagline'] }}"</p>
                
                <p 
                    class="mb-3"
                    x-text="mode === 'business' ? '{{ $data['business']['hero']['subtitle'] }}' : '{{ $data['technical']['hero']['subtitle'] }}'"
                ></p>
                
                <p 
                    class="mb-3"
                    x-text="mode === 'business' ? '{{ $data['business']['hero']['description'] }}' : '{{ $data['technical']['hero']['description'] }}'"
                ></p>
                
                <div class="hero-meta">
                    <span><i class="fa-solid fa-location-dot"></i> {{ $data['location'] }}</span>
                    <span>•</span>
                    <span><i class="fa-solid fa-user"></i> {{ $data['alias'] }}</span>
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
            
            <div class="profile-image-wrapper gsap-scale">
                <div class="profile-gallery">
                    <div class="profile-image">
                        <img src="/images/gallery/img2.jpg" alt="{{ $data['name'] }}" 
                             data-title="What you do in the dark..." 
                             onclick="openImageModal('/images/gallery/img2.jpg', this.dataset.title)">
                    </div>
                    <div class="gallery-image">
                        <img src="/images/gallery/img1.jpg" alt="{{ $data['name'] }}" 
                             data-title="...will always come to light" 
                             onclick="openImageModal('/images/gallery/img1.jpg', this.dataset.title)">
                    </div>
                    <div class="gallery-image">
                        <img src="/images/gallery/img3.jpg" alt="{{ $data['name'] }}" 
                             data-title="Me as a System Developer" 
                             onclick="openImageModal('/images/gallery/img3.jpg', this.dataset.title)">
                    </div>
                    <div class="gallery-image">
                        <img src="/images/gallery/img4.jpg" alt="{{ $data['name'] }}" 
                             data-title="Playing chess at ZUFIAW 2025" 
                             onclick="openImageModal('/images/gallery/img4.jpg', this.dataset.title)">
                    </div>
                    <div class="gallery-image">
                        <img src="/images/gallery/img5.jpg" alt="{{ $data['name'] }}" 
                             data-title="During my internship" 
                             onclick="openImageModal('/images/gallery/img5.jpg', this.dataset.title)">
                    </div>
                </div>
                <div class="profile-glow"></div>
            </div>
        </div>
    </div>
</section>
