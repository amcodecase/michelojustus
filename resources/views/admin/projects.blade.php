<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Projects</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: #fafafa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            padding: 0;
            margin: 0;
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
        }
        .admin-header h1::before {
            content: '\f0b1';
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
        }
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .admin-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .add-btn {
            padding: 0.75rem 1.5rem;
            background: #1a1a2e;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        .add-btn:hover {
            background: #16213e;
        }
        .projects-list {
            background: white;
            border: 1px solid #e5e7eb;
        }
        .project-item {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }
        .project-item:last-child {
            border-bottom: none;
        }
        .project-item:hover {
            background: #f9fafb;
        }
        .project-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }
        .project-info h3 {
            color: #1a1a2e;
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
            font-weight: 600;
        }
        .project-meta {
            color: #6b7280;
            font-size: 0.8125rem;
            line-height: 1.6;
        }
        .project-description {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 1rem;
            font-size: 0.9375rem;
        }
        .project-actions {
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
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .btn-edit {
            color: #0284c7;
            border-color: #bae6fd;
            background: #f0f9ff;
        }
        .btn-edit:hover {
            background: #bae6fd;
        }
        .btn-delete {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }
        .btn-delete:hover {
            background: #fecaca;
        }
        .order-input {
            width: 70px;
            padding: 0.375rem 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 0;
            font-size: 0.8125rem;
        }
        .order-input:focus {
            outline: none;
            border-color: #1a1a2e;
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
            font-size: 0.9375rem;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }
        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h2 {
            margin: 0;
            font-size: 1.25rem;
            color: #1a1a2e;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            padding: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-body {
            padding: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0;
            font-size: 0.9375rem;
            font-family: inherit;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1a1a2e;
        }
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        .form-group-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        .modal-footer {
            padding: 1.5rem 2rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }
        .btn-primary {
            padding: 0.75rem 1.5rem;
            background: #1a1a2e;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9375rem;
        }
        .btn-primary:hover {
            background: #16213e;
        }
        .btn-secondary {
            padding: 0.75rem 1.5rem;
            background: white;
            color: #374151;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9375rem;
        }
        .btn-secondary:hover {
            background: #f9fafb;
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
            <h1>Projects Management</h1>
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
        <button class="add-btn" onclick="openModal()">
            <i class="fa-solid fa-plus"></i>
            Add New Project
        </button>
        
        <div class="projects-list" id="projectsList">
            <!-- Projects will be loaded here -->
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal" id="projectModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add New Project</h2>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form id="projectForm">
                <div class="modal-body">
                    <input type="hidden" id="projectId">
                    
                    <div class="form-group">
                        <label for="name">Project Name *</label>
                        <input type="text" id="name" required>
                    </div>
                    
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="owner">Owner/Client *</label>
                            <input type="text" id="owner" required>
                        </div>
                        <div class="form-group">
                            <label for="year">Year *</label>
                            <input type="text" id="year" pattern="[0-9]{4}" placeholder="2024" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description *</label>
                        <textarea id="description" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Project Image</label>
                        <input type="file" id="imageFile" accept="image/*" onchange="previewImage(this)">
                        <input type="hidden" id="image">
                        <div id="imagePreview" style="margin-top: 1rem; display: none;">
                            <img id="previewImg" style="max-width: 100%; max-height: 200px; border: 1px solid #e5e7eb;" alt="Preview">
                        </div>
                        <div id="uploadProgress" style="margin-top: 0.5rem; display: none;">
                            <div style="background: #e5e7eb; height: 4px; border-radius: 2px; overflow: hidden;">
                                <div id="progressBar" style="background: #1a1a2e; height: 100%; width: 0%; transition: width 0.3s;"></div>
                            </div>
                            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">Uploading...</p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="url">Project URL</label>
                        <input type="url" id="url" placeholder="https://example.com">
                    </div>
                    
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" id="category" placeholder="Web Development">
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="number" id="order" value="0" min="0">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="is_featured">
                            <label for="is_featured" style="margin: 0;">Featured Project</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn-primary">Save Project</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let editingProjectId = null;

        document.addEventListener('DOMContentLoaded', function() {
            loadProjects();

            document.getElementById('projectForm').addEventListener('submit', function(e) {
                e.preventDefault();
                saveProject();
            });
        });

        async function loadProjects() {
            try {
                const response = await fetch('/admin/api/projects');
                const result = await response.json();

                if (result.success) {
                    displayProjects(result.projects);
                }
            } catch (error) {
                console.error('Error loading projects:', error);
            }
        }

        function displayProjects(projects) {
            const container = document.getElementById('projectsList');
            
            if (projects.length === 0) {
                container.innerHTML = '<div class="empty-state">No projects yet. Click "Add New Project" to get started.</div>';
                return;
            }

            container.innerHTML = projects.map(p => `
                <div class="project-item">
                    <div class="project-header">
                        <div class="project-info">
                            <h3>${p.name}</h3>
                            <div class="project-meta">
                                <strong>Owner:</strong> ${p.owner} • 
                                <strong>Year:</strong> ${p.year}
                                ${p.category ? ` • <strong>Category:</strong> ${p.category}` : ''}
                                ${p.is_featured ? ' • <span style="color: #f59e0b;">⭐ Featured</span>' : ''}
                            </div>
                        </div>
                        <div class="project-actions">
                            <input type="number" 
                                   class="order-input" 
                                   value="${p.order}" 
                                   min="0"
                                   onchange="updateOrder(${p.id}, this.value)"
                                   title="Order">
                            <button class="btn btn-edit" onclick="editProject(${p.id})">
                                <i class="fa-solid fa-pen"></i>
                                Edit
                            </button>
                            <button class="btn btn-delete" onclick="deleteProject(${p.id})">
                                <i class="fa-solid fa-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                    <div class="project-description">${p.description}</div>
                    ${p.url ? `<div class="project-meta"><strong>URL:</strong> <a href="${p.url}" target="_blank">${p.url}</a></div>` : ''}
                    ${p.image ? `<div class="project-meta"><strong>Image:</strong> ${p.image}</div>` : ''}
                </div>
            `).join('');
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        async function uploadImage(file) {
            const formData = new FormData();
            formData.append('image', file);

            document.getElementById('uploadProgress').style.display = 'block';
            document.getElementById('progressBar').style.width = '50%';

            try {
                const response = await fetch('/admin/api/upload-image', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const result = await response.json();
                document.getElementById('progressBar').style.width = '100%';
                
                setTimeout(() => {
                    document.getElementById('uploadProgress').style.display = 'none';
                    document.getElementById('progressBar').style.width = '0%';
                }, 500);

                if (result.success) {
                    return result.path;
                } else {
                    throw new Error(result.message || 'Upload failed');
                }
            } catch (error) {
                document.getElementById('uploadProgress').style.display = 'none';
                console.error('Error uploading image:', error);
                alert('Error uploading image. Please try again.');
                return null;
            }
        }

        function openModal(project = null) {
            editingProjectId = project ? project.id : null;
            document.getElementById('modalTitle').textContent = project ? 'Edit Project' : 'Add New Project';
            
            if (project) {
                document.getElementById('projectId').value = project.id;
                document.getElementById('name').value = project.name;
                document.getElementById('owner').value = project.owner;
                document.getElementById('year').value = project.year;
                document.getElementById('description').value = project.description;
                document.getElementById('image').value = project.image || '';
                document.getElementById('url').value = project.url || '';
                document.getElementById('category').value = project.category || '';
                document.getElementById('order').value = project.order;
                document.getElementById('is_featured').checked = project.is_featured;
                
                if (project.image) {
                    document.getElementById('previewImg').src = project.image;
                    document.getElementById('imagePreview').style.display = 'block';
                }
            } else {
                document.getElementById('projectForm').reset();
                document.getElementById('projectId').value = '';
                document.getElementById('imagePreview').style.display = 'none';
            }
            
            document.getElementById('projectModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('projectModal').classList.remove('active');
            editingProjectId = null;
        }

        async function saveProject() {
            // Upload image if a new file was selected
            const imageFile = document.getElementById('imageFile').files[0];
            let imagePath = document.getElementById('image').value || null;
            
            if (imageFile) {
                imagePath = await uploadImage(imageFile);
                if (!imagePath) {
                    return; // Upload failed
                }
            }

            const data = {
                name: document.getElementById('name').value,
                owner: document.getElementById('owner').value,
                year: document.getElementById('year').value,
                description: document.getElementById('description').value,
                image: imagePath,
                url: document.getElementById('url').value || null,
                category: document.getElementById('category').value || null,
                order: parseInt(document.getElementById('order').value),
                is_featured: document.getElementById('is_featured').checked
            };

            try {
                const url = editingProjectId 
                    ? `/admin/api/projects/${editingProjectId}`
                    : '/admin/api/projects';
                const method = editingProjectId ? 'PUT' : 'POST';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                if (result.success) {
                    closeModal();
                    loadProjects();
                }
            } catch (error) {
                console.error('Error saving project:', error);
                alert('Error saving project. Please try again.');
            }
        }

        async function editProject(id) {
            try {
                const response = await fetch('/admin/api/projects');
                const result = await response.json();
                const project = result.projects.find(p => p.id === id);
                if (project) {
                    openModal(project);
                }
            } catch (error) {
                console.error('Error loading project:', error);
            }
        }

        async function updateOrder(id, order) {
            try {
                await fetch(`/admin/api/projects/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ order: parseInt(order) })
                });
                loadProjects();
            } catch (error) {
                console.error('Error updating order:', error);
            }
        }

        async function deleteProject(id) {
            if (!confirm('Delete this project? This cannot be undone.')) return;

            try {
                const response = await fetch(`/admin/api/projects/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();
                if (result.success) {
                    loadProjects();
                }
            } catch (error) {
                console.error('Error deleting project:', error);
            }
        }
    </script>
</body>
</html>
