<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::orderBy('order')->get();
        return view('admin.social-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:50',
            'url' => 'required|url|max:500',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        SocialLink::create($data);
        return redirect()->route('admin.social-links.index')->with('success', 'Social link created.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:50',
            'url' => 'required|url|max:500',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $socialLink->update($data);
        return redirect()->route('admin.social-links.index')->with('success', 'Social link updated.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.social-links.index')->with('success', 'Social link deleted.');
    }
}
