<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hosting;
use App\Models\Inbox;
use App\Models\Invoice;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jmlService = Hosting::where('status_hosting', Hosting::STATUS_ACTIVE)->count();
        $jmlInvoice = Invoice::count();
        $jmlInbox   = Inbox::where('status_inbox', '<', Inbox::STATUS_CLOSED)->count();
        $totalUsers = User::count();
        $berita     = News::latest('tgl_berita')->first();
        $dataTicket = Inbox::with('user.detail')
            ->where('status_inbox', '<', Inbox::STATUS_CLOSED)
            ->orderByDesc('time')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'jmlService',
            'jmlInvoice',
            'jmlInbox',
            'totalUsers',
            'berita',
            'dataTicket'
        ));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function checkpoint()
    {
        return response('OK', 200);
    }

    public function help()
    {
        return view('admin.help');
    }
}
