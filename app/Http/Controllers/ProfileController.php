<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

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

        try {
            $avatarFile = $request->file('foto');
            $avatarFilename = 'avatar-' . $id . '.' . $avatarFile->extension();
            $avatarPath = $avatarFile->storeAs('avatars', $avatarFilename, 'public');

            if ($request->hasFile('original')) {
                $originalFile = $request->file('original');
                $originalFilename = 'original-' . $id . '.' . $originalFile->extension();
                $originalFile->storeAs('avatars', $originalFilename, 'public');
            }

            $user->foto_perfil = Storage::disk('public')->url($avatarPath);
            $user->save();

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Local upload failed for user '.$id.': '.$e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Erro ao enviar imagem'], 500);
        }
    }
}