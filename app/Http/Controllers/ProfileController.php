<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $mahasiswa = null;
        $dosen = null;
        
        if ($user->mahasiswa_id != null) {
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
        }
        
        if ($user->nidn != null) {
            $dosen = Dosen::where('nidn', $user->nidn)->first();
        }
        
        return view('profile.edit', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
        ]);
    }
    
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $namaBaru = $request->name;
        $emailBaru = $request->email;
        
        // Update tabel users
        $user->name = $namaBaru;
        $user->email = $emailBaru;
        
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        
        $user->save();
        
        // UPDATE TABEL DOSEN (jika user adalah dosen)
        if ($user->nidn != null) {
            $dosen = Dosen::where('nidn', $user->nidn)->first();
            if ($dosen) {
                $dosen->nama = $namaBaru;
                $dosen->save();
            }
        }
        
        // UPDATE TABEL MAHASISWA (jika user adalah mahasiswa)
        if ($user->mahasiswa_id != null) {
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
            if ($mahasiswa) {
                $mahasiswa->nama = $namaBaru;
                $mahasiswa->save();
            }
        }

        return Redirect::route('profile.edit')->with('success', 'Profile berhasil diupdate!');
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
}