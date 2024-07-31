<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodAuthController extends Controller
{
    public function index(Request $request)
    {
        return view('login');
    }

    public function processlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['loginError' => 'Invalid username or password.']);
        }

        return redirect()->route('home');
    }

    public function show()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function uploadProfilePicture(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/profile_pictures', $fileName);

            // Update user's profile picture path in database
            $user->profile_picture = $fileName;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
