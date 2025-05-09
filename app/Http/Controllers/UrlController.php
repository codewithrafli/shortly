<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\UrlAnalytic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $urls = Url::where('user_id', Auth::user()->id)
            ->latest()
            ->paginate(10);

        return Inertia::render('url/List', [
            'urls' => $urls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display analytics for a specific URL
     */
    public function analytics(string $id)
    {
        $url = Url::where('user_id', Auth::user()->id)
            ->with(['analytics' => function ($query) {
                $query->latest();
            }])
            ->findOrFail($id);

        $analytics = $url->analytics()
            ->select([
                'browser',
                'device_type',
                'os',
                'country',
                'city',
                'created_at'
            ])
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });

        $totalClicks = $url->analytics()->count();
        $uniqueVisitors = $url->analytics()->distinct('ip_address')->count();
        $topBrowsers = $url->analytics()
            ->select('browser', \DB::raw('count(*) as total'))
            ->groupBy('browser')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
        $topDevices = $url->analytics()
            ->select('device_type', \DB::raw('count(*) as total'))
            ->groupBy('device_type')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
        $topCountries = $url->analytics()
            ->select('country', \DB::raw('count(*) as total'))
            ->groupBy('country')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return Inertia::render('url/Analytics', [
            'url' => $url,
            'analytics' => $analytics,
            'totalClicks' => $totalClicks,
            'uniqueVisitors' => $uniqueVisitors,
            'topBrowsers' => $topBrowsers,
            'topDevices' => $topDevices,
            'topCountries' => $topCountries,
        ]);
    }

    /**
     * Redirect to the original URL from short URL
     */
    public function redirect(string $shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->firstOrFail();

        // Get browser and device information
        $agent = new Agent();

        // Get location information
        $position = Location::get(request()->ip());

        // Record analytics
        $url->analytics()->create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'browser' => $agent->browser(),
            'browser_version' => $agent->version($agent->browser()),
            'device_type' => $agent->deviceType(),
            'os' => $agent->platform(),
            'os_version' => $agent->version($agent->platform()),
            'country' => $position ? $position->countryName : null,
            'city' => $position ? $position->cityName : null,
            'referer' => request()->header('referer')
        ]);

        return redirect($url->original_url);
    }
}
