<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'services' => Service::all(),
            'testimonials' => Testimonial::all(),
            'galleryItems' => GalleryItem::all()->take(6),
        ]);
    }
}
