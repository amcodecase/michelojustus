<section id="services">
    <div class="container">
        <div class="section-header gsap-fade-in">
            <h2 x-text="mode === 'business' ? '{{ $data['business']['services']['title'] }}' : '{{ $data['technical']['services']['title'] }}'"></h2>
            <p x-text="mode === 'business' ? '{{ $data['business']['services']['subtitle'] }}' : '{{ $data['technical']['services']['subtitle'] }}'"></p>
        </div>
        
        <div class="services-grid">
            <template x-for="(service, index) in mode === 'business' ? {{ json_encode($data['business']['services']['items']) }} : {{ json_encode($data['technical']['services']['items']) }}" :key="index">
                <div class="service-card gsap-scale">
                    <div class="service-icon">
                        <i :class="{
                            'fa-solid fa-code': service.icon === 'code',
                            'fa-solid fa-rocket': service.icon === 'rocket',
                            'fa-solid fa-chart-line': service.icon === 'chart',
                            'fa-solid fa-shield-halved': service.icon === 'shield'
                        }"></i>
                    </div>
                    <h3 x-text="service.title"></h3>
                    <p x-text="service.description"></p>
                </div>
            </template>
        </div>
    </div>
</section>
