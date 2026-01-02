<section id="companies" class="companies-section">
    <div class="logos-scroll">
        @foreach($data['companies'] as $company)
            <div class="logo-item">
                <img 
                    src="{{ $company['logo'] }}" 
                    alt="{{ $company['name'] }}"
                >
            </div>
        @endforeach
        @foreach($data['companies'] as $company)
            <div class="logo-item">
                <img 
                    src="{{ $company['logo'] }}" 
                    alt="{{ $company['name'] }}"
                >
            </div>
        @endforeach
        @foreach($data['companies'] as $company)
            <div class="logo-item">
                <img 
                    src="{{ $company['logo'] }}" 
                    alt="{{ $company['name'] }}"
                >
            </div>
        @endforeach
    </div>
</section>
