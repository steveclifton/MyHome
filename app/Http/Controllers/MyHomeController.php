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
        $summary = [];
        foreach ($readingsTmp as $reading) {

            if (empty($reading->client_created)) {
                continue;
            }

            $deviceid = $reading->deviceid;

            $created = date('D d F - H:i', strtotime($reading->client_created));

            $summary[$deviceid]['name'] = $this->getDeviceName($deviceid);

            if (empty($summary[$deviceid]['lastupdated'])) {
                $summary[$deviceid]['lastupdated'] = date('D, h:i A', strtotime($reading->client_created));
            }

            if ($reading->key == 'temperature') {

                if (empty($summary[$deviceid]['now'])) {
                    $summary[$deviceid]['now'] = $reading->value;
                }

                // Low
                if (empty($summary[$deviceid]['low'])) {
                    $summary[$deviceid]['low'] = 99;
                }
                if ($summary[$deviceid]['low'] > $reading->value) {
                    $summary[$deviceid]['low'] = $reading->value;
                }

                // High
                if (empty($summary[$deviceid]['high'])) {
                    $summary[$deviceid]['high'] = 0;
                }
                if ($summary[$deviceid]['high'] < $reading->value) {
                    $summary[$deviceid]['high'] = $reading->value;
                }

                // Chart
                $time = date('H:i', strtotime($reading->client_created));
                list($hour, $minutes) = explode(':', $time);

                if (!empty($minutes) && in_array($minutes, ['00', '30'])) {
                    $chart[$deviceid]['name'] = !empty($chart[$deviceid]['name']) ? $chart[$deviceid]['name'] : $summary[$deviceid]['name'];
                    $chart[$deviceid]['times'][] = $time;
                    $chart[$deviceid]['temps'][] = $reading->value;
                }
            }

            if (empty($summary[$deviceid]['humidity']) && $reading->key == 'humidity') {
                $summary[$deviceid]['humidity'] = $reading->value;
            }

        }

        if (!empty($chart)) {
            foreach ($chart as $key => $item) {
                $chart[$key]['times'] = array_reverse($item['times']);
                $chart[$key]['temps'] = array_reverse($item['temps']);
            }
        }

        uasort($summary, function($a, $b) {
            return $a['name'] <=> $b['name'];
        });

        uasort($chart, function($a, $b) {
            return $a['name'] <=> $b['name'];
        });

        return view('home.home', compact('table', 'summary', 'chart'));
    }

    public function getTokens(Request $request)
    {
        return view('home.tokens');
    }

}
