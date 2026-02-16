<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\SocialLink;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'projectsCount' => Project::count(),
            'testimonialsCount' => Testimonial::count(),
            'postsCount' => BlogPost::count(),
            'socialLinksCount' => SocialLink::count(),
            'messagesCount' => ContactMessage::count(),
            'unreadCount' => ContactMessage::where('is_read', false)->count(),
        ]);
    }
}
