<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getDeviceName(int $deviceId) : string
    {
        switch ($deviceId) {
            case 1:
                return 'Lounge';
            case 2:
                return 'Outside';
            case 3:
                return 'Bedroom';
            case 4:
                return 'Ollie\'s Bedroom';
            default:
            case 5:
                return 'Garage';
        }
    }
}
