<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(): View
    {
        $user = Auth::user()->load(['detail', 'invoices', 'hostings', 'domains', 'inboxes']);
        $setting = Setting::first();
        $news = News::latest('tgl_berita')->limit(1)->get();

        return view('member.index', compact('user', 'setting', 'news'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
