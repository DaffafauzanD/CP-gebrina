<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Fluent;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('pages.services.index', [
            'services' => Service::all(),
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::findBySlug($slug);

        abort_if($service === null, 404);

        return view('pages.services.show', [
            'service' => $service,
            'otherServices' => Service::all()
                ->reject(fn (Fluent $other): bool => $other->slug === $slug)
                ->values(),
        ]);
    }
}
