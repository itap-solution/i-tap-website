<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'project_price' => 'nullable|numeric|min:0|max:999999.99',
            'project_discount' => 'nullable|numeric|min:0|max:100',
            'project_image' => 'nullable|string',
            'project_description' => 'required|string',
            'technologies' => 'nullable|array',
            'category' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'github' => 'nullable|string',
            'live' => 'nullable|string',
            'featured' => 'boolean',
            'stats' => 'nullable|array'
        ]);

        $project = Project::create($validated);

        return back()->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return Inertia::render('ProjectDetail', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'project_price' => 'nullable|numeric|min:0|max:999999.99',
            'project_discount' => 'nullable|numeric|min:0|max:100',
            'project_image' => 'nullable|string',
            'project_description' => 'required|string',
            'technologies' => 'nullable|array',
            'category' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'github' => 'nullable|string',
            'live' => 'nullable|string',
            'featured' => 'boolean',
            'stats' => 'nullable|array'
        ]);

        $project->update($validated);

        return back()->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Project deleted successfully');
    }

    /**
     * API Methods for AJAX requests
     */
    public function storeApi(Request $request)
    {
        // Log the incoming request
        Log::info('Project creation request received', [
            'data' => $request->all(),
            'headers' => $request->headers->all(),
            'method' => $request->method(),
            'url' => $request->url()
        ]);

        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                Log::error('User not authenticated');
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            Log::info('User authenticated', ['user_id' => Auth::id()]);

            $validated = $request->validate([
                'project_name' => 'required|string|max:255',
                'project_price' => 'nullable|numeric|min:0|max:999999.99',
                'project_discount' => 'nullable|numeric|min:0|max:100',
                'project_image' => 'nullable|string',
                'project_description' => 'required|string',
                'technologies' => 'nullable|array',
                'category' => 'required|string|max:255',
                'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
                'github' => 'nullable|string',
                'live' => 'nullable|string',
                'featured' => 'nullable|boolean',
                'stats' => 'nullable|array'
            ]);

            // Set default values for nullable fields
            $validated['project_price'] = $validated['project_price'] ?? 0;
            $validated['project_discount'] = $validated['project_discount'] ?? 0;
            $validated['technologies'] = $validated['technologies'] ?? [];
            $validated['featured'] = $validated['featured'] ?? false;

            Log::info('Validation passed', ['validated' => $validated]);

            $project = Project::create($validated);

            Log::info('Project created successfully', ['project_id' => $project->id, 'project' => $project->toArray()]);

            return response()->json([
                'success' => true,
                'project' => $project,
                'message' => 'Project created successfully'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error', [
                'errors' => $e->errors(),
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error creating project', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error creating project: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateApi(Request $request, Project $project)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'project_price' => 'nullable|numeric|min:0|max:999999.99',
            'project_discount' => 'nullable|numeric|min:0|max:100',
            'project_image' => 'nullable|string',
            'project_description' => 'required|string',
            'technologies' => 'nullable|array',
            'category' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'github' => 'nullable|string',
            'live' => 'nullable|string',
            'featured' => 'nullable|boolean',
            'stats' => 'nullable|array'
        ]);

        // Set default values for nullable fields
        $validated['project_price'] = $validated['project_price'] ?? 0;
        $validated['project_discount'] = $validated['project_discount'] ?? 0;
        $validated['technologies'] = $validated['technologies'] ?? [];
        $validated['featured'] = $validated['featured'] ?? false;

        $project->update($validated);

        return response()->json([
            'success' => true,
            'project' => $project,
            'message' => 'Project updated successfully'
        ]);
    }

    public function destroyApi(Project $project)
    {
        $projectName = $project->project_name;
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => "Project '{$projectName}' deleted successfully"
        ]);
    }

    /**
     * Get all projects for portfolio display
     */
    public function portfolio()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return Inertia::render('Portfolio', [
            'projects' => $projects
        ]);
    }

    /**
     * Get all projects for public portfolio display
     */
    public function publicPortfolio()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return Inertia::render('PublicPortfolio', [
            'projects' => $projects
        ]);
    }

    /**
     * Get featured projects for welcome page
     */
    public function featured()
    {
        $featuredProjects = Project::featured()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'projects' => $featuredProjects
        ]);
    }

    /**
     * Get project statistics for dashboard
     */
    public function stats()
    {
        $stats = [
            'total' => Project::count(),
            'featured' => Project::featured()->count(),
            'categories' => Project::distinct('category')->count(),
            'technologies' => $this->getUniqueTechnologiesCount()
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }

    private function getUniqueTechnologiesCount()
    {
        $allTechnologies = Project::whereNotNull('technologies')
            ->pluck('technologies')
            ->flatten()
            ->unique();

        return $allTechnologies->count();
    }
}
