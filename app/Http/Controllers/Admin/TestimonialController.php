<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'quote_en' => 'required|string',
            'quote_es' => 'nullable|string',
            'author_title_en' => 'nullable|string|max:255',
            'author_title_es' => 'nullable|string|max:255',
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);
        $data['quote'] = $data['quote_en'];
        $data['author_title'] = $data['author_title_en'] ?? null;
        $data['is_active'] = $request->boolean('is_active');

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'quote_en' => 'required|string',
            'quote_es' => 'nullable|string',
            'author_title_en' => 'nullable|string|max:255',
            'author_title_es' => 'nullable|string|max:255',
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);
        $data['quote'] = $data['quote_en'];
        $data['author_title'] = $data['author_title_en'] ?? null;
        $data['is_active'] = $request->boolean('is_active');

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }
}
