<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Module;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function general()
    {
        $setting = Setting::current();

        return view('admin.settings.general', [
            'setting' => $setting,
            'title'   => 'Setting Umum | Manthabill',
        ]);
    }

    public function updateGeneral(UpdateSettingRequest $request)
    {
        $validated  = $request->validated();
        $limitEmail = ($validated['limitEmail'] ?? 0) ?: 1;

        Setting::current()->update([
            'nama_hosting'   => $validated['namaHosting'],
            'judul_hosting'  => $validated['judulHosting'],
            'alamat_hosting' => $validated['alamatHosting'],
            'email_hosting'  => $validated['emailHosting'],
            'telp_hosting'   => $validated['telponHosting'],
            'tos'            => $validated['urlTos'],
            'tax'            => $validated['pajak'] ?? 0,
            'limit_email'    => $limitEmail,
            'prefix'         => $validated['prefix'] ?? 1,
        ]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Data berhasil diperbaharui!</div>');

        return redirect()->route('admin.settings.general');
    }

    public function api()
    {
        $setting = Setting::current();
        $smtp2go = Module::find(1);

        return view('admin.settings.api', [
            'setting' => $setting,
            'smtp2go' => $smtp2go,
            'title'   => 'Setting API | Manthabill',
        ]);
    }

    public function updateApi(Request $request)
    {
        $request->validate([
            'keySmtp'    => ['nullable', 'string', 'max:200'],
            'statusSmtp' => ['nullable', 'integer'],
        ]);

        $smtp2go = Module::find(1);
        if ($smtp2go) {
            $smtp2go->update([
                'api_key' => $request->keySmtp,
                'status'  => $request->statusSmtp ?? Module::STATUS_DISABLED,
            ]);
        }

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Data API berhasil diperbaharui!</div>');

        return redirect()->route('admin.settings.api');
    }
}
