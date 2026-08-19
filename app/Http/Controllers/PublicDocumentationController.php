<?php

namespace App\Http\Controllers;

use App\Models\Documentation;

use Illuminate\Http\Request;

class PublicDocumentationController extends Controller
{
    public function index()
    {
        $documentations = Documentation::with('coverImage')
            ->latest('created_at')
            ->latest('id')
            ->paginate(9);
        $featured = $documentations->getCollection()->first();
        $carouselDocumentations = $documentations->getCollection()->skip(1);

        return view('public.index', compact('documentations', 'featured', 'carouselDocumentations'));
    }

    public function show(Documentation $documentation)
    {
        $documentation->load(['images', 'persons']);

        return view('public.show', compact('documentation'));
    }
}
