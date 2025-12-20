<?php

use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    $companyLogos = \App\Models\CompanyLogo::orderBy('order')->get()->map(function ($logo) {
        return [
            'id' => $logo->id,
            'logo_url' => \Illuminate\Support\Facades\Storage::url($logo->logo_path),
            'original_name' => $logo->original_name,
        ];
    });

    return Inertia::render('Welcome', [
        'companyLogos' => $companyLogos,
    ]);
})->name('home');


Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');

Route::get('/contact-us', function () {
    return Inertia::render('ContactUs');
})->name('contact-us');

Route::get('/services/web-development', function () {
    return Inertia::render('WebDevelopment');
})->name('web-development');

Route::get('/services/mobile-development', function () {
    return Inertia::render('MobileDevelopment');
})->name('mobile-development');

Route::get('/services/software-solutions', function () {
    return Inertia::render('SoftwareSolutions');
})->name('software-solutions');

Route::get('/services/chatbot-automation', function () {
    return Inertia::render('ChatbotAutomation');
})->name('chatbot-automation');

Route::get('/services/digital-marketing', function () {
    return Inertia::render('DigitalMarketing');
})->name('digital-marketing');

Route::get('/services/cloud-devops', function () {
    return Inertia::render('CloudDevOps');
})->name('cloud-devops');

Route::get('/services/consulting', function () {
    return Inertia::render('Consulting');
})->name('consulting');

Route::get('/chatbot', [App\Http\Controllers\ChatBotPageController::class, 'index'])->name('chatbot');

Route::get('portfolio', [ProjectController::class, 'publicPortfolio'])->name('portfolio');

Route::get('cv', function () {
    return Inertia::render('CV');
})->name('cv');

Route::get('projects/{id}', [ProjectController::class, 'show'])->name('project.detail');

Route::get('/dashboard', function () {
    $projects = \App\Models\Project::orderBy('created_at', 'desc')->get();
    return Inertia::render('Dashboard', [
        'projects' => $projects
    ]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Project API Routes (JSON responses for AJAX)
Route::middleware('auth')->group(function () {
    Route::get('/api/projects', [ProjectController::class, 'index']);
    Route::post('/api/projects', [ProjectController::class, 'storeApi']);
    Route::put('/api/projects/{project}', [ProjectController::class, 'updateApi']);
    Route::delete('/api/projects/{project}', [ProjectController::class, 'destroyApi']);
    Route::get('/api/projects/stats', [ProjectController::class, 'stats']);
});

// Test route for debugging
Route::get('/test-api', function() {
    return response()->json(['message' => 'API is working']);
});

// Test project creation route (without auth for debugging)
Route::post('/test-project-create', function(Request $request) {
    return response()->json([
        'message' => 'Test project creation endpoint',
        'data' => $request->all(),
        'headers' => $request->headers->all()
    ]);
});

// Test auth route
Route::get('/test-auth', function() {
    return response()->json([
        'authenticated' => \Illuminate\Support\Facades\Auth::check(),
        'user' => \Illuminate\Support\Facades\Auth::user()
    ]);
})->middleware('auth');

Route::get('/api/projects/featured', [ProjectController::class, 'featured']);

// Chat routes
Route::post('/chat/store-response', [App\Http\Controllers\ChatController::class, 'storeResponse'])->name('chat.store');
Route::get('/chat/responses', [App\Http\Controllers\ChatController::class, 'getResponses'])->name('chat.responses');

require __DIR__.'/auth.php';
require __DIR__.'/settings.php';
