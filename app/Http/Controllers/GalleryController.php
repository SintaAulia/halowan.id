<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('gallery.index', [
            'title'  => 'Gallery',
            'photos' => Gallery::latest()->get(),
        ]);
    }
}
