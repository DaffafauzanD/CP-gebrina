<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function areas(): View
    {
        return view('pages.areas');
    }

    public function gallery(): View
    {
        return view('pages.gallery', [
            'galleryItems' => GalleryItem::all(),
            'categories' => GalleryItem::categories(),
        ]);
    }
}
