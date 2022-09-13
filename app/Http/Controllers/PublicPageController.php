<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    public function index()
    {
        return view('public.index');
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }
}
