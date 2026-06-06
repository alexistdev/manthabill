<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\ChangePasswordRequest;
use App\Http\Requests\Member\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('detail');

        return view('setting.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user   = Auth::user();
        $detail = $user->detail;

        $updateData = [
            'nama_depan'    => $request->namaDepan,
            'nama_belakang' => $request->namaBelakang,
            'nama_usaha'    => $request->namaUsaha,
            'phone'         => $request->notelp,
            'alamat'        => $request->alamat1,
            'alamat2'       => $request->alamat2,
            'kota'          => $request->kota,
            'provinsi'      => $request->provinsi,
            'kodepos'       => $request->kodepos,
            'negara'        => $request->negara,
            'time_req'      => time() + 300,
        ];

        if ($request->hasFile('gambar')) {
            $oldGambar = $detail->gambar;

            $path = $request->file('gambar')->store('avatars', 'public');
            $updateData['gambar'] = $path;

            // Delete old avatar — skip default placeholder and non-storage paths
            if ($oldGambar && $oldGambar !== 'default.jpg' && str_starts_with($oldGambar, 'avatars/')) {
                Storage::disk('public')->delete($oldGambar);
            }
        }

        $detail->update($updateData);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Data Informasi Anda telah diperbaharui!</div>');

        return redirect()->route('setting.index');
    }

    public function changePassword()
    {
        return view('setting.password');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        $user->update(['password' => Hash::make($request->passwordBaru)]);

        // Regenerate session ID to prevent session fixation; auth state is preserved
        $request->session()->regenerate();

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Password anda berhasil diperbaharui!</div>');

        return redirect()->route('setting.password');
    }
}
