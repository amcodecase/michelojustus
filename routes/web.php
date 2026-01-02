<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $data = require resource_path('data/profile.php');
    return view('home', compact('data'));
});

// Testimonial routes
Route::get('/api/testimonials', [TestimonialController::class, 'index']);
Route::post('/api/testimonials', [TestimonialController::class, 'store']);
Route::post('/api/testimonials/check-email', [TestimonialController::class, 'checkEmail']);

// Admin routes
Route::get('/admin/login', function () {
    if (session('admin_logged_in')) {
        return redirect('/admin/testimonials');
    }
    return view('admin.login');
});

Route::post('/admin/login', function (Request $request) {
    $user = \App\Models\User::where('email', $request->email)->first();
    
    if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        session(['admin_logged_in' => true, 'admin_user' => $user->name]);
        return redirect('/admin/testimonials');
    }
    
    return back()->withErrors(['Invalid credentials']);
});

Route::post('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect('/admin/login');
});

// Admin protected routes
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
