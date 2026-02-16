<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_es' => 'nullable|string|max:255',
            'short_description_en' => 'nullable|string|max:500',
            'short_description_es' => 'nullable|string|max:500',
            'description_en' => 'nullable|string',
            'description_es' => 'nullable|string',
            'category' => 'required|in:food_truck,mobile_kitchen',
            'image' => 'required|image|max:5120',
            'is_active' => 'boolean',
            'slider_images.*' => 'image|max:5120',
        ]);

        $data['title'] = $data['title_en'];
        $data['short_description'] = $data['short_description_en'] ?? null;
        $data['description'] = $data['description_en'] ?? null;
        $data['slug'] = Str::slug($data['title']);
        $data['image'] = $request->file('image')->store('projects', 'public');
        $data['is_active'] = $request->boolean('is_active');

        $project = Project::create($data);

        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $i => $file) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $file->store('projects/slider', 'public'),
                    'order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        $project->load('sliderImages');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_es' => 'nullable|string|max:255',
            'short_description_en' => 'nullable|string|max:500',
            'short_description_es' => 'nullable|string|max:500',
            'description_en' => 'nullable|string',
            'description_es' => 'nullable|string',
            'category' => 'required|in:food_truck,mobile_kitchen',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'boolean',
            'slider_images.*' => 'image|max:5120',
        ]);

        $data['title'] = $data['title_en'];
        $data['short_description'] = $data['short_description_en'] ?? null;
        $data['description'] = $data['description_en'] ?? null;
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $project->update($data);

        if ($request->hasFile('slider_images')) {
            $lastOrder = $project->sliderImages()->max('order') ?? -1;
            foreach ($request->file('slider_images') as $file) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $file->store('projects/slider', 'public'),
                    'order' => ++$lastOrder,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        foreach ($project->sliderImages as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    public function destroySliderImage(ProjectImage $projectImage)
    {
        Storage::disk('public')->delete($projectImage->image);
        $projectImage->delete();

        return back()->with('success', 'Image removed.');
    }
}
