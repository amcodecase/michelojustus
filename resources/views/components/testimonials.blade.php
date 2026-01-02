<section id="testimonials" class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2>What People Say</h2>
            <p>Feedback from clients and colleagues</p>
        </div>

        <div class="testimonials-stats">
            <div class="stat-item">
                <div class="stat-value" id="avgRating">0.0</div>
                <div class="stat-stars" id="avgStars"></div>
                <div class="stat-label">Average Rating</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="totalReviews">0</div>
                <div class="stat-label">Total Reviews</div>
            </div>
        </div>

        <div class="testimonials-slider-wrapper">
            <button class="testimonials-nav testimonials-nav-prev" id="testimonialsNavPrev">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="testimonials-grid" id="testimonialsGrid">
                <!-- Testimonials will be loaded here -->
            </div>
            <button class="testimonials-nav testimonials-nav-next" id="testimonialsNavNext">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <button class="btn btn-primary open-modal-btn" id="openReviewModal">
            <i class="fa-solid fa-star"></i>
            Leave a Review
        </button>
    </div>
</section>

<!-- Testimonial Modal -->
<div class="testimonial-modal" id="testimonialModal">
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="modal-content">
        <button class="modal-close" id="closeModal">
            <i class="fa-solid fa-xmark"></i>
        </button>
        
        <div class="modal-header">
            <h3>Share Your Experience</h3>
            <p>Your feedback helps me improve and grow</p>
        </div>
        
        <form id="testimonialForm" class="testimonial-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name *</label>
                        <input type="text" id="firstName" name="first_name" required autocomplete="given-name">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name *</label>
                        <input type="text" id="lastName" name="last_name" required autocomplete="family-name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required autocomplete="email" placeholder="example@email.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <div class="phone-input-group">
                            <select id="countryCode" class="country-code-select">
                                <option value="+260" selected>ZM +260</option>
                                <option value="+1">US +1</option>
                                <option value="+44">GB +44</option>
                                <option value="+27">ZA +27</option>
                                <option value="+254">KE +254</option>
                                <option value="+255">TZ +255</option>
                                <option value="+256">UG +256</option>
                                <option value="+263">ZW +263</option>
                                <option value="+234">NG +234</option>
                                <option value="+91">IN +91</option>
                                <option value="+86">CN +86</option>
                                <option value="+81">JP +81</option>
                                <option value="+61">AU +61</option>
                                <option value="+49">DE +49</option>
                                <option value="+33">FR +33</option>
                            </select>
                            <input type="tel" id="phone" class="phone-number-input" placeholder="770822430" required>
                            <input type="hidden" id="fullPhone" name="phone_number">
                        </div>
                    </div>
                </div>

                <div class="form-group rating-group">
                    <label>Your Rating *</label>
                    <div class="star-rating-minimal" id="starRating">
                        <input type="radio" name="rating" id="star5" value="5">
                        <label for="star5"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" name="rating" id="star4" value="4">
                        <label for="star4"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" name="rating" id="star3" value="3">
                        <label for="star3"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" name="rating" id="star2" value="2">
                        <label for="star2"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" name="rating" id="star1" value="1">
                        <label for="star1"><i class="fa-solid fa-star"></i></label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="comment">Your Comment * (minimum 10 characters)</label>
                    <textarea id="comment" name="comment" rows="5" required minlength="10" maxlength="1000" spellcheck="true" class="spell-check"></textarea>
                    <span class="char-count">0 / 1000</span>
                </div>

                <div class="form-message" id="formMessage"></div>

                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fa-solid fa-paper-plane"></i>
                    Submit Review
                </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('testimonialModal');
    const openModalBtn = document.getElementById('openReviewModal');
    const closeModalBtn = document.getElementById('closeModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const testimonialForm = document.getElementById('testimonialForm');
    const formMessage = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');
    const commentField = document.getElementById('comment');
    const charCount = document.querySelector('.char-count');

    // Modal functionality
    openModalBtn.addEventListener('click', () => {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    closeModalBtn.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', closeModal);

    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });

    // Name capitalization - capitalize first letter of each word as user types
    const firstNameInput = document.getElementById('firstName');
    const lastNameInput = document.getElementById('lastName');

    function capitalizeInput(e) {
        const input = e.target;
        const start = input.selectionStart;
        const end = input.selectionEnd;
        
        const words = input.value.split(' ');
        const capitalized = words.map(word => {
            if (word.length > 0) {
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            }
            return word;
        }).join(' ');
        
        input.value = capitalized;
        input.setSelectionRange(start, end);
    }

    firstNameInput.addEventListener('input', capitalizeInput);
    lastNameInput.addEventListener('input', capitalizeInput);

    // Email lowercase - force lowercase as user types
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', function(e) {
        const start = this.selectionStart;
        const end = this.selectionEnd;
        this.value = this.value.toLowerCase();
        this.setSelectionRange(start, end);
    });

    // Phone number combination
    const countryCodeSelect = document.getElementById('countryCode');
    const phoneInput = document.getElementById('phone');
    const fullPhoneInput = document.getElementById('fullPhone');

    function updateFullPhone() {
        const countryCode = countryCodeSelect.value;
        const phoneNumber = phoneInput.value.replace(/\D/g, '');
        fullPhoneInput.value = countryCode + phoneNumber;
    }

    countryCodeSelect.addEventListener('change', updateFullPhone);
    phoneInput.addEventListener('input', updateFullPhone);

    // Character count
    commentField.addEventListener('input', function() {
        charCount.textContent = `${this.value.length} / 1000`;
    });

    // Load testimonials
    loadTestimonials();

    // Form submission
    testimonialForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const ratingValue = document.querySelector('input[name="rating"]:checked');
        if (!ratingValue) {
            showMessage('Please select a rating', 'error');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';

        const formData = new FormData(testimonialForm);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('/api/testimonials', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                showMessage(result.message, 'success');
                testimonialForm.reset();
                charCount.textContent = '0 / 1000';
                setTimeout(() => {
                    closeModal();
                    formMessage.style.display = 'none';
                }, 2000);
            } else {
                const errors = Object.values(result.errors).flat().join(', ');
                showMessage(errors, 'error');
            }
        } catch (error) {
            showMessage('An error occurred. Please try again.', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Submit Review';
        }
    });

    function showMessage(message, type) {
        formMessage.textContent = message;
        formMessage.className = `form-message ${type}`;
        formMessage.style.display = 'block';
        setTimeout(() => {
            formMessage.style.display = 'none';
        }, 5000);
    }

    async function loadTestimonials() {
        try {
            const response = await fetch('/api/testimonials');
            const result = await response.json();

            if (result.success) {
                displayStats(result.average_rating, result.total_count);
                displayTestimonials(result.testimonials);
            }
        } catch (error) {
            console.error('Error loading testimonials:', error);
        }
    }

    function displayStats(avgRating, totalCount) {
        document.getElementById('avgRating').textContent = avgRating ? avgRating.toFixed(1) : '0.0';
        document.getElementById('totalReviews').textContent = totalCount;
        
        const avgStars = document.getElementById('avgStars');
        avgStars.innerHTML = '';
        for (let i = 1; i <= 5; i++) {
            const star = document.createElement('i');
            star.className = i <= Math.round(avgRating) ? 'fa-solid fa-star' : 'fa-regular fa-star';
            avgStars.appendChild(star);
        }
    }

    function displayTestimonials(testimonials) {
        const grid = document.getElementById('testimonialsGrid');
        
        if (testimonials.length === 0) {
            grid.innerHTML = '<p class="no-testimonials">No testimonials yet. Be the first to share your experience!</p>';
            return;
        }

        grid.innerHTML = testimonials.map(t => `
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        ${t.first_name.charAt(0)}${t.last_name.charAt(0)}
                    </div>
                    <div class="testimonial-info">
                        <h4>${t.first_name} ${t.last_name}</h4>
                        <div class="testimonial-stars">
                            ${Array(5).fill(0).map((_, i) => 
                                `<i class="fa-${i < t.rating ? 'solid' : 'regular'} fa-star"></i>`
                            ).join('')}
                        </div>
                    </div>
                </div>
                <p class="testimonial-comment">${t.comment}</p>
                <div class="testimonial-date">${new Date(t.created_at).toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                })}</div>
            </div>
        `).join('');
    }

    // Testimonials navigation arrows
    const testimonialsGrid = document.getElementById('testimonialsGrid');
    const prevBtn = document.getElementById('testimonialsNavPrev');
    const nextBtn = document.getElementById('testimonialsNavNext');

    if (prevBtn && nextBtn && testimonialsGrid) {
        prevBtn.addEventListener('click', () => {
            testimonialsGrid.scrollBy({
                left: -370,
                behavior: 'smooth'
            });
        });

        nextBtn.addEventListener('click', () => {
            testimonialsGrid.scrollBy({
                left: 370,
                behavior: 'smooth'
            });
        });

        // Update button visibility based on scroll position
        function updateNavButtons() {
            const scrollLeft = testimonialsGrid.scrollLeft;
            const maxScroll = testimonialsGrid.scrollWidth - testimonialsGrid.clientWidth;

            if (scrollLeft <= 0) {
                prevBtn.style.opacity = '0.3';
                prevBtn.style.cursor = 'not-allowed';
            } else {
                prevBtn.style.opacity = '1';
                prevBtn.style.cursor = 'pointer';
            }

            if (scrollLeft >= maxScroll - 5) {
                nextBtn.style.opacity = '0.3';
                nextBtn.style.cursor = 'not-allowed';
            } else {
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
            }
        }

        testimonialsGrid.addEventListener('scroll', updateNavButtons);
        updateNavButtons();
    }});
</script>