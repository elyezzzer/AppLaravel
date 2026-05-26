<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function updatePhoto(Request $request){
        $request->validate([
            'foto'     => 'required|image|max:5120',
            'original' => 'nullable|image|max:10240',
        ]);

        $user = $request->user();
        $id   = $user->id;

        // Faz upload do avatar cropado
        $avatar = Cloudinary::upload($request->file('foto')->getRealPath(), [
            'folder'    => 'fotos-perfil',
            'public_id' => 'avatar-' . $id,
            'overwrite' => true,
        ]);

        // Faz upload do original (se enviado)
        if ($request->hasFile('original')) {
            Cloudinary::upload($request->file('original')->getRealPath(), [
                'folder'    => 'fotos-perfil',
                'public_id' => 'original-' . $id,
                'overwrite' => true,
            ]);
        }

        // Salva a URL pública no banco
        $user->foto_perfil = $avatar->getSecurePath();
        $user->save();

        return response()->json(['success' => true]);
    }
}