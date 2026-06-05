<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Hosting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $hostings = Hosting::where('user_id', Auth::id())->with('product')->get();

        return view('service.index', compact('hostings'));
    }

    public function detail(string $encrypted): View|RedirectResponse
    {
        try {
            $id = decrypt($encrypted);
        } catch (\Exception) {
            abort(404);
        }

        $hosting = Hosting::where('user_id', Auth::id())->with('product')->find($id);
        if (! $hosting) {
            return redirect()->route('service.index');
        }

        return view('service.show', compact('hosting'));
    }
}
