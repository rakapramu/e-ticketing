<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = Event::where('is_active', '1')->get();
        return view('front.index', compact('data'));
    }
}
