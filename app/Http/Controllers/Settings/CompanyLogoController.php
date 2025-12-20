<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\CompanyLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class CompanyLogoController extends Controller
{
    /**
     * Display the company logos settings page.
     */
    public function index(): Response
    {
        $logos = CompanyLogo::orderBy('order')->get()->map(function ($logo) {
            return [
                'id' => $logo->id,
                'logo_path' => $logo->logo_path,
                'logo_url' => Storage::url($logo->logo_path),
                'original_name' => $logo->original_name,
                'order' => $logo->order,
            ];
        });

        return Inertia::render('settings/CompanyLogos', [
            'logos' => $logos,
        ]);
    }

    /**
     * Store uploaded company logos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logos' => 'required|array|min:1',
            'logos.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $files = $request->file('logos');
        if (!$files) {
            return back()->withErrors(['logos' => 'Please select at least one logo file.']);
        }

        foreach ($files as $file) {
            $path = $file->store('company-logos', 'public');
            
            $maxOrder = CompanyLogo::max('order') ?? 0;
            
            CompanyLogo::create([
                'logo_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'order' => $maxOrder + 1,
            ]);
        }

        return redirect()->route('company-logos.index')
            ->with('success', 'Logos uploaded successfully.');
    }

    /**
     * Delete a company logo.
     */
    public function destroy(CompanyLogo $companyLogo)
    {
        Storage::disk('public')->delete($companyLogo->logo_path);
        $companyLogo->delete();

        return redirect()->route('company-logos.index')
            ->with('success', 'Logo deleted successfully.');
    }
}
