<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Show settings
     */
    public function index()
    {
        $settings = Setting::all()->groupBy('category');
        return view('settings.index', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        foreach ($request->except('_token', '_method') as $key => $value) {
            Setting::setSetting($key, $value);
        }

        return back()->with('success', 'Settings updated successfully');
    }
}
