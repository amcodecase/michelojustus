<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Get all approved testimonials
     */
    public function index()
    {
        $testimonials = Testimonial::approved()
            ->orderBy('ranking', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'testimonials' => $testimonials,
            'average_rating' => $testimonials->avg('rating'),
            'total_count' => $testimonials->count(),
        ]);
    }

    /**
     * Get all testimonials for admin (pending and approved)
     */
    public function adminIndex()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Update testimonial approval and ranking
     */
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->update([
            'is_approved' => $request->is_approved ?? $testimonial->is_approved,
            'ranking' => $request->ranking ?? $testimonial->ranking,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Testimonial updated successfully',
            'testimonial' => $testimonial,
        ]);
    }

    /**
     * Delete testimonial
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial deleted successfully',
        ]);
    }

    /**
     * Store a new testimonial
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:testimonials,email',
            'phone_number' => 'required|string|max:20',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $testimonial = Testimonial::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'ip_address' => $request->ip(),
            'is_approved' => false, // Requires manual approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your feedback! Your testimonial will be reviewed and published soon.',
            'testimonial' => $testimonial,
        ], 201);
    }

    /**
     * Check if email has already submitted
     */
    public function checkEmail(Request $request)
    {
        $exists = Testimonial::where('email', $request->email)->exists();
        
        return response()->json([
            'exists' => $exists,
        ]);
    }
}
