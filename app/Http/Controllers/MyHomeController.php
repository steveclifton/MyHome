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
        $readingsTmp = Reading::where('userid', Auth::id())
                                ->whereRaw('Date(client_created) = CURDATE()')
                                ->orderBy('client_created', 'DESC')
                                ->get();


        $table = [];
        $summary = [
            'low' => 99,
            'high' => 0
        ];
        foreach ($readingsTmp as $reading) {
            $created = date('D d F - H:i', strtotime($reading->client_created));
            $table[$created][$reading->key] = $reading->value;

            if (empty($summary['lastupdated'])) {
                $summary['lastupdated'] = date('D, h:i A', strtotime($reading->client_created));
            }

            if ($reading->key == 'temperature') {
                if (empty($summary['now'])) {
                    $summary['now'] = $reading->value;
                }
                if ($summary['low'] > $reading->value) {
                    $summary['low'] = $reading->value;
                }
                if ($summary['high'] < $reading->value) {
                    $summary['high'] = $reading->value;
                }
            }

            if (empty($summary['humidity']) && $reading->key == 'humidity') {
                $summary['humidity'] = $reading->value;
            }
        }

        return view('home.home', compact('table', 'summary'));
    }

    public function getTokens(Request $request)
    {
        return view('home.tokens');
    }

}
