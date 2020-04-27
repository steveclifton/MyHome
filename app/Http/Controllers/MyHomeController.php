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
        date_default_timezone_set('Pacific/Auckland');
        $date = date('Y-m-d');

        $readingsTmp = Reading::where('userid', Auth::id())
                                ->whereRaw("Date(client_created) = '" . $date . "'")
                                ->orderBy('client_created', 'DESC')
                                ->get();

        $chart = [];
        $table = [];
        $summary = [
            'low' => 99,
            'high' => 0
        ];
        foreach ($readingsTmp as $reading) {

            if (empty($reading->client_created)) {
                continue;
            }

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

                // Chart
                $time = date('H:i', strtotime($reading->client_created));
                list($hour, $minutes) = explode(':', $time);

                if (!empty($minutes) && in_array($minutes, ['00'])) {
                    $chart['times'][] = $time;
                    $chart['temps'][] = $reading->value;
                }
            }

            if (empty($summary['humidity']) && $reading->key == 'humidity') {
                $summary['humidity'] = $reading->value;
            }

        }

        if (!empty($chart)) {
            $chart['times'] = array_reverse($chart['times']);
            $chart['temps'] = array_reverse($chart['temps']);
        }

        return view('home.home', compact('table', 'summary', 'chart'));
    }

    public function getTokens(Request $request)
    {
        return view('home.tokens');
    }

}
