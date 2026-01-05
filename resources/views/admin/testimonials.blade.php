<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Testimonials</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: #fafafa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            padding: 0;
            margin: 0;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(26, 26, 46, 0.02) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(26, 26, 46, 0.02) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .admin-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(45deg, rgba(255, 255, 255, 0.03) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(255, 255, 255, 0.03) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(255, 255, 255, 0.03) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(255, 255, 255, 0.03) 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            opacity: 0.5;
            pointer-events: none;
        }
        .admin-header-content {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex: 1;
        }
        .back-btn {
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
        }
        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .admin-header h1 {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            z-index: 1;
        }
        .admin-header h1::before {
            content: '\f005';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.5rem;
        }
        .logout-btn {
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
        }
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }
        .admin-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }
        .testimonials-container {
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .testimonial-item {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }
        .testimonial-item:last-child {
            border-bottom: none;
        }
        .testimonial-item:hover {
            background: #f9fafb;
        }
        .testimonial-item.pending {
            border-left: 3px solid #f59e0b;
        }
        .testimonial-item.approved {
            border-left: 3px solid #10b981;
        }
        .testimonial-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }
        .testimonial-info h3 {
            color: #1a1a2e;
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .testimonial-info h3::before {
            content: '\f007';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: #6b7280;
            font-size: 0.875rem;
        }
        .testimonial-meta {
            color: #6b7280;
            font-size: 0.8125rem;
            line-height: 1.6;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        .testimonial-meta::before {
            content: '\f0e0';
            font-family: 'Font Awesome 6 Free';
            font-weight: 400;
            color: #9ca3af;
        }
        .testimonial-stars {
            color: #fbbf24;
            margin: 0.5rem 0;
            font-size: 0.875rem;
        }
        .testimonial-comment {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 1rem;
            font-size: 0.9375rem;
        }
        .testimonial-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .btn {
            padding: 0.375rem 0.875rem;
            border: 1px solid #e5e7eb;
            border-radius: 0;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.8125rem;
            transition: all 0.2s ease;
            background: white;
        }
        .btn-approve {
            color: #059669;
            border-color: #d1fae5;
            background: #f0fdf4;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .btn-approve:hover {
            background: #d1fae5;
        }
        .btn-approve::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        .btn-delete {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .btn-delete:hover {
            background: #fecaca;
        }
        .btn-delete::before {
            content: '\f2ed';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        .ranking-input {
            width: 70px;
            padding: 0.375rem 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 0;
            font-size: 0.8125rem;
        }
        .ranking-input:focus {
            outline: none;
            border-color: #1a1a2e;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.625rem;
            border-radius: 0;
            font-size: 0.6875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .status-badge::before {
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        .status-pending::before {
            content: '\f017';
        }
        .status-approved {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .status-approved::before {
            content: '\f058';
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
            font-size: 0.9375rem;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="admin-header-content">
            <a href="/admin/dashboard" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Dashboard
            </a>
            <h1>Testimonials Management</h1>
        </div>
        <form method="POST" action="/admin/logout" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

    <div class="admin-content">
        <div class="testimonials-container" id="testimonialsContainer">
            <!-- Testimonials will be loaded here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadTestimonials();

            async function loadTestimonials() {
                try {
                    const response = await fetch('/admin/api/testimonials');
                    const result = await response.json();

                    if (result.success) {
                        displayTestimonials(result.testimonials);
                    }
                } catch (error) {
                    console.error('Error loading testimonials:', error);
                }
            }

            function displayTestimonials(testimonials) {
                const container = document.getElementById('testimonialsContainer');
                
                if (testimonials.length === 0) {
                    container.innerHTML = '<div class="empty-state">No testimonials yet.</div>';
                    return;
                }

                container.innerHTML = testimonials.map(t => `
                    <div class="testimonial-item ${t.is_approved ? 'approved' : 'pending'}">
                        <div class="testimonial-header">
                            <div class="testimonial-info">
                                <h3>${t.first_name} ${t.last_name}</h3>
                                <div class="testimonial-meta">
                                    ${t.email} • ${t.phone_number}
                                </div>
                                <div class="testimonial-stars">
                                    ${'★'.repeat(t.rating)}${'☆'.repeat(5 - t.rating)}
                                </div>
                                <span class="status-badge ${t.is_approved ? 'status-approved' : 'status-pending'}">
                                    ${t.is_approved ? 'Approved' : 'Pending'}
                                </span>
                            </div>
                            <div class="testimonial-actions">
                                <input type="number" 
                                       class="ranking-input" 
                                       value="${t.ranking}" 
                                       min="0" 
                                       max="100"
                                       onchange="updateRanking(${t.id}, this.value)"
                                       placeholder="Rank"
                                       title="Ranking (0-100)">
                                ${!t.is_approved ? `
                                    <button class="btn btn-approve" onclick="approveTestimonial(${t.id})">
                                        Approve
                                    </button>
                                ` : ''}
                                <button class="btn btn-delete" onclick="deleteTestimonial(${t.id})">
                                    Delete
                                </button>
                            </div>
                        </div>
                        <div class="testimonial-comment">${t.comment}</div>
                        <div class="testimonial-meta">
                            ${new Date(t.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}
                        </div>
                    </div>
                `).join('');
            }

            window.approveTestimonial = async function(id) {
                if (!confirm('Approve this testimonial?')) return;

                try {
                    const response = await fetch(`/admin/api/testimonials/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ is_approved: true })
                    });

                    const result = await response.json();
                    if (result.success) {
                        loadTestimonials();
                    }
                } catch (error) {
                    console.error('Error approving testimonial:', error);
                }
            };

            window.updateRanking = async function(id, ranking) {
                try {
                    const response = await fetch(`/admin/api/testimonials/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ ranking: parseInt(ranking) })
                    });

                    const result = await response.json();
                    if (result.success) {
                        console.log('Ranking updated');
                    }
                } catch (error) {
                    console.error('Error updating ranking:', error);
                }
            };

            window.deleteTestimonial = async function(id) {
                if (!confirm('Delete this testimonial? This cannot be undone.')) return;

                try {
                    const response = await fetch(`/admin/api/testimonials/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const result = await response.json();
                    if (result.success) {
                        loadTestimonials();
                    }
                } catch (error) {
                    console.error('Error deleting testimonial:', error);
                }
            };
        });
    </script>
</body>
</html>
