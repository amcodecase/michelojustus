<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Testimonials Management</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .admin-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        .admin-header {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
        }
        .admin-grid {
            display: grid;
            gap: 1.5rem;
        }
        .admin-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        .admin-card.pending {
            border-left: 4px solid #FFA500;
        }
        .admin-card.approved {
            border-left: 4px solid #28a745;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
            gap: 1rem;
        }
        .card-info h4 {
            margin: 0 0 0.5rem 0;
            color: var(--primary);
        }
        .card-meta {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        .card-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .admin-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        .btn-approve {
            background: #28a745;
            color: white;
        }
        .btn-approve:hover {
            background: #218838;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        .ranking-input {
            width: 80px;
            padding: 0.5rem;
            border: 1px solid var(--border);
            border-radius: 6px;
        }
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1>Testimonials Management</h1>
                    <p>Review, approve, and rank testimonials</p>
                </div>
                <form method="POST" action="/admin/logout">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="admin-grid" id="testimonialsGrid">
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
                const grid = document.getElementById('testimonialsGrid');
                
                if (testimonials.length === 0) {
                    grid.innerHTML = '<p style="text-align: center; padding: 3rem;">No testimonials yet.</p>';
                    return;
                }

                grid.innerHTML = testimonials.map(t => `
                    <div class="admin-card ${t.is_approved ? 'approved' : 'pending'}">
                        <div class="card-header">
                            <div class="card-info">
                                <h4>${t.first_name} ${t.last_name}</h4>
                                <div class="card-meta">
                                    <div><strong>Email:</strong> ${t.email}</div>
                                    <div><strong>Phone:</strong> ${t.phone_number}</div>
                                    <div><strong>Rating:</strong> ${'⭐'.repeat(t.rating)}</div>
                                    <div><strong>Status:</strong> ${t.is_approved ? '✅ Approved' : '⏳ Pending'}</div>
                                    <div><strong>Date:</strong> ${new Date(t.created_at).toLocaleDateString()}</div>
                                </div>
                            </div>
                            <div class="card-actions">
                                <input type="number" 
                                       class="ranking-input" 
                                       value="${t.ranking}" 
                                       min="0" 
                                       max="100"
                                       onchange="updateRanking(${t.id}, this.value)"
                                       placeholder="Rank">
                                ${!t.is_approved ? `
                                    <button class="admin-btn btn-approve" onclick="approveTestimonial(${t.id})">
                                        <i class="fa-solid fa-check"></i> Approve
                                    </button>
                                ` : ''}
                                <button class="admin-btn btn-delete" onclick="deleteTestimonial(${t.id})">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                        <p style="margin: 1rem 0 0 0; line-height: 1.6;">${t.comment}</p>
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
