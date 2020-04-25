<?php

namespace App\Http\Controllers;

use App\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $readingsTmp = Reading::where('userid', Auth::id())->orderBy('client_created', 'DESC')->get();

        $readings = [];
        foreach ($readingsTmp as $reading) {
            $readings[$reading->client_created][$reading->key] = $reading->value;
        }

        return view('home.home', compact('readings'));
    }

}
