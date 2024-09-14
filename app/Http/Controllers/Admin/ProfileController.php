<?php

namespace App\Http\Controllers\Admin;

use App\Classes\ImageLogic;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.profile_form', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        // dd($request->all());
        // Fill user model with validated data
        $user->fill($request->validated());

        // Handle email verification reset if email is updated
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle profile picture update
        if ($request->hasFile('picture')) {
            $this->storeProfileImage($request, $user);
        }

        // Hash the password if it is present in the request
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save user model changes
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully');
    }

    public function storeProfileImage(Request $request, User $user)
    {
        $request->validate([
            'picture' => 'mimes:jpeg,bmp,png,jpg,webp',
        ]);
        // Delete previous profile picture if it exists
        if ($user->picture) {
            Storage::disk('public')->delete($user->picture); // Use 'public' disk and correct deletion method
        }

        $image = $request->file('picture');
        $imageName = time() . '-' . $image->getClientOriginalName(); // Generate unique name for the image
        $path = $image->storeAs('profile', $imageName, 'public'); // Store image in 'public/profile' directory

        // Update user model with new picture path
        $user->picture = $path;
        $user->save();


    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function deleteImageGeneral(Request $request, User $user)
    {

        $user->deleteImageGeneral($request);
        return back();
    }
}
