<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Social;
use App\SocialInitializer;

// use Illuminate\Support\Facades\Log;

// use App\Models\User;

class SocialController extends Controller
{
    public function edit() {
        $social = Social::where('user_id', Auth::id())->first();
        
        if ($social == null) {
            
            $social = new SocialInitializer();

        }
        
        return view('social.edit', compact('social'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'github' => ['nullable', 'string', 'max:255'],
            'google' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = Auth::id();

        // Use updateOrCreate to either update the existing record or create a new one
        Social::updateOrCreate(
            ['user_id' => $validated['user_id']], // Conditions to check
            $validated // Data to update or create
        );

        return redirect()->route('social.edit')->with('message', 'Social links saved!');
    }


    public function update(Request $request, Social $social)
    {
        $request['user_id'] = Auth::user()->id;

        $validated = $request->validate([
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'github' => ['nullable', 'string', 'max:255'],
            'google' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
        ]);

        $social->update($validated);

        return redirect()->route('social.edit')->with('message', 'Social links saved!');


    }

}
