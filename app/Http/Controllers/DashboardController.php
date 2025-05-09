<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $totalShortlinks = Url::where('user_id', Auth::user()->id)->count();
        $totalClicks = 0;
        $recentShortlinks = Url::where('user_id', Auth::user()->id)
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('Dashboard', [
            'stats' => [
                'totalShortlinks' => $totalShortlinks,
                'totalClicks' => $totalClicks,
                'averageClicks' => $totalShortlinks > 0 ? round($totalClicks / $totalShortlinks, 2) : 0,
            ],
            'recentShortlinks' => $recentShortlinks,
        ]);
    }
}
