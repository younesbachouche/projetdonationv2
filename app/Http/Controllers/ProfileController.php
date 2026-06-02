<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        // API JSON
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $request->user()
            ]);
        }

        // Web HTML
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'sometimes|nullable|string|max:20',
            'address' => 'sometimes|nullable|string|max:255',
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // API JSON
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profil mis à jour avec succès',
                'data' => $user
            ]);
        }

        // Web redirect
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        // API JSON
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Compte supprimé avec succès'
            ]);
        }

        // Web redirect
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

        return Redirect::to('/');
    }
}
