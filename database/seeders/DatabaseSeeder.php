<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\Project;
use App\Models\SocialLink;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'contacto@mobilkitchenpro.com'],
            ['name' => 'Admin', 'password' => bcrypt('Clave2230!')]
        );

        // Projects
        $projects = [
            ['title' => 'Classic BBQ Food Truck', 'category' => 'food_truck', 'short_description' => 'A fully equipped BBQ food truck with custom smoker and serving windows.'],
            ['title' => 'Gourmet Taco Truck', 'category' => 'food_truck', 'short_description' => 'Modern taco truck with full kitchen, wrap design and LED lighting.'],
            ['title' => 'Mobile Catering Kitchen', 'category' => 'mobile_kitchen', 'short_description' => 'Large-scale mobile kitchen for catering events up to 500 people.'],
            ['title' => 'Ice Cream Truck Deluxe', 'category' => 'food_truck', 'short_description' => 'Custom ice cream truck with display freezers and colorful wrap.'],
            ['title' => 'Event Mobile Kitchen', 'category' => 'mobile_kitchen', 'short_description' => 'Portable kitchen trailer for festivals, fairs and corporate events.'],
            ['title' => 'Pizza Food Truck', 'category' => 'food_truck', 'short_description' => 'Wood-fired pizza truck with brick oven and prep station.'],
        ];

        foreach ($projects as $i => $p) {
            Project::firstOrCreate(
                ['slug' => Str::slug($p['title'])],
                array_merge($p, [
                    'description' => $p['short_description'] . ' Built with premium materials and custom equipment.',
                    'order' => $i,
                    'is_active' => true,
                ])
            );
        }

        // Testimonials
        $testimonials = [
            ['quote' => 'Outstanding quality and professionalism. Our food truck exceeded expectations. Highly recommend Mobile Kitchen Pro!', 'author_name' => 'Sarah K.', 'author_title' => 'Food Truck Owner', 'rating' => 5],
            ['quote' => 'From design to delivery, the team was incredible. Our mobile kitchen is a game-changer for our catering business.', 'author_name' => 'James M.', 'author_title' => 'Catering Company Owner', 'rating' => 5],
            ['quote' => 'Best investment we ever made. The truck runs flawlessly and the build quality is top-notch.', 'author_name' => 'Maria L.', 'author_title' => 'Restaurant Owner', 'rating' => 5],
            ['quote' => 'They understood exactly what we needed and delivered on time. The attention to detail is amazing.', 'author_name' => 'Robert P.', 'author_title' => 'Event Planner', 'rating' => 4],
        ];

        foreach ($testimonials as $i => $t) {
            Testimonial::firstOrCreate(
                ['author_name' => $t['author_name']],
                array_merge($t, ['order' => $i, 'is_active' => true])
            );
        }

        // Social Links
        $socials = [
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/mobilkitchenpro', 'icon' => 'facebook'],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/mobilkitchenpro', 'icon' => 'instagram'],
            ['platform' => 'Twitter', 'url' => 'https://twitter.com/mobilkitchenpro', 'icon' => 'twitter'],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com/@mobilkitchenpro', 'icon' => 'youtube'],
            ['platform' => 'TikTok', 'url' => 'https://tiktok.com/@mobilkitchenpro', 'icon' => 'tiktok'],
        ];

        foreach ($socials as $i => $s) {
            SocialLink::firstOrCreate(
                ['platform' => $s['platform']],
                array_merge($s, ['order' => $i, 'is_active' => true])
            );
        }

        // Blog Categories
        $catNews = BlogCategory::firstOrCreate(['slug' => 'industry-news'], ['name' => 'Industry News']);
        $catTips = BlogCategory::firstOrCreate(['slug' => 'tips-tricks'], ['name' => 'Tips & Tricks']);
        $catShowcase = BlogCategory::firstOrCreate(['slug' => 'project-showcase'], ['name' => 'Project Showcase']);

        // Blog Tags
        $tagFoodTruck = BlogTag::firstOrCreate(['slug' => 'food-truck'], ['name' => 'Food Truck']);
        $tagMobile = BlogTag::firstOrCreate(['slug' => 'mobile-kitchen'], ['name' => 'Mobile Kitchen']);
        $tagDesign = BlogTag::firstOrCreate(['slug' => 'design'], ['name' => 'Design']);
        $tagBusiness = BlogTag::firstOrCreate(['slug' => 'business'], ['name' => 'Business']);

        // Blog Posts
        $post1 = BlogPost::firstOrCreate(['slug' => '5-things-to-consider-before-buying-a-food-truck'], [
            'title' => '5 Things to Consider Before Buying a Food Truck',
            'excerpt' => 'Planning to start a food truck business? Here are the top 5 things you need to know before making your purchase.',
            'body' => "Starting a food truck business is an exciting venture, but it requires careful planning. Here are the top 5 things you should consider:\n\n1. Budget - Know your total budget including equipment, permits, and initial inventory.\n\n2. Menu Concept - Your menu determines the equipment and space you need.\n\n3. Local Regulations - Research permits, health department requirements, and zoning laws.\n\n4. Equipment Needs - List all the equipment you need for your menu.\n\n5. Maintenance Plan - Plan for regular maintenance to keep your truck running smoothly.",
            'category_id' => $catTips->id,
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);
        $post1->tags()->syncWithoutDetaching([$tagFoodTruck->id, $tagBusiness->id]);

        $post2 = BlogPost::firstOrCreate(['slug' => 'food-truck-industry-trends-2026'], [
            'title' => 'Food Truck Industry Trends in 2026',
            'excerpt' => 'The food truck industry continues to evolve. Discover the latest trends shaping mobile food businesses this year.',
            'body' => "The food truck industry is booming in 2026. Here are the trends we're seeing:\n\n- Electric and hybrid food trucks are on the rise\n- Ghost kitchen + food truck hybrid models\n- Sustainable packaging and eco-friendly practices\n- Social media-driven marketing strategies\n- Technology integration for ordering and payments\n\nAt Mobile Kitchen Pro, we're staying ahead of these trends to deliver the best mobile units for our clients.",
            'category_id' => $catNews->id,
            'is_published' => true,
            'published_at' => now()->subDays(2),
        ]);
        $post2->tags()->syncWithoutDetaching([$tagFoodTruck->id, $tagMobile->id]);

        $post3 = BlogPost::firstOrCreate(['slug' => 'custom-bbq-truck-build-showcase'], [
            'title' => 'Custom BBQ Truck Build Showcase',
            'excerpt' => 'Take a behind-the-scenes look at our latest custom BBQ food truck build from start to finish.',
            'body' => "We're proud to showcase our latest build - a custom BBQ food truck built from the ground up.\n\nThis truck features:\n- Custom-built smoker with temperature control\n- Full commercial kitchen with prep stations\n- Eye-catching wrap design\n- LED exterior lighting\n- Generator and electrical system\n\nThe build took 6 weeks from design to delivery. Our client is now serving award-winning BBQ across Houston!",
            'category_id' => $catShowcase->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);
        $post3->tags()->syncWithoutDetaching([$tagFoodTruck->id, $tagDesign->id]);
    }
}
