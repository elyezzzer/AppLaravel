<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
            'foto'     => 'required|image|max:5120',   // max 5 MB
            'original' => 'nullable|image|max:10240',  // max 10 MB
        ]);

        $user = $request->user();
        $id   = $user->id;

        $avatarName   = $id . '.jpg';
        $originalName = $id . '-original.jpg';

        // Remove arquivos antigos antes de salvar os novos.
        // Só deleta o original quando um novo arquivo original é enviado,
        // preservando o original anterior ao recortar sem alterar a foto.
        Storage::disk('public')->delete('fotos-perfil/' . $avatarName);

        if ($request->hasFile('original')) {
            Storage::disk('public')->delete('fotos-perfil/' . $originalName);

            Storage::disk('public')->putFileAs(
                'fotos-perfil',
                $request->file('original'),
                $originalName
            );
        }

        Storage::disk('public')->putFileAs(
            'fotos-perfil',
            $request->file('foto'),
            $avatarName
        );

        $user->foto_perfil = 'fotos-perfil/' . $avatarName;
        $user->save();

        return response()->json(['success' => true]);
    }
}