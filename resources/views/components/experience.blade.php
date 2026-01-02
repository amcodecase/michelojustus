<section id="achievements">
    <div class="container">
        <div class="section-header gsap-fade-in">
            <h2 x-text="mode === 'business' ? '{{ $data['business']['experience']['title'] }}' : '{{ $data['technical']['experience']['title'] }}'"></h2>
            <p x-text="mode === 'business' ? '{{ $data['business']['experience']['subtitle'] }}' : '{{ $data['technical']['experience']['subtitle'] }}'"></p>
        </div>
        
        <div class="stats-grid">
            <template x-for="(item, index) in mode === 'business' ? {{ json_encode($data['business']['experience']['items']) }} : {{ json_encode($data['technical']['experience']['items']) }}" :key="index">
                <div class="stat-card gsap-scale" style="position: relative;">
                    <template x-if="item.metric === 'BICT'">
                        <div class="distinction-badge">Distinction</div>
                    </template>
                    <div class="stat-metric" x-text="item.metric"></div>
                    <div class="stat-label" x-text="item.label"></div>
                    <p class="stat-description" x-text="item.description"></p>
                </div>
            </template>
        </div>
    </div>
</section>
