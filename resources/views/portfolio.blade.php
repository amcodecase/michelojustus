@extends('layouts.app')

@section('content')
<section class="portfolio-hero">
    <div class="container">
        <div class="portfolio-header">
            <h1>Portfolio Showcase</h1>
            <p>A curated collection of projects I've built and contributed to over the years</p>
        </div>
    </div>
</section>

<section class="portfolio-grid-section">
    <div class="container">
        @if($projects->count() > 0)
            <div class="portfolio-grid">
                @foreach($projects as $project)
                    <div class="portfolio-card">
                        @if($project->image)
                            <div class="portfolio-image" onclick="openImageModal('{{ $project->image }}', '{{ $project->name }}')" style="cursor: pointer;">
                                <img src="{{ $project->image }}" alt="{{ $project->name }}" loading="lazy">
                                <div class="portfolio-overlay">
                                    <span class="portfolio-year">{{ $project->year }}</span>
                                    <div class="portfolio-zoom-icon">
                                        <i class="fa-solid fa-expand"></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <div class="portfolio-content">
                            <div class="portfolio-meta">
                                <span class="portfolio-owner">
                                    <i class="fa-solid fa-building"></i>
                                    {{ $project->owner }}
                                </span>
                                @if($project->category)
                                    <span class="portfolio-category">{{ $project->category }}</span>
                                @endif
                            </div>
                            
                            <h3>{{ $project->name }}</h3>
                            <p>{{ $project->description }}</p>
                            
                            <div class="portfolio-footer">
                                @if($project->url)
                                    <a href="{{ $project->url }}" target="_blank" class="portfolio-link">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        View Project
                                    </a>
                                @endif
                                @if($project->image)
                                    <button onclick="openImageModal('{{ $project->image }}', '{{ $project->name }}')" class="portfolio-view-btn">
                                        <i class="fa-solid fa-image"></i>
                                        View Image
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="portfolio-empty">
                <i class="fa-solid fa-folder-open"></i>
                <h3>No Projects Yet</h3>
                <p>Projects will be added soon. Check back later!</p>
            </div>
        @endif
    </div>
</section>

<!-- Portfolio Image Modal -->
<div class="portfolio-modal" id="portfolioModal" onclick="closePortfolioModal()">
    <div class="portfolio-modal-content" onclick="event.stopPropagation()">
        <button class="portfolio-modal-close" onclick="closePortfolioModal()">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <img id="portfolioModalImage" src="" alt="">
        <div class="portfolio-modal-caption" id="portfolioModalCaption"></div>
    </div>
</div>

<script>
    function openImageModal(imageSrc, caption) {
        document.getElementById('portfolioModalImage').src = imageSrc;
        document.getElementById('portfolioModalCaption').textContent = caption;
        document.getElementById('portfolioModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closePortfolioModal() {
        document.getElementById('portfolioModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePortfolioModal();
        }
    });
</script>
@endsection
