<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Image;
use App\Models\Person;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'documentationCount' => Documentation::count(),
            'imageCount' => Image::count(),
            'personCount' => Person::count(),
            'recentDocumentations' => Documentation::with('coverImage')->latest()->limit(6)->get(),
        ]);
    }
}
