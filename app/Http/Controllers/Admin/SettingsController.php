<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $blogAccess = Setting::get('blog_access', 'public');
        return view('admin.settings.index', compact('blogAccess'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'blog_access' => 'required|in:public,members_only',
        ]);

        Setting::set('blog_access', $validated['blog_access']);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully');
    }
}
