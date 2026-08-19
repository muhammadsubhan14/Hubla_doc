<?php

namespace App\Http\Controllers;

use App\Models\Documentation;

use Illuminate\Http\Request;

class PublicDocumentationController extends Controller
{
    public function index()
    {
        $documentations = Documentation::with('coverImage')->latest('event_date')->paginate(9);

        return view('public.index', compact('documentations'));
    }

    public function show(Documentation $documentation)
    {
        $documentation->load(['images', 'persons']);

        return view('public.show', compact('documentation'));
    }
}
