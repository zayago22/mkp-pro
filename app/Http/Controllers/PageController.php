<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SocialLink;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function home()
    {
        $projects = Project::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('welcome', compact('projects', 'testimonials', 'socialLinks'));
    }
}
