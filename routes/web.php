<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $data = require resource_path('data/profile.php');
    return view('home', compact('data'));
});

// Portfolio route
Route::get('/portfolio', [ProjectController::class, 'index']);

// Testimonial routes
Route::get('/api/testimonials', [TestimonialController::class, 'index']);
Route::post('/api/testimonials', [TestimonialController::class, 'store']);
Route::post('/api/testimonials/check-email', [TestimonialController::class, 'checkEmail']);

// Admin routes
Route::get('/admin/login', function () {
    if (session('admin_logged_in')) {
        return redirect('/admin/dashboard');
    }
    return view('admin.login');
});

Route::post('/admin/login', function (Request $request) {
    $user = \App\Models\User::where('email', $request->email)->first();
    
    if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        session(['admin_logged_in' => true, 'admin_user' => $user->name]);
        return redirect('/admin/dashboard');
    }
    
    return back()->withErrors(['Invalid credentials']);
});

Route::post('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect('/admin/login');
});

// Admin protected routes
Route::get('/admin/dashboard', function () {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    return view('admin.dashboard');
});

Route::get('/admin/testimonials', function () {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    return view('admin.testimonials');
});

Route::get('/admin/api/testimonials', function () {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    return app(TestimonialController::class)->adminIndex();
});

Route::put('/admin/api/testimonials/{id}', function ($id) {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    return app(TestimonialController::class)->update(request(), $id);
});

Route::delete('/admin/api/testimonials/{id}', function ($id) {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    return app(TestimonialController::class)->destroy($id);
});

Route::get('/admin/projects', function () {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    return view('admin.projects');
});

Route::get('/admin/api/projects', function () {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    return response()->json([
        'success' => true,
        'projects' => \App\Models\Project::orderBy('order')->orderBy('year', 'desc')->get()
    ]);
});

Route::post('/admin/api/projects', function (Request $request) {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'owner' => 'required|string|max:255',
        'description' => 'required|string',
        'year' => 'required|digits:4',
        'image' => 'nullable|string',
        'url' => 'nullable|url',
        'category' => 'nullable|string',
        'is_featured' => 'boolean',
        'order' => 'integer'
    ]);
    
    $project = \App\Models\Project::create($validated);
    return response()->json(['success' => true, 'project' => $project]);
});

Route::put('/admin/api/projects/{id}', function (Request $request, $id) {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    $project = \App\Models\Project::findOrFail($id);
    $validated = $request->validate([
        'name' => 'string|max:255',
        'owner' => 'string|max:255',
        'description' => 'string',
        'year' => 'digits:4',
        'image' => 'nullable|string',
        'url' => 'nullable|url',
        'category' => 'nullable|string',
        'is_featured' => 'boolean',
        'order' => 'integer'
    ]);
    
    $project->update($validated);
    return response()->json(['success' => true, 'project' => $project]);
});

Route::delete('/admin/api/projects/{id}', function ($id) {
    if (!session('admin_logged_in')) {
        return redirect('/admin/login');
    }
    $project = \App\Models\Project::findOrFail($id);
    $project->delete();
    return response()->json(['success' => true]);
});

Route::post('/admin/api/upload-image', function (Request $request) {
    if (!session('admin_logged_in')) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120' // 5MB max
    ]);
    
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        
        // Create projects directory if it doesn't exist
        $directory = public_path('images/projects');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        
        // Move the file
        $image->move($directory, $filename);
        
        return response()->json([
            'success' => true,
            'path' => '/images/projects/' . $filename
        ]);
    }
    
    return response()->json(['success' => false, 'message' => 'No image uploaded'], 400);
});
