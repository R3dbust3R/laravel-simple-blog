<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validating the data
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,avif,webp', 'max:5120'],
            'banner' => ['nullable', 'file', 'mimes:jpg,jpeg,png,avif,webp', 'max:5120'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'max:120', 'confirmed'],
        ]);

        // handling the profile and banner images
        $image  = null;
        $banner = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner')->store('images', 'public');
        }

        // Create a new user instance and fill it with validated data
        $user = new User([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'image' => $image,
            'banner' => $banner,
        ]);

        if ($user->save()) {
            // Attempt to log in the user
            $login = Auth::attempt([
                'email' => $user->email,
                'password' => $request->input('password'), // Use the plain text password
            ]);
    
            if ($login) {
                return redirect()->route('user.show', $user->id);
            } else {
                return redirect()->route('user.create')->withErrors(['msg' => 'There was an error while trying to register your account, please try again!']);
            }
        } else {
            return redirect()->route('user.create')->withErrors(['msg' => 'There was an error while trying to register your account, please try again!']);
        }

    }

    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Display the login form
     */
    public function login() {
        return view('user.login');
    }

    /**
     * check login credentials
     */
    public function checkLogin(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('post.index');
        }

        return back()->with('email', 'The provided credentials do not match our records!');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $hasAccess = false;
        if (Auth()->user()->id == $user->id) {
            $hasAccess = true;
        }
        $posts = Post::with('comments')->where('user_id', $user->id)->latest()->paginate(4);
        $social = Social::where('user_id', Auth::id())->first();
        $socialLinks = [
            'facebook', 
            'instagram', 
            'tiktok', 
            'linkedin', 
            'github', 
            'google', 
            'youtube', 
            'website'
        ];


        return view('user.show', compact('user', 'hasAccess', 'posts', 'social', 'socialLinks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,avif,webp', 'max:5120'],
            'banner' => ['nullable', 'file', 'mimes:jpg,jpeg,png,avif,webp', 'max:5120'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:5', 'max:120', 'confirmed'],
        ]);

        // Handle the profile image
        if ($request->hasFile('image')) {
            // If there's an existing image, delete it
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Store the new image and get its path
            $image = $request->file('image')->store('images', 'public');
            $validated['image'] = $image;
        }
        
        // Handle the banner
        if ($request->hasFile('banner')) {
            // If there's an existing banner, delete it
            if ($user->banner) {
                Storage::disk('public')->delete($user->banner);
            }

            // Store the new banner and get its path
            $banner = $request->file('banner')->store('images', 'public');
            $validated['banner'] = $banner;
        }

        // Handle the password
        if ($request->filled('password')) {
            if ($request->password !== $request->password_confirmation) {
                return redirect()->back()->withErrors(['password' => 'Passwords do not match']);
            }
            $validated['password'] = bcrypt($request->password);
        } else {
            // Remove password from validation if not changing
            unset($validated['password']);
        }

        // Update the user with validated data
        if ($user->update($validated)) {
            return redirect()->route('user.show', $user->id)->with('message', 'Profile updated successfully');
        } else {
            return redirect()->back()->withErrors('image', 'There was an error while trying to update your info, please try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();

        if (Auth::id() === $user->id) {
            Auth::logout();
    
            // Invalidate the session and regenerate the CSRF token
            session()->invalidate();
            session()->regenerateToken();
        }

        return redirect('/login')->with('message', 'User account has been deleted successfully.');

    }
}
