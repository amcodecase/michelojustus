<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user for testimonials management
        User::factory()->create([
            'name' => 'Michelo Justus',
            'email' => 'admin@michelojustus.com',
            'password' => Hash::make('admin123'),
        ]);

        // Create sample testimonials
        $testimonials = [
            [
                'first_name' => 'Chanda',
                'last_name' => 'Mwansa',
                'email' => 'chanda.mwansa@zaqa.gov.zm',
                'phone_number' => '+260977123456',
                'rating' => 5,
                'comment' => 'Michelo delivered exceptional work on our qualifications management system. His expertise in Laravel and database design helped us streamline our processes significantly. He was professional, met all deadlines, and provided excellent documentation.',
                'is_approved' => true,
                'ranking' => 95,
                'ip_address' => '41.77.11.23',
            ],
            [
                'first_name' => 'Bwalya',
                'last_name' => 'Katongo',
                'email' => 'bwalya.k@innovativedynamics.zm',
                'phone_number' => '+260966234567',
                'rating' => 5,
                'comment' => 'Working with Michelo has been a game-changer for our company. His full-stack development skills and DevOps knowledge allowed us to deploy reliable systems with proper CI/CD pipelines. Highly recommend him for any serious software project.',
                'is_approved' => true,
                'ranking' => 90,
                'ip_address' => '41.77.12.45',
            ],
            [
                'first_name' => 'Thandiwe',
                'last_name' => 'Phiri',
                'email' => 'thandiwe.phiri@pspf.gov.zm',
                'phone_number' => '+260955345678',
                'rating' => 5,
                'comment' => 'Michelo\'s contribution to our pension management system was invaluable. He implemented automated backup procedures and monitoring dashboards that significantly improved our operational efficiency. His technical skills and problem-solving abilities are top-notch.',
                'is_approved' => true,
                'ranking' => 85,
                'ip_address' => '41.77.13.67',
            ],
            [
                'first_name' => 'Mulenga',
                'last_name' => 'Banda',
                'email' => 'mulenga.banda@chau.ac.zm',
                'phone_number' => '+260971456789',
                'rating' => 5,
                'comment' => 'As a fellow educator at Chalimbana University, I\'ve witnessed Michelo\'s dedication to both teaching and technology. His ability to break down complex concepts for students while maintaining high technical standards is remarkable. A true asset to the ICT education community.',
                'is_approved' => true,
                'ranking' => 80,
                'ip_address' => '41.77.14.89',
            ],
            [
                'first_name' => 'Kabwe',
                'last_name' => 'Mbewe',
                'email' => 'kabwe.mbewe@uspireservices.com',
                'phone_number' => '+260962567890',
                'rating' => 5,
                'comment' => 'Michelo developed our client management system from scratch. His attention to detail, clean code, and comprehensive testing approach ensured we launched with zero critical issues. He also trained our team on system maintenance. Excellent developer!',
                'is_approved' => true,
                'ranking' => 75,
                'ip_address' => '41.77.15.12',
            ],
            [
                'first_name' => 'Mutinta',
                'last_name' => 'Mwape',
                'email' => 'mutinta.mwape@gmail.com',
                'phone_number' => '+260973678901',
                'rating' => 4,
                'comment' => 'I hired Michelo for tutoring in advanced database systems and software architecture. His teaching methodology is practical and effective. He uses real-world examples that made complex topics easy to understand. Would definitely recommend his mentorship services.',
                'is_approved' => true,
                'ranking' => 70,
                'ip_address' => '102.134.24.56',
            ],
            [
                'first_name' => 'Musonda',
                'last_name' => 'Chilufya',
                'email' => 'musonda.chilufya@outlook.com',
                'phone_number' => '+260964789012',
                'rating' => 5,
                'comment' => 'Michelo helped us migrate our legacy system to a modern Laravel application with Docker deployment. The entire process was smooth, well-documented, and completed ahead of schedule. His DevOps expertise saved us significant infrastructure costs.',
                'is_approved' => true,
                'ranking' => 65,
                'ip_address' => '102.134.25.78',
            ],
            [
                'first_name' => 'Nsama',
                'last_name' => 'Tembo',
                'email' => 'nsama.tembo@yahoo.com',
                'phone_number' => '+260975890123',
                'rating' => 5,
                'comment' => 'Outstanding work! Michelo built a custom CMS for our organization with an intuitive admin panel. He was responsive to feedback, implemented changes quickly, and delivered a product that exceeded our expectations. The system monitoring features he added have been incredibly useful.',
                'is_approved' => true,
                'ranking' => 60,
                'ip_address' => '102.134.26.90',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
